<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Repositories\CursoRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\InscriptionRepository;
use JavaScript;

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

}
