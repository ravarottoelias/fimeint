<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Inscripcion;
use Illuminate\Http\Request;
use App\Exports\CursoAlumnosExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Interfaces\InscriptionRepositoryInterface;

class ExportExcelController extends Controller
{

    private $inscriptionRepository;

	public function __construct(InscriptionRepositoryInterface $inscriptionRepository){

        $this->inscriptionRepository = $inscriptionRepository;

    }
    
    public function exportToExcel(Request $request, Curso $curso)
	{

		$filename = 'Inscriptos - ' . $curso->titulo . '.xlsx';

		$collection = $this->getCollectionInscriptionByPaymentStatus($request, $curso);

		return (new CursoAlumnosExport($collection))->download($filename);

	    return Excel::download(new CursoAlumnosExport($curso), $filename);
	}

	private function getCollectionInscriptionByPaymentStatus($request, $curso)
	{
		switch ($request->input('payment_status')) {
            case Inscripcion::PAGADO:
                $collection = $this->inscriptionRepository->getInscriptionsByStatusToExport($curso, Inscripcion::PAGADO);
                break;

			case Inscripcion::PENDIENTE:
				$collection = $this->inscriptionRepository->getInscriptionsWithOutPaymentToExport($curso);
				break;

            default:
				$collection = $this->inscriptionRepository->getInscriptionsByCursoToExport($curso);
                break;
        }

		return $collection;
	}
}
