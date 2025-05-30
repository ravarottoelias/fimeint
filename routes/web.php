<?php

use App\Curso;
use App\Constants\Messages;
use Illuminate\Http\Request;
use App\Exports\CursoAlumnosExport;
use App\Mail\SuccessfulInscription;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('login_alumno', 'Auth\LoginAlumnoController@login')->name('login_alumno');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm');
Route::post('register', 'Auth\RegisterController@register')->name('register');

// Recupero de contraseña
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

//Sitio publico
Route::get('/','SitioController@home')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/post/{slug}', 'SitioController@showCurso')->name('show_post');
Route::get('/posts', 'SitioController@cursos')->name('all_posts');
Route::get('/novedades-fime/{slug}', 'PostController@getPost')->name('show_novedad');
Route::get('/contacto', 'SitioController@contacto')->name('contacto');
Route::get('/alianza', 'SitioController@alianza')->name('alianza');
Route::get('/aula-virtual', 'SitioController@aulaVirtual')->name('aula_virtual');
Route::get('/servicios', 'SitioController@servicios')->name('servicios');
Route::get('/responsabilidad-social-empresaria', 'SitioController@rse')->name('rse');
Route::get('/consultoria-a-pymes-familiares', 'SitioController@consultoriaPymesFamiliares')->name('consultoria_pymes_familiares');
Route::get('/cursos-homologados', 'SitioController@cursosHomologados')->name('cursos_homologados');
Route::get('/concursos', 'SitioController@concursos')->name('concursos');
Route::get('/otros-cursos', 'SitioController@otrosCursos')->name('cursos_otros');
Route::post('/submit_form_contact', 'SitioController@sendContact')->name('submit_form_contact');
Route::get('/quienes-somos', 'SitioController@quienesSomos')->name('quienes_somos');
Route::get('/nosotros', 'SitioController@nosotros')->name('nosotros');
Route::get('/empresa-de-familia', 'SitioController@empresaDeFamilia')->name('empresa_de_familia');
Route::get('/mediacion', 'SitioController@mediacion')->name('mediacion');
Route::get('/negociacion', 'SitioController@negociacion')->name('negociacion');
Route::get('/arbitraje', 'SitioController@arbitraje')->name('arbitraje');
Route::get('/autogestion', 'SitioController@autogestion')->name('autogestion');
Route::post('/subscriber', 'SubscriberController@store')->name('subscriber');
Route::get('/galeria-de-videos-expositors-seminario', 'SitioController@galeriaDeVideos')->name('galeria_videos');
Route::get('get-cursos-vigentes', 'SitioController@getCursosVigentes')->name('get_cursos_vigentes');
Route::post('/inscribir', 'InscripcionController@crearInscripcion')->name('crear_inscripcion');
Route::get('/galeria-de-videos-expositors-seminario', 'SitioController@galeriaDeVideos')->name('galeria_videos');
Route::get('/proyectos-rse', 'SitioController@proyectoRse')->name('proyectos_rse');
Route::get('/proyectos-rse/{slug}', 'SitioController@proyectoRseShow')->name('proyectos_rse_show');
Route::post('/send-email-password-reset', 'UsersController@sendEmailPasswordReset')->name('send_email_password_reset');

Route::get('/certificates/{uuid}/pdf', 'CertificatesController@generatePDF')->name('public_certificates_pdf');

// WEBHOOK Integracion Mercadopago 
Route::post('/webhooks', 'WebHooksMercadoPagoController@webhookMp')->name('webhooks_mp');

