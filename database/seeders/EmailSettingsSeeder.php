<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class EmailSettingsSeeder extends Seeder
{
    public function run()
    {
        $emailSettings = [
            'mail_driver' => 'smtp',
            'smtp_server' => 'smtp.mailtrap.io',
            'mail_host' => 'smtp.mailtrap.io',
            'mail_port' => '587',
            'mail_encryption' => 'tls',
            'mail_username' => 'your_smtp_username',
            'mail_password' => 'your_smtp_password',
        ];

        foreach ($emailSettings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key, 'group' => 'email'],
                ['value' => $value]
            );
        }
    }
}
