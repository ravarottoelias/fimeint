<?php

namespace App\Exports;

use App\Curso;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CursoAlumnosExport implements FromCollection,WithHeadings, ShouldAutoSize, WithEvents
{
    use Exportable;

	protected $inscriptionCollection;

    public function __construct($inscriptionCollection)
    {
        $this->inscriptionCollection = $inscriptionCollection;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        foreach ($this->inscriptionCollection as $insc) {
           $insc->alumno = $insc->alumno()->first();
           $insc->name = $insc->alumno->fullName();
           $insc->email = $insc->alumno->email;
           $insc->documento_tipo = $insc->alumno->documento_tipo;
           $insc->documento_nro = $insc->alumno->documento_nro;
           $insc->cuit = $insc->alumno->cuit;
           $insc->pais = $insc->alumno->pais;
           $insc->provincia = $insc->alumno->provincia;
           $insc->DetalleMecadopago = $insc->payment_id_mp . " - " . $insc->payment_status_mp;
        }

        return $this->inscriptionCollection
                    ->map
                    ->only(['name', 'email', 'documento_tipo', 'documento_nro', 'cuit', 'pais', 'provincia', 'estado_del_pago', 'DetalleMecadopago' ]);


    }

    public function headings() :array
    {
        return ["Apellido y Nombre", "Email", "Tipo Documento", "Número Documento", 'CUIT', "Pais", "Provincia", "Estado del Pago", "Detalle Mercadopago"];
    }


    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(13);
            },
        ];
    }
}
