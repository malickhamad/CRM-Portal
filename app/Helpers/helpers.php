<?php

// Format HTML Tag

use App\Http\Controllers\User\ReportController;
use App\Models\PaymentStandard;
use App\Models\Section;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;


if (!function_exists('configure_smtp_from_db')) {
    function configure_smtp_from_db()
    {

        $smtp = Setting::where('group', 'email')->get();

        if ($smtp->isNotEmpty()) {
            Config::set('mail.mailers.smtp', [
                'transport' => 'smtp',
                'host' => @$smtp->where('key', 'mail_host')->first()->value,
                'port' => @$smtp->where('key', 'mail_port')->first()->value,
                'encryption' => @$smtp->where('key', 'mail_encryption')->first()->value,
                'username' => @$smtp->where('key', 'mail_username')->first()->value,
                'password' => @$smtp->where('key', 'mail_password')->first()->value,
                'timeout' => null,
                'auth_mode' => null,
            ]);

            $site_settings = Setting::where('group', 'site')->get();

            if ($site_settings->isNotEmpty()) {
                Config::set('mail.from', [
                    'address' => @$site_settings->where('key', 'from_email')->first()->value,
                    'name' => @$site_settings->where('key', 'from_email_name')->first()->value,
                ]);
            } else {
                Config::set('mail.from', [
                    'address' => @$smtp->where('key', 'mail_username')->first()->value ?? 'hello@gmail.com',
                    'name' => 'Five Star Compliance',
                ]);
                Log::error('Set (From Emial Address) & (From Emial Name) in site settings.');
            }
        } else {
            Log::error('Set Email SMTP in site settings.');
        }
    }
}

function get_user_purchased_standards(): array
{
    try {
        $user = Auth::user();
        $currentSectionId = request()->route('sectionId'); // Get current section ID from URL

        // If user is a subuser (has a parent), get their assigned standards
        if ($user->parent_id) {
            $standards = $user->standards()->with('sections')->get();
        }
        // If user is a main user, get their purchased standards
        else {
            $standards = $user->paymentStandards()->with('sections')->get();
        }

        return $standards->map(function ($standard) use ($currentSectionId) {
            return [
                'standard_id' => $standard->id,
                'standard_name' => $standard->name,
                'sections' => $standard->sections->map(function ($section) use ($currentSectionId) {
                    return [
                        'id' => $section->id,
                        'name' => $section->name,
                        'url' => route('user.mcqs.useranswers', $section->id),
                        'is_current' => $section->id == $currentSectionId // Flag for current section
                    ];
                })->toArray()
            ];
        })->toArray();
    } catch (\Exception $e) {
        \Log::error("Error in get_user_purchased_standards: " . $e->getMessage());
        return [];
    }
}


function calculateSectionRisk($userAnswers)
{
    $controller = new ReportController();
    return $controller->calculateRiskData($userAnswers);
}


if (!function_exists('configure_stripe_from_db')) {
    function configure_stripe_from_db()
    {
        $paymentSettings = Setting::where('group', 'payment')->get();

        if ($paymentSettings->isNotEmpty()) {
            Config::set('services.stripe', [
                'secret' => $paymentSettings->where('key', 'stripe_secret_key')->first()->value,
                'key' => $paymentSettings->where('key', 'stripe_api_key')->first()->value,
            ]);
        } else {
            Log::error('Stripe payment settings are not configured in the database.');
        }
    }
}


if (!function_exists('html_tag_format')) {
    function html_tag_format($tag)
    {

        if ($tag) {

            if ($tag->is_self_closing == true) {
                $formatted_html_tag = '<' . $tag->tag . '/>';
            } else {
                $formatted_html_tag = '<' . $tag->tag . '>' . '<' . $tag->tag . '/>';
            }

            return $formatted_html_tag;
        }
    }
}


if (!function_exists('configure_stripe_from_db')) {
    function configure_stripe_from_db()
    {
        $paymentSettings = Setting::where('group', 'payment')->get();

        if ($paymentSettings->isNotEmpty()) {
            Config::set('services.stripe', [
                'secret' => $paymentSettings->where('key', 'stripe_secret_key')->first()->value,
                'key' => $paymentSettings->where('key', 'stripe_api_key')->first()->value,
            ]);
        } else {
            Log::error('Stripe payment settings are not configured in the database.');
        }
    }
}
