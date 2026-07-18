<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::command('subscriptions:expire')->daily(); // Runs every day at midnight
Schedule::command('subscriptions:remind')->daily();
Schedule::command('subscriptions:send-expiry-reminders')->daily();

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
