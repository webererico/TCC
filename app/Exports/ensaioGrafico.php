<?php

namespace App\Exports;

use App\Ensaio;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\BeforeSheet;
use \Maatwebsite\Excel\Writer;

class ensaioGrafico implements WithEvents
{
    /**

    */
    public function registerEvents(): array
    {
        return [
            // Handle by a closure.
            BeforeExport::class => function (BeforeExport $event) {
                // $event->writer->getProperties()->setCreator('Patrick');
                Writer::macro('setCreator', function (Writer $writer, string $creator) {
                    $writer->getDelegate()->getProperties()->setCreator($creator);
                });
            },
            // Array callable, refering to a static method.
            BeforeWriting::class => [self::class, 'beforeWriting'],
            // Using a class with an __invoke method.
            BeforeSheet::class => new BeforeSheetHandler()
        ];
    }
    public static function beforeWriting(BeforeWriting $event)
    {
        //
    }
}
