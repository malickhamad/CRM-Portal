<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class HomepageSettingsSeeder extends Seeder
{
    public function run()
    {
        $homepageSettings = [
            'homepage_section_1_heading' => 'Welcome to Five Star Compliance',
            'homepage_section_1_desc' => 'We provide the best compliance services for your business.
            Our expert team ensures that you stay compliant with all regulations.
            With tailored solutions, we help businesses thrive and avoid penalties.
            Trust us to manage your compliance needs efficiently and professionally.',
        ];

        foreach ($homepageSettings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key, 'group' => 'homepage'],
                ['value' => $value]
            );
        }
    }
}
