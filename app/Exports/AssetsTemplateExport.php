<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class AssetsTemplateExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return collect([]); // No data rows, only headings
    }

    public function headings(): array
    {
        return [
            'asset_id',
            'type',
            'status',
            'ephi',
            'encryption',
            'assignment',
            'location',
            'disposal_status',
            'disposed_date',
            'comments'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Apply bold font to heading row
        $sheet->getStyle('A1:J1')->getFont()->setBold(true);

        // Apply background color to heading row
        $sheet->getStyle('A1:J1')->getFill()->setFillType('solid')->getStartColor()->setRGB('D9E1F2');

        // Set date format for 'disposed_date' column (column I)
        $sheet->getStyle('I')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDD2);

        return [];
    }
}
