<?php

declare(strict_types=1);

namespace App\Exports;

use stdClass;
use App\Helpers\Utils;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CursoCertificatesExport implements FromCollection,WithHeadings, ShouldAutoSize, WithEvents
{
    use Exportable;
    
    protected $certificatesCollection;
    protected $titleSheet;

    public function __construct($certificatesCollection)
    {
        $this->certificatesCollection = $certificatesCollection;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $firstElement = $this->certificatesCollection[0];

        $this->titleSheet = $firstElement->cursoNombre . ' ' . $firstElement->cursoFechaInicio;
        $this->certificatesCollection = $this->insertBlanksOnTomoChange($this->certificatesCollection);
        
        return $this->certificatesCollection
                    ->map(function ($item) {
                        return Utils::onlyFromStdClass($item, ['certificadoNumero', 'alumnoCuit', 'alumnoNombreCompleto', 'tfCertificadoNumero', 'createdAt']);
                    });

    }

    public function headings() :array
    {
        return ["NÚMERO CERTIFICADO", "DNI", "APELLIDO Y NOMBRE", "TOMO Y FOLIO", "FECHA INICIO"];
    }


    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                 // Insertar una fila arriba como título
                $sheet = $event->sheet;
                $sheet->insertNewRowBefore(1, 1);
                $sheet->setCellValue('A1', $this->titleSheet);

                // Combinar celdas A1 y E1 (ajustar según cantidad de columnas)
                $sheet->mergeCells('A1:E1');

                // Aplicar estilo al título
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(13);
            },
        ];
    }

    
    /**
     * Inserta un objeto vacío cada vez que cambie la propiedad 'tomo'.
     *
     * @param  Collection|array  $items  Colección o arreglo de objetos que tengan la propiedad 'tomo'.
     * @return Collection  Nueva colección con objetos en blanco intercalados.
     */
    function insertBlanksOnTomoChange($items): Collection
    {
        $collection = collect($items);
        $result     = collect();
        $lastTomo   = null;

        $empty = new stdClass();
        $empty->tfCertificadoNumero = "";
        foreach ($collection as $item) {
            // Extraemos el valor actual de 'tomo' (puede ser null)
            $currentTomo = $item->tfCertificadoNumero ?? null;

            // Si ya había un tomo previo y difiere del actual, insertamos un objeto vacío
            if ($lastTomo !== null && $currentTomo != $lastTomo) {
                $result->push($empty);
            }

            // Siempre agregamos el elemento actual
            $result->push($item);

            // Actualizamos para la siguiente iteración
            $lastTomo = $currentTomo;
        }

        return $result;
    }
}
