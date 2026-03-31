<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;
use App\Models\StripePayment;
use App\Mail\SubscriptionExpiredMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendSubscriptionReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredPayments = StripePayment::where('is_active', false)
            ->where('ends_at', '<', Carbon::now())
            ->with('user')
            ->get();

        foreach ($expiredPayments as $payment) {
            if ($payment->user) {
                Mail::to($payment->user->email)->send(new SubscriptionExpiredMail($payment->user));
            }
        }

        $this->info('Subscription reminders sent!');
    }
}
