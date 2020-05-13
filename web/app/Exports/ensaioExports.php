<?php

namespace App\Exports;

use App\laboratorio;
use App\sala1;
use App\sala2;
use App\exterior;
use App\ensaio;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ensaioExports implements FromQuery, WithHeadings, ShouldAutoSize
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

    // public function registerEvents(): array
    // {
    //     return [
    //         AfterSheet::class    => function (AfterSheet $event) {
    //             $cellRange = 'A1:W1'; // All headers
    //             $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
    //         },
    //     ];
    // }
    public function headings(): array
    {
        return [
            'Amostra',
            'Temperatura',
            'Umidade',
            'spUmid',
            'spTemp',
            'Data',
            'Gráfico',
            
        ];
    }

    public function query()
    {
        $ensaio = ensaio::find($this->id);
        $idAmbiente = $ensaio->id_ambiente;
        $dataI = $ensaio->dataI;
        $dataF = $ensaio->dataF;
        if ($idAmbiente == 1) {
            //SALA1
            return sala1::query()->select('id', 'temp', 'umid', 'spUmid', 'spTemp', 'created_at')->whereRaw("created_at >= ? AND created_at <= ?", array($dataI, $dataF));
        } elseif ($idAmbiente == 2) {
            //SALA2
            return sala2::query()->select('id', 'temp', 'umid', 'spUmid', 'spTemp', 'created_at')->whereRaw("created_at >= ? AND created_at <= ?", array($dataI, $dataF));
        } elseif ($idAmbiente == 3) {
            //LABORATORIO
            return laboratorio::query()->select('id', 'temp', 'umid', 'spUmid', 'spTemp', 'created_at')->whereRaw("created_at >= ? AND created_at <= ?", array($dataI, $dataF));
        } elseif ($idAmbiente ==4) {
            //EXTERIOR
            return exterior::query()->select('id', 'temp', 'umid', 'created_at')->whereRaw("created_at >= ? AND created_at <= ?", array($dataI, $dataF));
        }
    }
}
