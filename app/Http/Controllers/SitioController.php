<?php

namespace App\Http\Controllers;

use App\Post;
use App\Curso;
use App\Categoria;
use App\Mail\MessageRecived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Repositories\CursoRepository;
use App\Http\Requests\ReCaptchataTestFormRequest;
use App\Jobs\SendEmailContact;
use Illuminate\Support\Facades\Log;

class SitioController extends Controller
{
    private $cursoRepository;

	public function __construct(CursoRepository $cursoRepository){

        $this->cursoRepository = $cursoRepository;
    }


    public function home(Request $request)
    {
    	return view('sitio.home');
    }

    public function showCurso( Request $request, $slug )
    {
    	$curso = Curso::where('slug', $slug)->with(['foto'])->firstOrFail();

    	return view('sitio.blog-single', compact('curso'));
    }

    public function cursos( Request $request )
    {
        $cursos = $this->cursoRepository->findCursosWhereTags($request->tag);
        return view('sitio.blog', compact('cursos'));
       

    }

    public function contacto( Request $request)
    {
        $reCaptchaGpublicKey = config('custom.recaptchagoogle')['site_public_key'];
    	return view('sitio.contacto', compact('reCaptchaGpublicKey'));
    }

    public function nosotros( Request $request)
    {
    	return view('sitio.nosotros');
    }

    public function empresaDeFamilia( Request $request)
    {
    	return view('sitio.empresa-de-familia');
    }

    public function alianza( Request $request)
    {
        return view('sitio.alianza');
    }

    public function aulaVirtual( Request $request)
    {
        return view('sitio.aula-virtual');
    }

    public function servicios( Request $request)
    {
        return view('sitio.servicios');
    }

    public function rse( Request $request)
    {
        return view('sitio.rse');
    }
    
    public function consultoriaPymesFamiliares( Request $request)
    {
        return view('sitio.consultoria-pymes-familiares');
    }

    public function cursosHomologados( Request $request)
    {
        return view('sitio.cursos-homologados');
    }

    public function otrosCursos( Request $request)
    {
        return view('sitio.otros-cursos');
    }

    public function quienesSomos( Request $request)
    {
        return view('sitio.antecedentes');
    }

    public function sendContact( ReCaptchataTestFormRequest $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'telefono' => 'required',
            'message' => 'required',
        ]);

        $data = $request->all();
        $data['receiver'] = config('custom.commons')['email_contact_receiver'];
        SendEmailContact::dispatch($data)->onQueue('emails');

        return back()->with('success', 'Gracias por comunicarte con nosotros');
    }

    public function mediacion()
    {
        return view('sitio.mediacion');
    }

    public function negociacion()
    {
        return view('sitio.negociacion');
    }

    public function arbitraje()
    {
        return view('sitio.arbitraje');
    }

    public function proyectoRse()
    {
        $posts = Post::where('categoria_id', 3)
                    ->with('categoria')
                    ->orderBy('created_at', 'DESC')
                    ->get();

        return view('sitio.proyectos-rse', compact('posts'));
    }
    
    public function proyectoRseShow($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        return view('sitio.proyectos-rse-show', compact('post'));

    }


    public function getCursosVigentes(Request $request)
    {
        $cursos = Curso::all();
        return response()->json([
                'message' => 'success',
                'cursos' => $cursos
            ]);
    }

    public function registroExitoso()
    {
        return view('auth.register-success');
    }

    public function galeriaDeVideos(Request $request)
    {
        return view('sitio.galeria-videos');
    }

    public function concursos(Request $request)
    {
        $category = Categoria::where('slug', 'concursos')->firstOrFail();

        $concursos = Post::where('categoria_id', $category->id)->get();

        return view('sitio.concursos.index', compact('concursos'));
    }
    
    public function concursosShow($slug)
    {

        $post = Post::where('slug', $slug)->first();

        return view('sitio.concursos.show', compact('post'));
    }
    
    public function autogestion(Request $request)
    {

        return view('sitio.autogestion');
    }


}
