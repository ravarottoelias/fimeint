<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\CursoRepositoryInterface;
use App\Interfaces\InscriptionRepositoryInterface;

class HomeController extends Controller
{
    private $inscriptionRepository;
    private $cursoRepository;

	public function __construct( 
        InscriptionRepositoryInterface $inscriptionRepository,
        CursoRepositoryInterface $cursoRepository)
    {
        $this->middleware('auth');
        $this->inscriptionRepository = $inscriptionRepository;
        $this->cursoRepository = $cursoRepository;
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

        $payments = $this->inscriptionRepository->getLastPayments();
        $cursos = $this->cursoRepository->findCursosEnCurso();

        return view('admin.dashboard', compact('payments', 'cursos'));
    }

}
