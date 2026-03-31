<?php

namespace App\Providers;

use App\Models\Section;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use App\Models\StripePayment;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // Check if settings table exists before trying to use it
        if (Schema::hasTable('settings')) {
            // Configure SMTP if settings table exists
            configure_smtp_from_db();

            // Only try to get settings if the table exists
            $settings = Setting::all()->groupBy('group');

            // Convert grouped settings into key-value collections
            $siteSettings = $settings->get('site', collect())->pluck('value', 'key');
            $emailSettings = $settings->get('email', collect())->pluck('value', 'key');
            $homepageSettings = $settings->get('homepage', collect())->pluck('value', 'key');
            $paymentSettings = $settings->get('payment', collect())->pluck('value', 'key');

            // Share with all views
            View::share([
                'siteSettings' => $siteSettings,
                'emailSettings' => $emailSettings,
                'homepageSettings' => $homepageSettings,
                'paymentSettings' => $paymentSettings,
            ]);
        } else {
            // Provide empty collections if settings table doesn't exist
            View::share([
                'siteSettings' => collect(),
                'emailSettings' => collect(),
                'homepageSettings' => collect(),
                'paymentSettings' => collect(),
            ]);
        }

    }



}
