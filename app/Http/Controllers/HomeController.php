<?php

namespace App\Http\Controllers;

use App\File;
use App\User;
use App\Curso;
use JavaScript;
use App\Helpers\Utils;
use App\Filters\FileFilter;
use App\Filters\UserFilter;
use App\InscriptionPayment;
use App\Filters\CursoFilter;
use Illuminate\Http\Request;
use App\Filters\PaymentFilter;
use App\Repositories\PaymentRepository;
use App\Repositories\InscriptionRepository;

class HomeController extends Controller
{
    private $inscriptionRepository;
    private $paymentsRepository;

	public function __construct( 
        InscriptionRepository $inscriptionRepository,
        PaymentRepository $paymentsRepository)
    {
        $this->middleware('auth');
        $this->inscriptionRepository = $inscriptionRepository;
        $this->paymentsRepository = $paymentsRepository;
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        JavaScript::put([
            'jsVerifiedUsersCountData' => Utils::verifiedUsersData(),
            'jsInscriptionChannels' => Utils::inscriptionChannels(),
        ]);

        $payments = $this->paymentsRepository->getLastPayments();
        $inscriptions = $this->inscriptionRepository->getLastInscriptions(10);

        //dd($inscriptions);

        return view('admin.dashboard', compact('payments', 'inscriptions'));
    }

    public function search(Request $request)
    {
        $userFilter = new UserFilter($request);
        $paymentFilter = new PaymentFilter($request);
        $fileFilter = new FileFilter($request);
        $cursoFilter = new CursoFilter($request);

        
        $users = User::filter($userFilter)
            ->orderBy('created_at', 'DESC')
            ->paginate(15)
            ->setPageName('userPage')
            ->appends($userFilter->request->query());
        
        $payments = InscriptionPayment::filter($paymentFilter)
        ->orderBy('created_at', 'DESC')
        ->paginate(15)
        ->setPageName('paymentPage')
        ->appends($paymentFilter->request->query());

        $files = File::filter($fileFilter)
                        ->orderBy('created_at', 'DESC')
                        ->paginate(15)
                        ->setPageName('filePage')
                        ->appends($fileFilter->request->query());

        $cursos = Curso::filter($cursoFilter)
                        ->orderBy('created_at', 'DESC')
                        ->paginate(15)
                        ->setPageName('cursoPage')
                        ->appends($cursoFilter->request->query());


        return view('admin.search.index', compact('users', 'payments', 'files', 'cursos'));
    }

}
