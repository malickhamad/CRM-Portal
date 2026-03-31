<?php

namespace App\Http\Controllers\admin;

use App\Exports\PaymentsExport;
use App\Http\Controllers\Controller;
use App\Models\StripePayment;
use App\Models\SubscribtionPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PaymentHistoryController extends Controller
{
   public function index(Request $request)
    {
        $payments = StripePayment::with(['user', 'subscriptionPlan'])
            ->when($request->filled('from_date'), function($query) use ($request) {
                $query->whereDate('created_at', '>=', $request->from_date);
            })
            ->when($request->filled('to_date'), function($query) use ($request) {
                $query->whereDate('created_at', '<=', $request->to_date);
            })
            ->when($request->filled('plan'), function($query) use ($request) {
                $query->whereHas('subscriptionPlan', function($q) use ($request) {
                    $q->where('id', $request->plan);
                });
            })
            ->when($request->filled('status'), function($query) use ($request) {
                $query->where(function($q) use ($request) {
                    $now = now();
                    switch ($request->status) {
                        case 'active':
                            $q->where('is_active', true)
                              ->whereHas('subscriptionPlan', function($q) use ($now) {
                                  $q->where(function($q) use ($now) {
                                      $q->where('billing_cycle', 'lifetime')
                                        ->orWhere(function($q) use ($now) {
                                            $q->whereNotNull('billing_cycle')
                                              ->where('billing_cycle', '!=', 'lifetime')
                                              ->where('created_at', '>=', $now->copy()->subMonth());
                                        });
                                  });
                              });
                            break;
                        case 'expired':
                            $q->where(function($q) use ($now) {
                                $q->where('is_active', false)
                                  ->orWhereHas('subscriptionPlan', function($q) use ($now) {
                                      $q->whereNotNull('billing_cycle')
                                        ->where('billing_cycle', '!=', 'lifetime')
                                        ->where('created_at', '<', $now->copy()->subMonth());
                                  });
                            });
                            break;
                        case 'expiring_soon':
                            $q->where('is_active', true)
                              ->whereHas('subscriptionPlan', function($q) use ($now) {
                                  $q->whereNotNull('billing_cycle')
                                    ->where('billing_cycle', '!=', 'lifetime')
                                    ->whereBetween('created_at', [
                                        $now->copy()->subMonth()->addDays(23),
                                        $now->copy()->subMonth()->addDays(30)
                                    ]);
                              });
                            break;
                    }
                });
            })
            ->latest()
            ->get();

        // Calculate stats based on filtered results
        $activeCount = $payments->filter(function($payment) {
            if (!$payment->subscriptionPlan || !$payment->created_at) return false;

            $expirationDate = $this->calculateExpirationDate(
                $payment->created_at,
                $payment->subscriptionPlan->billing_cycle
            );

            return $payment->is_active && (!$expirationDate || now()->lte($expirationDate));
        })->count();

        $stats = [
            'totalPayments' => $payments->count(),
            'totalRevenue' => $payments->sum('amount'),
            'activeSubscriptions' => $activeCount
        ];

        $plans = SubscribtionPlan::all();

        if ($request->has('export')) {
            return Excel::download(new PaymentsExport($payments), 'payments-'.now()->format('Y-m-d').'.xlsx');
        }

        return view('backend.payments-history.index', compact('payments', 'stats', 'plans'));
    }

    /**
     * Calculate expiration date based on billing cycle
     */
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
