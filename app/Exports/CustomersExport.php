<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CustomersExport implements FromCollection, WithHeadings, WithMapping
{
    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function collection()
    {
        return $this->users;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Business Name',
            'Phone',
            'Country',
            'Status',
            'Created At',
            'Current Plan',
            'Plan Price',
            'Plan Billing Cycle'
        ];
    }

    public function map($user): array
    {
        $currentPlan = $user->stripePayments->first()?->subscriptionPlan;

        return [
            $user->id,
            $user->name,
            $user->email,
            $user->business_name,
            $user->phone,
            $user->country,
            ucfirst($user->status),
            $user->created_at->format('Y-m-d H:i:s'),
            $currentPlan?->name ?? 'N/A',
            $currentPlan ? '$' . number_format($currentPlan->price, 2) : 'N/A',
            $currentPlan?->billing_cycle ?? 'N/A'
        ];
    }
}
