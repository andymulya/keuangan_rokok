<?php

namespace App\Exports;

use App\Models\HasilInputOperator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class OperatorExport implements
FromCollection,
WithEvents,
WithColumnFormatting,
WithMapping,
ShouldAutoSize,
WithHeadings
{
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $workSheet = $event->sheet->getDelegate();
                $workSheet->freezePane("A2");
            }
        ];
    }

    public function collection(): Collection
    {
        $i = 1;
        return HasilInputOperator::all();
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->lb_black,
            $row->bat,
            $row->pem,
        ];
    }

    public function columnFormats(): array
    {
        return [
            "A" => NumberFormat::FORMAT_TEXT,
            "B" => NumberFormat::FORMAT_TEXT,
            "C" => NumberFormat::FORMAT_TEXT,
            "D" => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'LB Black',
            'BAT',
            'PEM'
        ];
    }
}
