<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSettingsSeeder extends Seeder
{

        public function run()
    {
        $siteSettings = [
            'section' => 'site',
            'site_logo' => 'asset/backend/images/fivestarlogo.png', // replace with your default image path
            'favicon' => 'asset/backend/images/fivestarlogo.png', // replace with your default favicon path
            'site_title' => 'Five Star Compliance',
            'site_name' => 'Five Star Compliance',
            'site_slogan' => 'The best site for awesome people!',
            'primary_phone' => '+1 234 567 890',
            'secondary_phone' => '+1 234 567 891',
            'from_email' => 'no-reply@fivestarcompliance.com',
            'to_email' => 'support@fivestarcompliance.com',
            'from_email_name' => 'fivestarcompliance Support',
            'to_email_name' => 'fivestarcompliance Admin',
            'default_currency' => 'USD',
            'street_address' => '123 Awesome St, Suite 101, City, Country',
            'site_google_map' => '<iframe src="https://www.google.com/maps/embed?..."></iframe>',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        foreach ($siteSettings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key, 'group' => 'site'],
                ['value' => $value]
            );
        }
    }
}
