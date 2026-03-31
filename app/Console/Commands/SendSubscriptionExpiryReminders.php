<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StripePayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionExpiringSoon;

class SendSubscriptionExpiryReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:send-expiry-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email reminders for subscriptions ending in 2 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
         // Get subscriptions ending in exactly 2 days
         $twoDaysFromNow = Carbon::now()->addDays(2)->endOfDay();

         $expiringSubscriptions = StripePayment::where('is_active', true)
             ->whereDate('ends_at', $twoDaysFromNow->toDateString())
             ->with('user') // assuming you have a user relationship
             ->get();

         foreach ($expiringSubscriptions as $subscription) {
             if ($subscription->user) {
                 Mail::to($subscription->user->email)
                     ->send(new SubscriptionExpiringSoon($subscription));

                 $this->info("Sent reminder to: {$subscription->user->email}");
             }
         }

         $this->info("Sent {$expiringSubscriptions->count()} reminders.");
    }
}
