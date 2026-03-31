<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\StripePayment;
use Carbon\Carbon;

class ExpireSubscriptions extends Command
{
    protected $signature = 'subscriptions:expire';
    protected $description = 'Deactivate expired subscriptions';

    public function handle()
    {
        $expiredSubscriptions = StripePayment::where('is_active', true)
            ->where('ends_at', '<', Carbon::now())
            ->update(['is_active' => false]);

        $this->info("Expired Subscriptions Deactivated: $expiredSubscriptions");
    }
}
