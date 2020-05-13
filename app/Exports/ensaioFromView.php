<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use App\laboratorio;
use App\sala1;
use App\sala2;
use App\exterior;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;

class ensaioFromView implements FromQuery, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function __construct($id)
    {
        $this->id = $id;
        return $this;
    }
    public function headings(): array
    {
        return [
            'Amostra',
            'spTemp',
            'spUmid',
            'Umidade',
            'Temperatura',
            'erro Umid',
            'erro Temp',
            '',
            'Data',
            
        ];
    }
    public function query()
    {
        if ($this->id ==1) {
            return sala1::query();
        } elseif ($this->id ==2) {
            return sala2::query();
        } elseif ($this->id ==3) {
            return laboratorio::query();
        } elseif ($this->id ==4) {
            return exterior::query();
        }
    }
}