Route::group(['middleware' => 'auth'], function(){

	Route::post('projects/media', 'CursoController@storeMedia')->name('projects.storeMedia');

	Route::get('/dashboard/certificates', 'CertificatesController@index')->name('certificates')->middleware(['roles']);
	Route::post('/dashboard/certificates', 'CertificatesController@store')->name('certificates_store')->middleware(['roles']);
	Route::get('/dashboard/certificates/create-one', 'CertificatesController@createStepOne')->name('certificates_create_step_one')->middleware(['roles']);
	Route::get('/dashboard/certificates/create-two', 'CertificatesController@createStepTwo')->name('certificates_create_step_two')->middleware(['roles']);
	Route::get('/dashboard/certificates/{uuid}', 'CertificatesController@show')->name('certificates_show')->middleware(['roles']);
	Route::get('/dashboard/certificates/{uuid}/delete', 'CertificatesController@deleteCert')->name('certificates_delete')->middleware(['roles']);
	Route::get('/dashboard/certificates/{uuid}/pdf', 'CertificatesController@generatePDF')->name('certificates_pdf')->middleware(['roles']);
	Route::get('/dashboard/certificates/{curso}/export', 'CertificatesController@exportCertificatesToExcel')->name('export_certificates')->middleware(['roles']);
	
	Route::get('/dashboard/api/students', 'UsersController@search')->name('users_search')->middleware(['roles']);
	Route::get('/dashboard/api/inscriptions/{studentId}/student', 'InscripcionController@inscriptionsByUser')->name('inscription_by_user')->middleware(['roles']);

	Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard')->middleware(['roles']);
	Route::resource('users', 'UsersController')->middleware(['roles']);
	Route::get('users/reset-password/{id}', 'UsersController@resetPassword')->name('user_reset_password')->middleware(['roles']);;
	Route::resource('cursos', 'CursoController')->middleware(['roles']);
	Route::post('cursos/{id}/cert-massive-generation', 'CursoController@certificatesMassiveGeneration')->middleware(['roles'])->name('curso_cert_generation');
	Route::get('cursos/{id}/cert-massive-generation', 'CursoController@certificatesMassiveGenerationForm')->middleware(['roles'])->name('curso_cert_generation_form');
	Route::get('subscriber', 'SubscriberController@index')->middleware(['roles'])->name('subscriber_index');
	Route::resource('post_admin', 'PostController')->middleware(['roles']);
	Route::get('curso_delete_file/{id}', 'CursoController@deleteFile')->name('curso_delete_file')->middleware(['roles']);;
	Route::get('media', 'FileController@index')->name('media')->middleware(['roles']);;
	Route::post('media_upload_files', 'FileController@uploadFiles')->name('media_upload_fliles')->middleware(['roles']);;
	Route::get('dashboard/search', 'HomeController@search')->name('app_search')->middleware(['roles']);;
	
	//Scripts de pagos
	Route::get('curso_scripts/{id}', 'CursoController@getScriptsDePagos')->middleware(['roles']);
	Route::post('curso_add_scripts', 'CursoController@addScriptsDePagos')->middleware(['roles']);
	Route::post('curso_delete_scripts/{id}', 'CursoController@deleteScriptsDePagos')->middleware(['roles']);
	
	Route::get('registro-exitoso', 'SitioController@registroExitoso')->name('registro_exitoso');

	Route::get('verificar-pago/{token}', 'InscripcionController@verificarPago')->name('verificar_pago');
	Route::post('inscripcion_update_pago', 'InscripcionController@updatePago')->name('update_pago')->middleware(['roles']);
	Route::post('inscripcion_eliminar', 'InscripcionController@eliminarInscripcion')->name('eliminar_inscripcion')->middleware(['roles']);

	Route::get('export_inscriptos/{curso}', 'ExportExcelController@exportToExcel')->name('export_inscriptos')->middleware(['roles']);
	
	// Payments and Inscriptions
	Route::get('dashboard/payments', 'InscriptionPaymentController@payments')->name('payments')->middleware(['roles']);
	Route::get('dashboard/payments/{paymentId}', 'InscriptionPaymentController@paymentDetails')->name('payment_details')->middleware(['roles']);
	
	Route::get('dashboard/inscriptions', 'InscripcionController@inscriptions')->name('inscriptions')->middleware(['roles']);
	Route::get('dashboard/inscriptions/{inscription}', 'InscripcionController@show')->name('inscription_show')->middleware(['roles']);

	Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware(['roles'])->name('log_viwer');
	Route::get('dashboard/settings', 'SettingsController@edit')->middleware(['roles'])->name('settings');
	Route::post('dashboard/settings', 'SettingsController@save')->middleware(['roles'])->name('settings_save');
	Route::get('dashboard/clear-cache', 'SettingsController@cacheClear')->middleware(['roles'])->name('clear_cache');

	
	Route::get('/posts/{slug}/inscription', 'InscripcionController@inscription')->name('curso_inscription');
	Route::get('/posts/{slug}/inscription/payment', 'InscripcionController@inscriptionPayment')->name('curso_step_inscription_payment');
	
	Route::get('/inscription/{inscription}/payment/paypal', 'InscriptionPaymentController@payWithPaypal')->name('pay_with_paypal');
	Route::get('/inscription/paypal/execute-payment', 'InscriptionPaymentController@paypalExecutePayment')->name('inscript_paypal_execute_payment');
	
	//user account
	Route::get('/panel', 'ProfileController@panel')->name('my_panel');
	Route::get('/panel/account/{user}', 'ProfileController@showAccount')->name('show_account');
	Route::post('/panel/account/{userId}', 'ProfileController@updateAccount')->name('update_account');
	Route::get('/panel/account/{userId}/change-password', 'ProfileController@formChangePassword')->name('profile_form_change_password');
	Route::post('/panel/account/{userId}/change-password', 'ProfileController@updatePassword')->name('profile_change_password');
	Route::get('/panel/account/{userId}/my-courses', 'ProfileController@myCourses')->name('account_my_courses');
	Route::get('/panel/account/{userId}/my-certificates', 'ProfileController@myCertificates')->name('account_my_certificates');
	

	Route::post('dashboard/run-excel', 'CursoController@runExcel')->middleware(['roles'])->name('run_excel');
	Route::get('dashboard/sync-mp/{curso}', 'InscriptionPaymentController@syncAmountsMP')->middleware(['roles']);
});