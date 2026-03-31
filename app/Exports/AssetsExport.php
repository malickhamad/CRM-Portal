<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AssetsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $assets;

    public function __construct(array $assets)
    {
        $this->assets = $assets;
    }

    public function collection()
    {
        return collect($this->assets);
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

    public function map($asset): array
    {
        return [
            $asset['asset_id'],
            $asset['type'],
            $asset['status'],
            $asset['ephi'],
            $asset['encryption'],
            $asset['assignment'],
            $asset['location'],
            $asset['disposal_status'],
            $asset['disposed_date'],
            $asset['comments'],
        ];
    }
}
