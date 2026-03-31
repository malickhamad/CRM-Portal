<?php

namespace App\Imports;

use App\Models\Asset;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class AssetsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, SkipsEmptyRows
{
    use SkipsFailures, SkipsErrors;

    private $results = [
        'total_rows' => 0,
        'created' => 0,
        'updated' => 0,
        'duplicates_skipped' => 0,
        'failures' => 0,
    ];

    public function model(array $row)
    {
        $this->results['total_rows']++;

        // Skip if required fields are missing
        if (empty($row['asset_id'])) {
            $this->results['failures']++;
            return null;
        }

        // Format disposed_date if it exists
        $disposedDate = null;
        if (!empty($row['disposed_date'])) {
            try {
                $disposedDate = Carbon::parse($row['disposed_date'])->format('Y-m-d');
            } catch (\Exception $e) {
                $this->results['failures']++;
                return null;
            }
        }

        // Always create new record (don't check for duplicates)
        $this->results['created']++;
        return new Asset([
            'asset_id' => $row['asset_id'],
            'type' => $row['type'],
            'status' => $row['status'],
            'ephi' => $row['ephi'],
            'encryption' => $row['encryption'],
            'assignment' => $row['assignment'],
            'location' => $row['location'],
            'disposal_status' => $row['disposal_status'],
            'disposed_date' => $disposedDate,
            'comments' => $row['comments'],
            'created_by' => Auth::id(),
        ]);
    }

    public function rules(): array
    {
        return [
            'asset_id' => 'required',
            'type' => 'required|string',
            'status' => 'required|string',
            'ephi' => 'required|string',
            'encryption' => 'required|string',
            'location' => 'required|string',
            'disposal_status' => 'nullable|string',
            'disposed_date' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    if (!empty($value)) {
                        try {
                            Carbon::parse($value);
                        } catch (\Exception $e) {
                            $fail('The '.$attribute.' is not a valid date format (use YYYY-MM-DD).');
                        }
                    }
                }
            ],
            'comments' => 'nullable|string',
        ];
    }

    public function getImportResults()
    {
        return $this->results;
    }
}
