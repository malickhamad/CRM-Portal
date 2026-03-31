@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <!-- Page Title and Breadcrumb -->
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000 ">My Profile Information</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('user.dashboard') }}" class="d-flex align-items-center gap-1 hover-text-success text-success-1000">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">My Profile</li>
                </ul>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-success-1000 ">Profile Information</h4>
                    @if ($user->profile_completed)
                        <span class="badge bg-success ms-2">Profile Completed</span>
                    @endif
                </div>
                <div class="card-body">
                    @if ($user->profile_completed)
                        <!-- Read-only view -->
                        <div class="row">
                            <!-- Full Name -->
                            <div class="col-md-6 mb-3">
                                <p class="form-label">Full Name</p>
                                <div class="form-control  form-control-sm-plaintext">{{ $user->name }}</div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <div class="form-control  form-control-sm-plaintext">{{ $user->email }}</div>
                            </div>

                            <!-- Business Name -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Business Name</label>
                                <div class="form-control  form-control-sm-plaintext">{{ $user->business_name ?? 'N/A' }}</div>
                            </div>

                            <!-- Phone Number -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Number</label>
                                <div class="form-control  form-control-sm-plaintext">{{ $user->phone ?? 'N/A' }}</div>
                            </div>

                            <!-- Address -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Address</label>
                                <div class="form-control  form-control-sm-plaintext">
                                    {{ $user->street_address ?? 'N/A' }},
                                    {{ $user->city ?? '' }},
                                    {{ $user->state ?? '' }},
                                    {{ $user->country ?? '' }}
                                </div>
                            </div>

                            <!-- Profile Picture -->
                            @if ($user->profile_picture)
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Profile Picture</label>
                                    <div>
                                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture"
                                            width="120" class="img-thumbnail">
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="alert alert-info mt-4">

                            Your profile has been completed and cannot be edited.
                            Please contact support if you need to make changes.
                        </div>
                    @else
                        <!-- Editable form -->
                        <form method="POST" action="{{ route('user.profile') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <!-- Full Name -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name"
                                        class="form-control  form-control-sm @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="emailInput"
                                        class="form-control  form-control-sm @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email) }}" required oninput="validateEmail(this)">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div id="emailError" class="text-danger small mt-1" style="display:none;"></div>
                                </div>

                                <!-- Password -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="input-group has-validation">
                                        <input type="password" name="password"
                                            class="form-control  form-control-sm @error('password') is-invalid @enderror" id="password"
                                            placeholder="Leave blank to keep current password">
                                        <span toggle="#password" class="input-group-text toggle-password cursor-pointer">
                                            <iconify-icon icon="mdi:eye-outline" class="icon"></iconify-icon>
                                        </span>
                                        @error('password')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <div class="input-group has-validation">
                                        <input type="password" name="password_confirmation"
                                            class="form-control  form-control-sm @error('password_confirmation') is-invalid @enderror"
                                            id="password_confirmation" placeholder="Leave blank to keep current password">
                                        <span toggle="#password_confirmation"
                                            class="input-group-text toggle-password cursor-pointer">
                                            <iconify-icon icon="mdi:eye-outline" class="icon"></iconify-icon>
                                        </span>
                                        @error('password_confirmation')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Business Name -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Business Name</label>
                                    <input type="text" name="business_name"
                                        class="form-control  form-control-sm @error('business_name') is-invalid @enderror"
                                        value="{{ old('business_name', $user->business_name) }}">
                                    @error('business_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Phone Number -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number<span class="text-danger">*</span></label>
                                    <input type="text" name="phone" id="phoneInput"
                                        class="form-control  form-control-sm @error('phone') is-invalid @enderror"
                                        value="{{ old('phone', $user->phone) }}" required oninput="validatePhone(this)">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div id="phoneError" class="text-danger small mt-1" style="display:none;"></div>
                                </div>

                                <!-- Country -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Country</label>
                                    <select name="country" id="country"
                                        class="form-control  form-control-sm @error('country') is-invalid @enderror">
                                        <option value="">Select Country</option>
                                        @if ($user->country)
                                            <option value="{{ $user->country }}" selected>{{ $user->country }}</option>
                                        @endif
                                    </select>
                                    @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- State -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">State</label>
                                    <select name="state" id="state"
                                        class="form-control  form-control-sm @error('state') is-invalid @enderror">
                                        <option value="">Select State</option>
                                        @if ($user->state)
                                            <option value="{{ $user->state }}" selected>{{ $user->state }}</option>
                                        @endif
                                    </select>
                                    @error('state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- City -->
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">City</label>
                                    <select name="city" id="city"
                                        class="form-control  form-control-sm @error('city') is-invalid @enderror">
                                        <option value="">Select City</option>
                                        @if ($user->city)
                                            <option value="{{ $user->city }}" selected>{{ $user->city }}</option>
                                        @endif
                                    </select>
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Street Address -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Street Address</label>
                                    <input type="text" name="street_address"
                                        class="form-control  form-control-sm @error('street_address') is-invalid @enderror"
                                        value="{{ old('street_address', $user->street_address) }}">
                                    @error('street_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Profile Picture -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Profile Picture</label>
                                    <input type="file" name="profile_picture"
                                        class="form-control  form-control-sm @error('profile_picture') is-invalid @enderror">
                                    @error('profile_picture')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if ($user->profile_picture)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                                alt="Profile Picture" width="80">
                                        </div>
                                    @endif
                                </div>

                                <div class="justify-content-end gap-1 d-flex">
                                    <div class="d-flex justify-content-end mt-4 gap-2">
                                        <button type="submit" class="btn btn-brand-1 d-inline-flex align-items-center">
                                            <span>Complete Profile</span>
                                            <iconify-icon icon="solar:arrow-right-outline"
                                                class="icon ms-1"></iconify-icon>
                                        </button>
                                    </div>
                                    <div class="d-flex justify-content-end mt-4 gap-2">
                                        <a href="{{ route('user.subscription') }}"
                                            class="btn btn-success d-inline-flex align-items-center">
                                            <span>Manage Subscription</span>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @endsection

    @push('custom-js')
        <script>
            function validateEmail(input) {
                const emailError = document.getElementById('emailError');
                const email = input.value.trim();

                // Check for space at start
                if (input.value.startsWith(' ')) {
                    emailError.textContent = 'Email should not start with a space';
                    emailError.style.display = 'block';
                    input.classList.add('is-invalid');
                    return;
                }

                // Check basic email format
                if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    emailError.textContent = 'Please enter a valid email address (e.g., user@example.com)';
                    emailError.style.display = 'block';
                    input.classList.add('is-invalid');
                } else {
                    emailError.style.display = 'none';
                    input.classList.remove('is-invalid');
                }
            }

            function validatePhone(input) {
                const phoneError = document.getElementById('phoneError');
                const phone = input.value;

                // Check if contains letters
                if (/[a-zA-Z]/.test(phone)) {
                    phoneError.textContent = 'Phone number should not contain letters';
                    phoneError.style.display = 'block';
                    input.classList.add('is-invalid');
                }
                // Check international format (either + or 00 at start)
                else if (phone && !/^(\+|00)\d{6,20}$/.test(phone)) {
                    phoneError.textContent = 'Please enter a valid international number (e.g., +44123456789 or 0044123456789)';
                    phoneError.style.display = 'block';
                    input.classList.add('is-invalid');
                } else {
                    phoneError.style.display = 'none';
                    input.classList.remove('is-invalid');
                }
            }
        </script>

        <!-- Location dropdown scripts -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Initialize country, state, city dropdowns with current values
                const currentCountry = "{{ old('country', $user->country) }}";
                const currentState = "{{ old('state', $user->state) }}";
                const currentCity = "{{ old('city', $user->city) }}";

                // Fetch countries
                fetch("https://countriesnow.space/api/v0.1/countries/positions")
                    .then(response => response.json())
                    .then(data => {
                        const countrySelect = document.getElementById("country");
                        data.data.forEach(country => {
                            const option = document.createElement("option");
                            option.value = country.name;
                            option.text = country.name;
                            if (country.name === currentCountry) {
                                option.selected = true;
                            }
                            countrySelect.add(option);
                        });

                        if (currentCountry) {
                            loadStates(currentCountry, currentState);
                        }
                    });

                // When country changes, fetch states
                document.getElementById("country").addEventListener("change", function() {
                    let country = this.value;
                    if (country) {
                        loadStates(country);
                    } else {
                        document.getElementById("state").innerHTML = '<option value="">Select State</option>';
                        document.getElementById("city").innerHTML = '<option value="">Select City</option>';
                    }
                });

                // When state changes, fetch cities
                document.getElementById("state").addEventListener("change", function() {
                    let country = document.getElementById("country").value;
                    let state = this.value;
                    if (country && state) {
                        loadCities(country, state);
                    } else {
                        document.getElementById("city").innerHTML = '<option value="">Select City</option>';
                    }
                });

                function loadStates(country, selectedState = null) {
                    fetch("https://countriesnow.space/api/v0.1/countries/states", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({
                                country: country
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            const stateSelect = document.getElementById("state");
                            stateSelect.innerHTML = '<option value="">Select State</option>';

                            if (data.data && data.data.states) {
                                data.data.states.forEach(state => {
                                    const option = document.createElement("option");
                                    option.value = state.name;
                                    option.text = state.name;
                                    if (selectedState && state.name === selectedState) {
                                        option.selected = true;
                                    }
                                    stateSelect.add(option);
                                });

                                if (selectedState) {
                                    loadCities(country, selectedState, currentCity);
                                }
                            }
                        });
                }

                function loadCities(country, state, selectedCity = null) {
                    fetch("https://countriesnow.space/api/v0.1/countries/state/cities", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({
                                country: country,
                                state: state
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            const citySelect = document.getElementById("city");
                            citySelect.innerHTML = '<option value="">Select City</option>';

                            if (data.data) {
                                data.data.forEach(city => {
                                    const option = document.createElement("option");
                                    option.value = city;
                                    option.text = city;
                                    if (selectedCity && city === selectedCity) {
                                        option.selected = true;
                                    }
                                    citySelect.add(option);
                                });
                            }
                        });
                }
            });
        </script>

        <!-- Toggle password visibility -->
        <script>
            document.querySelectorAll('.toggle-password').forEach(item => {
                item.addEventListener('click', function() {
                    const selector = this.getAttribute('toggle');
                    const input = document.querySelector(selector);
                    const icon = this.querySelector('iconify-icon');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.setAttribute('icon', 'mdi:eye-off-outline');
                    } else {
                        input.type = 'password';
                        icon.setAttribute('icon', 'mdi:eye-outline');
                    }
                });
            });
        </script>
    @endpush
