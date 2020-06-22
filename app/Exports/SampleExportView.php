<?php

namespace App\Exports;

use App\Sample;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\BeforeSheet;

class SampleExportView implements FromView, WithColumnFormatting, WithEvents
{
    public function view(): View
    {
        // return Sample::all();
        $all = Sample::all();
        return view('exports.sample_excel', [
            'objs' => $all
        ]);


        // or

        // return view('exports.xml', [
        //     'data' => [
        //       [
        //         'name' => 'Povilas',
        //         'surname' => 'Korop',
        //         'email' => 'povilas@laraveldaily.com',
        //         'twitter' => '@povilaskorop'
        //       ],
        //       [
        //         'name' => 'Taylor',
        //         'surname' => 'Otwell',
        //         'email' => 'taylor@laravel.com',
        //         'twitter' => '@taylorotwell'
        //       ]
        //     ]
        // ]);
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'G' => NumberFormat::FORMAT_DATE_DDMMYYYY,

            // 'F' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
            // 'G' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
        ];
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            BeforeExport::class  => function (BeforeExport $event) {
                // $event->writer->setCreator('Patrick');
            },
            AfterSheet::class    => function (AfterSheet $event) {
                $event->sheet->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

                $event->sheet->styleCells(
                    'A2:G2',
                    [
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                                'color' => ['argb' => 'FFFF0000'],
                            ],
                        ],
                        'alignment' => [
                                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            ],
                            'font' => [
                                    'name' => 'Century Gothic',
                                    'size' => 11,
                                    'bold' => true,
                                    'color' => ['argb' => 'EB2B02'],
                            ],
                            'background' => [
                                'color' => ['argb' => 'EB2B02'],
                            ]
                    ]
                );
            },
        ];
    }
}
