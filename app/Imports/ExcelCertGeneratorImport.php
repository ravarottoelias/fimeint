<?php

namespace App\Imports;

use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToArray;
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
            if(strlen($element->dni)>0 || strlen($element->nombre)>0){
                Log::info("Importando fila $index Nombre: {$element->nombre}, DNI: {$element->dni}");
                array_push($this->data, $element);
            }
        }
    }

    public function getData()
    {
        return $this->data;
    }
}
