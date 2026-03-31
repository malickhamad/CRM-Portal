@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')
        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">Site Settings</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">Site Settings</li>
                </ul>
            </div>

            <!-- Tab navigation -->
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-pills nav-fill card-header-tabs" id="settingsTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="site-tab" data-bs-toggle="tab" data-bs-target="#site"
                                type="button" role="tab">Site</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="email-tab" data-bs-toggle="tab" data-bs-target="#email"
                                type="button" role="tab">Emails</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="homepage-tab" data-bs-toggle="tab" data-bs-target="#homepage"
                                type="button" role="tab">Homepage</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment"
                                type="button" role="tab">Payment Gateways</button>
                        </li>
                    </ul>
                </div>

                <!-- Tab Content -->
                <div class="card-body tab-content" id="settingsTabsContent">

                    <!-- Site Tab -->
                    <div class="tab-pane fade show active" id="site" role="tabpanel">
                        <h4 class='card-title text-success-1000 mb-3'>Site Settings</h4>
                        <form action="{{ route('admin.settings.store') }}" method="POST" class="row gy-3 needs-validation"
                            novalidate enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="section" value="site">

                            <!-- Site Logo -->
                            <div class="col-md-6">
                                <label class="form-label">Site Logo</label>
                                <div>
                                    @if (isset($siteSettings['site_logo']) && file_exists(storage_path('app/public/' . $siteSettings['site_logo'])))
                                        <img src="{{ asset('storage/' . $siteSettings['site_logo']) }}" alt="Site Logo"
                                            width="100" height="100">
                                    @else
                                        <p>No logo uploaded</p>
                                    @endif
                                </div>

                                <!-- File upload for logo -->
                                <input type="file" name="site_logo" class="form-control  form-control-sm" accept="image/*">
                                <small class="form-text text-muted">Upload the site logo (PNG, JPG, JPEG)</small>
                            </div>

                            <!-- Favicon -->
                            <div class="col-md-6">
                                <label class="form-label">Favicon</label>
                                <div>
                                    @if (isset($siteSettings['favicon']) && file_exists(storage_path('app/public/' . $siteSettings['favicon'])))
                                        <img src="{{ asset('storage/' . $siteSettings['favicon']) }}" alt="Favicon"
                                            width="100">
                                    @else
                                        <p>No favicon uploaded</p>
                                    @endif
                                </div>

                                <!-- File upload for favicon -->
                                <input type="file" name="favicon" class="form-control  form-control-sm" accept="image/*">
                                <small class="form-text text-muted">Upload the site favicon (PNG, JPG, JPEG, ICO)</small>
                            </div>


                            <!-- Site Title -->
                            <div class="col-md-6">
                                <label class="form-label">Site Title</label>
                                <input type="text" name="site_title" class="form-control  form-control-sm" placeholder="Enter Site Title"
                                    value="{{ old('site_title', $siteSettings['site_title'] ?? 'My Awesome Site') }}"
                                    required>
                            </div>

                            <!-- Site Name -->
                            <div class="col-md-6">
                                <label class="form-label">Site Name</label>
                                <input type="text" name="site_name" class="form-control  form-control-sm" placeholder="Enter Site Name"
                                    value="{{ old('site_name', $siteSettings['site_name'] ?? '') }}" required>
                            </div>

                            <!-- Site Slogan -->
                            <div class="col-md-6">
                                <label class="form-label">Site Slogan</label>
                                <input type="text" name="site_slogan" class="form-control  form-control-sm"
                                    placeholder="Enter Site Slogan"
                                    value="{{ old('site_slogan', $siteSettings['site_slogan'] ?? '') }}" required>
                            </div>

                            <!-- Primary Phone Number -->
                            <div class="col-md-6">
                                <label class="form-label">Primary Phone#</label>
                                <input type="text" name="primary_phone" class="form-control  form-control-sm"
                                    placeholder="Enter Primary Phone Number"
                                    value="{{ old('primary_phone', $siteSettings['primary_phone'] ?? '') }}" required>
                            </div>

                            <!-- Secondary Phone Number -->
                            <div class="col-md-6">
                                <label class="form-label">Secondary Phone#</label>
                                <input type="text" name="secondary_phone" class="form-control  form-control-sm"
                                    placeholder="Enter Secondary Phone Number"
                                    value="{{ old('secondary_phone', $siteSettings['secondary_phone'] ?? '') }}" required>
                            </div>

                            <!-- From Email Address -->
                            <div class="col-md-6">
                                <label class="form-label">From Email Address</label>
                                <input type="email" name="from_email" class="form-control  form-control-sm"
                                    placeholder="Enter From Email Address"
                                    value="{{ old('from_email', $siteSettings['from_email'] ?? '') }}" required>
                            </div>

                            <!-- To Email Address -->
                            <div class="col-md-6">
                                <label class="form-label">To Email Address</label>
                                <input type="email" name="to_email" class="form-control  form-control-sm"
                                    placeholder="Enter To Email Address"
                                    value="{{ old('to_email', $siteSettings['to_email'] ?? '') }}" required>
                            </div>

                            <!-- From Email Name -->
                            <div class="col-md-6">
                                <label class="form-label">From Email Name</label>
                                <input type="text" name="from_email_name" class="form-control  form-control-sm"
                                    placeholder="Enter From Email Name"
                                    value="{{ old('from_email_name', $siteSettings['from_email_name'] ?? '') }}" required>
                            </div>

                            <!-- To Email Name -->
                            <div class="col-md-6">
                                <label class="form-label">To Email Name</label>
                                <input type="text" name="to_email_name" class="form-control  form-control-sm"
                                    placeholder="Enter To Email Name"
                                    value="{{ old('to_email_name', $siteSettings['to_email_name'] ?? '') }}" required>
                            </div>

                            <!-- Default Currency Code -->
                            <div class="col-md-6">
                                <label class="form-label">Default Currency Code</label>
                                <select name="default_currency" class="form-control  form-control-sm" required>
                                    <option value="USD"
                                        {{ old('default_currency', $siteSettings['default_currency'] ?? 'USD') == 'USD' ? 'selected' : '' }}>
                                        USD Dollar</option>
                                    <option value="CAD"
                                        {{ old('default_currency', $siteSettings['default_currency'] ?? 'USD') == 'CAD' ? 'selected' : '' }}>
                                        CAD Dollar</option>
                                    <!-- Add more currency options as needed -->
                                </select>
                            </div>

                            <!-- Street Address -->
                            <div class="col-md-6">
                                <label class="form-label">Street Address</label>
                                <input type="text" name="street_address" class="form-control  form-control-sm"
                                    placeholder="Enter Street Address"
                                    value="{{ old('street_address', $siteSettings['street_address'] ?? '') }}" required>
                            </div>

                            <!-- Site Google Map -->
                            <div class="col-md-12">
                                <label class="form-label">Site Google Map</label>
                                <textarea name="site_google_map" class="form-control  form-control-sm" rows="4" placeholder="Enter Google Map Embed Code"
                                    required>{{ old('site_google_map', $siteSettings['site_google_map'] ?? '') }}</textarea>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-brand-1 float-right" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>

                    <!-- Emails Tab -->
                    <div class="tab-pane fade" id="email" role="tabpanel">
                        <h4 class='card-title text-success-1000 mb-3'>Email Settings</h4>
                        <form action="{{ route('admin.settings.store') }}" method="POST"
                            class="row gy-3 needs-validation" novalidate>
                            @csrf
                            <input type="hidden" name="section" value="email">
                            <input type="hidden" name="mail_driver" value="smtp">

                            <div class="col-md-6">
                                <label class="form-label">SMTP Server</label>
                                <input type="text" name="smtp_server"
                                    class="form-control  form-control-sm @error('smtp_server') is-invalid @enderror"
                                    placeholder="Enter SMTP Server"
                                    value="{{ old('smtp_server', $emailSettings['smtp_server'] ?? 'smtp.awesomesite.com') }}"
                                    required>
                                @error('smtp_server')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Mail Host</label>
                                <input type="text" name="mail_host"
                                    class="form-control  form-control-sm @error('mail_host') is-invalid @enderror"
                                    placeholder="Enter Mail Host"
                                    value="{{ old('mail_host', $emailSettings['mail_host'] ?? 'smtp.awesomesite.com') }}"
                                    required>
                                @error('mail_host')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Mail Port</label>
                                <input type="text" name="mail_port"
                                    class="form-control  form-control-sm @error('mail_port') is-invalid @enderror"
                                    placeholder="Enter Mail Port"
                                    value="{{ old('mail_port', $emailSettings['mail_port'] ?? '587') }}" required>
                                @error('mail_port')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Mail Encryption</label>
                                <select name="mail_encryption"
                                    class="form-control  form-control-sm @error('mail_encryption') is-invalid @enderror" required>
                                    <option value="tls"
                                        {{ old('mail_encryption', $emailSettings['mail_encryption'] ?? 'tls') == 'tls' ? 'selected' : '' }}>
                                        TLS</option>
                                    <option value="ssl"
                                        {{ old('mail_encryption', $emailSettings['mail_encryption'] ?? 'tls') == 'ssl' ? 'selected' : '' }}>
                                        SSL</option>
                                </select>
                                @error('mail_encryption')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Mail Username</label>
                                <input type="text" name="mail_username"
                                    class="form-control  form-control-sm @error('mail_username') is-invalid @enderror"
                                    placeholder="Enter Mail Username"
                                    value="{{ old('mail_username', $emailSettings['mail_username'] ?? 'user@awesomesite.com') }}"
                                    required>
                                @error('mail_username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Mail Password</label>
                                <input type="password" name="mail_password"
                                    class="form-control  form-control-sm @error('mail_password') is-invalid @enderror"
                                    placeholder="Enter Mail Password"
                                    value="{{ old('mail_password', $emailSettings['mail_password'] ?? '') }}" required>
                                @error('mail_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-brand-1 float-right" type="submit">Submit</button>
                            </div>
                        </form>

                    </div>

                    <!-- Homepage Tab -->
                    <div class="tab-pane fade" id="homepage" role="tabpanel">
                        <h4 class='card-title text-success-1000 mb-3'>Homepage Settings</h4>
                        <form action="{{ route('admin.settings.store') }}" method="POST"
                            class="row gy-3 needs-validation" novalidate>
                            @csrf
                            <input type="hidden" name="section" value="homepage">

                            <div class="col-md-6">
                                <label class="form-label">Homepage Section 1 Heading</label>
                                <input type="text" name="homepage_section_1_heading"
                                    class="form-control  form-control-sm @error('homepage_section_1_heading') is-invalid @enderror"
                                    placeholder="Enter Heading"
                                    value="{{ old('homepage_section_1_heading', $homepageSettings['homepage_section_1_heading'] ?? 'Welcome to Our Site!') }}"
                                    required>
                                @error('homepage_section_1_heading')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Homepage Section 1 Description</label>
                                <textarea name="homepage_section_1_desc" class="form-control  form-control-sm @error('homepage_section_1_desc') is-invalid @enderror"
                                    rows="3" placeholder="Enter Description" required>{{ old('homepage_section_1_desc', $homepageSettings['homepage_section_1_desc'] ?? 'We provide the best services to our clients.') }}</textarea>
                                @error('homepage_section_1_desc')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-brand-1 float-right" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>

                    <!-- Payment Gateways Tab -->
                    <div class="tab-pane fade" id="payment" role="tabpanel">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="tab-content" id="payment-gateway-tabs-content">
                                    <!-- Stripe payment -->
                                    <div class="tab-pane fade show active" id="stripe-settings" role="tabpanel"
                                        aria-labelledby="stripe-tab">
                                        <h4 class='card-title text-success-1000 mb-3'>Stripe payment</h4>
                                        <form action="{{ route('admin.settings.store') }}" method="POST"
                                            class="row gy-3 needs-validation" novalidate>
                                            @csrf
                                            <input type="hidden" name="section" value="payment">

                                            <div class="col-md-6">
                                                <label class="form-label">Stripe API Key</label>
                                                <input type="text" name="stripe_api_key"
                                                    class="form-control  form-control-sm @error('stripe_api_key') is-invalid @enderror"
                                                    placeholder="Enter Stripe API Key"
                                                    value="{{ old('stripe_api_key', $paymentSettings['stripe_api_key'] ?? '') }}"
                                                    required>
                                                @error('stripe_api_key')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label">Stripe Secret Key</label>
                                                <input type="text" name="stripe_secret_key"
                                                    class="form-control  form-control-sm @error('stripe_secret_key') is-invalid @enderror"
                                                    placeholder="Enter Stripe Secret Key"
                                                    value="{{ old('stripe_secret_key', $paymentSettings['stripe_secret_key'] ?? '') }}"
                                                    required>
                                                @error('stripe_secret_key')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-md-12">
                                                <button class="btn btn-brand-1 float-right" type="submit">Submit
                                                    </button>
                                            </div>
                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection
