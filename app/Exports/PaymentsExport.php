<?php

namespace App\Exports;

use App\Models\StripePayment;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PaymentsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $payments;

    public function __construct($payments)
    {
        $this->payments = $payments;
    }

    public function collection()
    {
        return $this->payments;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Customer Name',
            'Customer Email',
            'Company Name',
            'Plan Name',
            'Billing Cycle',
            'Amount',
            'Currency',
            'Purchase Date',
            'Expiration Date',
            'Status',
            'Payment Method',
            'Transaction Reference'
        ];
    }

    public function map($payment): array
    {
        $expirationDate = $payment->subscriptionPlan ? $this->calculateExpirationDate(
            $payment->created_at,
            $payment->subscriptionPlan->billing_cycle
        ) : null;

        $isActive = $payment->is_active && (!$expirationDate || now()->lte($expirationDate));
        $isExpired = $expirationDate && now()->gt($expirationDate);
        $isExpiringSoon = $expirationDate && now()->diffInDays($expirationDate, false) <= 7 && !$isExpired;

        $status = 'Unknown';
        if ($payment->subscriptionPlan) {
            if ($isActive) {
                $status = $isExpiringSoon ? 'Expiring Soon' : 'Active';
            } else {
                $status = 'Expired';
            }
        }

        return [
            $payment->id,
            $payment->user->name ?? 'N/A',
            $payment->user->email ?? 'N/A',
            $payment->user->company_name ?? 'N/A',
            $payment->subscriptionPlan->name ?? 'N/A',
            $payment->subscriptionPlan ? ucfirst($payment->subscriptionPlan->billing_cycle) : 'N/A',
            $payment->amount,
            $payment->currency,
            $payment->created_at->format('Y-m-d H:i:s'),
            $expirationDate ? $expirationDate->format('Y-m-d H:i:s') : 'N/A',
            $status,
            ucfirst($payment->payment_method),
            $payment->transaction_reference ?? $payment->cheque_number ?? 'N/A'
        ];
    }

    protected function calculateExpirationDate($startDate, $billingCycle)
    {
        $expirationDate = Carbon::parse($startDate);

        switch ($billingCycle) {
            case 'monthly':
                return $expirationDate->addMonth();
            case 'yearly':
                return $expirationDate->addYear();
            case 'weekly':
                return $expirationDate->addWeek();
            case 'daily':
                return $expirationDate->addDay();
            default:
                return $expirationDate->addMonth();
        }
    }
}
