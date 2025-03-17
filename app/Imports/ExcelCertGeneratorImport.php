<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;
use stdClass;

class ExcelCertGeneratorImport implements ToArray
{

    public $data = [];

    public function array(array $rows)
    {
        foreach ($rows as $index => $row) {
            $element = new stdClass();
            // Saltar la primera fila si es un encabezado
            if ($index === 0) continue;

            // Obtener los valores de las columnas
            $element->dni = trim($row[0]);
            $element->nombre = trim($row[1]);
            
            // Mostrar en logs
            Log::info("Nombre: {$element->nombre}, DNI: {$element->dni}");
            array_push($data, $element);
        }
    }

    public function getData()
    {
        return $this->data;
    }
}
