<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function index()
    {
        // Group settings by their group name
        $settings = Setting::all()->groupBy('group');

        // Convert each group's settings to key-value pairs
        $siteSettings = $settings->get('site', collect())->pluck('value', 'key');
        $emailSettings = $settings->get('email', collect())->pluck('value', 'key');
        $homepageSettings = $settings->get('homepage', collect())->pluck('value', 'key');
        $paymentSettings = $settings->get('payment', collect())->pluck('value', 'key');

        return view('backend.settings.site-settings.index', compact(
            'siteSettings',
            'emailSettings',
            'homepageSettings',
            'paymentSettings'
        ));
    }

    public function create()
    {
        return view('settings.create');
    }

    public function store(Request $request)
{
    $section = $request->input(key: 'section');

    // Define validation rules for each section
    $validationRules = [
        'site' => [
            'site_logo' => 'nullable|image|mimes:png,jpg,jpeg',
            'favicon' => 'nullable|image|mimes:png,jpg,jpeg,ico',
            'site_name' => 'required|string|max:255',
            'site_title' => 'required|string|max:255',
            'site_slogan' => 'nullable|string|max:255',
            'primary_phone' => 'nullable|string|max:255',
            'secondary_phone' => 'nullable|string|max:255',
            'from_email' => 'nullable|email|max:255',
            'to_email' => 'nullable|email|max:255',
            'from_email_name' => 'nullable|string|max:255',
            'to_email_name' => 'nullable|string|max:255',
            'default_currency' => 'nullable|string|max:3',
            'street_address' => 'nullable|string|max:255',
            'site_google_map' => 'nullable|string',
        ],
        'email' => [
            'mail_driver' => 'required|string|max:10',
            'smtp_server' => 'required_if:mail_driver,smtp|string|max:255',
            'mail_host' => 'required_if:mail_driver,smtp|string|max:255',
            'mail_port' => 'required_if:mail_driver,smtp|string|max:5',
            'mail_encryption' => 'required_if:mail_driver,smtp|string|max:5',
            'mail_username' => 'required_if:mail_driver,smtp|string|max:255',
            'mail_password' => 'required_if:mail_driver,smtp|string|max:255',


        ],
        'homepage' => [
            'homepage_section_1_heading' => 'nullable|string|max:255',
            'homepage_section_1_desc' => 'nullable|string',
        ],
        'payment' => [
            'stripe_secret_key' => 'nullable|string|max:255',
            'stripe_api_key' => 'nullable|string|max:255',
            'stripe_active' => 'nullable|string|max:3',
        ]
    ];

    // Validate only the relevant section's fields
    $validatedData = $request->validate(rules: $validationRules[$section] ?? []);

    // Handle file uploads for site section
    if ($section === 'site') {
        if ($request->hasFile('site_logo')) {
            $validatedData['site_logo'] = $request->file('site_logo')->store('logos', 'public');
        }

        if ($request->hasFile('favicon')) {
            $validatedData['favicon'] = $request->file('favicon')->store('favicons', 'public');
        }
    }

    // Store each setting with the correct group
    foreach ($validatedData as $key => $value) {
        if ($value !== null) {
            Setting::updateOrCreate(
                ['key' => $key, 'group' => $section],
                ['value' => $value]
            );
        }
    }

    return redirect()->back()->with('success', ucfirst($section) . ' settings saved successfully!');
}
    public function edit(Setting $setting)
    {
        return view('backend.settings.site-settings.edit', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'key_name' => 'required|unique:settings,key_name,' . $setting->id,
            'value' => 'nullable',
            'group_name' => 'nullable|string|max:100',
        ]);

        $setting->update($request->all());
        return redirect()->route('admin.settings.index')->with('success', 'Setting updated successfully.');
    }

    public function updateGroupSettings(Request $request)
    {
        $settings = $request->all();

        foreach ($settings as $group => $groupSettings) {
            foreach ($groupSettings as $key => $value) {
                Setting::updateOrCreate(
                    ['key_name' => "{$group}.{$key}"],
                    ['value' => $value]
                );
            }
        }

        return redirect()->route('settings.index')->with('success', 'Settings updated successfully!');
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();
        return redirect()->route('admin.settings.index')->with('success', 'Setting deleted successfully.');
    }

    // Helper function to determine the group for each setting
    private function getGroupForSetting($key)
    {
        $groupMapping = [
            // Site settings
            'site_logo' => 'site',
            'favicon' => 'site',
            'site_name' => 'site',
            'site_title' => 'site',
            'site_slogan' => 'site',
            'primary_phone' => 'site',
            'secondary_phone' => 'site',
            'from_email' => 'site',
            'to_email' => 'site',
            'from_email_name' => 'site',
            'to_email_name' => 'site',
            'default_currency' => 'site',
            'street_address' => 'site',
            'site_google_map' => 'site',

            // Email settings
            'mail_driver' => 'email',
            'smtp_server' => 'email',
            'mail_host' => 'email',
            'mail_port' => 'email',
            'mail_encryption' => 'email',
            'mail_username' => 'email',
            'mail_password' => 'email',

            // Homepage settings
            'homepage_section_1_heading' => 'homepage',
            'homepage_section_1_desc' => 'homepage',

            // Payment settings
            'stripe_secret_key' => 'payment',
            'stripe_api_key' => 'payment',
            'stripe_active' => 'payment',
        ];

        return $groupMapping[$key] ?? 'general'; // Default to 'general' group if not mapped
    }
}
