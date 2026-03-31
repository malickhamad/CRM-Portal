@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <!-- Page Title and Breadcrumb -->
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">Add Customer</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 ">Add Customer</li>
                </ul>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-success-1000 ">Step 1: Account Information</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.customers.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Full Name -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name"
                                    class="form-control  form-control-sm @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="emailInput"
                                    class="form-control  form-control-sm @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    required oninput="validateEmail(this)">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="emailError" class="text-danger small mt-1" style="display:none;"></div>
                            </div>

                            <!-- Password -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                <div class="input-group has-validation">
                                    <input type="password" name="password" required
                                        class="form-control  form-control-sm @error('password') is-invalid @enderror" id="password"
                                        placeholder="Enter your password">
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
                                <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <div class="input-group has-validation">
                                    <input type="password" name="password_confirmation" required
                                        class="form-control  form-control-sm @error('password_confirmation') is-invalid @enderror"
                                        id="password_confirmation" placeholder="Re-enter your password">
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
                                <label class="form-label">Business Name <span class="text-danger">*</span></label>
                                <input type="text" name="business_name"
                                    class="form-control  form-control-sm @error('business_name') is-invalid @enderror"
                                    value="{{ old('business_name') }}" required>
                                @error('business_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone Number -->

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Number<span class="text-danger">*</span></label>
                                <input type="text" name="phone" id="phoneInput"
                                    class="form-control  form-control-sm @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                                    required oninput="validatePhone(this)">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="phoneError" class="text-danger small mt-1" style="display:none;"></div>
                            </div>

                            <!-- Country -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Country <span class="text-danger">*</span></label>
                                <select name="country" id="country"
                                    class="form-control  form-control-sm @error('country') is-invalid @enderror" required>
                                    <option value="">Select Country</option>
                                    @if (old('country'))
                                        <option value="{{ old('country') }}" selected>{{ old('country') }}</option>
                                    @endif
                                </select>
                                @error('country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- State -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">State <span class="text-danger">*</span></label>
                                <select name="state" id="state"
                                    class="form-control  form-control-sm @error('state') is-invalid @enderror" required>
                                    <option value="">Select State</option>
                                    @if (old('state'))
                                        <option value="{{ old('state') }}" selected>{{ old('state') }}</option>
                                    @endif
                                </select>
                                @error('state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- City -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">City <span class="text-danger">*</span></label>
                                <select name="city" id="city"
                                    class="form-control  form-control-sm @error('city') is-invalid @enderror" required>
                                    <option value="">Select City</option>
                                    @if (old('city'))
                                        <option value="{{ old('city') }}" selected>{{ old('city') }}</option>
                                    @endif
                                </select>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Street Address -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Street Address <span class="text-danger">*</span></label>
                                <input type="text" name="street_address"
                                    class="form-control  form-control-sm @error('street_address') is-invalid @enderror"
                                    value="{{ old('street_address') }}" required>
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
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4 gap-3">
                            <div>
                                <button type="submit" name="save"
                                    class="btn btn-success-600 d-inline-flex align-items-center">
                                    <span>Save</span>
                                </button>
                            </div>
                            <div>
                                <button type="submit" name="save_and_next" value="1"
                                    class="btn btn-brand-1 d-inline-flex align-items-center text-white">
                                    <span>Next: Payment Details</span>
                                    <iconify-icon icon="solar:arrow-right-outline" class="icon ms-1"></iconify-icon>
                                </button>
                            </div>
                        </div>

                    </form>
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
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const countrySelect = document.getElementById('country');
                const stateSelect = document.getElementById('state');
                const citySelect = document.getElementById('city');

                // Get old values from form submission if they exist
                const oldCountry = "{{ old('country') }}";
                const oldState = "{{ old('state') }}";
                const oldCity = "{{ old('city') }}";

                // Load countries when page loads
                fetchCountries();

                // Country change event
                countrySelect.addEventListener('change', function() {
                    const country = this.value;
                    stateSelect.innerHTML = '<option value="">Select State</option>';
                    citySelect.innerHTML = '<option value="">Select City</option>';

                    if (country) {
                        fetchStates(country);
                    }
                });

                // State change event
                stateSelect.addEventListener('change', function() {
                    const country = countrySelect.value;
                    const state = this.value;
                    citySelect.innerHTML = '<option value="">Select City</option>';

                    if (country && state) {
                        fetchCities(country, state);
                    }
                });

                // Function to fetch countries
                function fetchCountries() {
                    fetch("https://countriesnow.space/api/v0.1/countries/positions")
                        .then(response => response.json())
                        .then(data => {
                            data.data.forEach(country => {
                                const option = new Option(country.name, country.name);
                                countrySelect.add(option);
                            });

                            // If there was a previous selection, set it
                            if (oldCountry) {
                                countrySelect.value = oldCountry;
                                fetchStates(oldCountry);
                            }
                        })
                        .catch(error => {
                            console.error('Error loading countries:', error);
                            // If API fails but we have old value, create option
                            if (oldCountry && !Array.from(countrySelect.options).some(o => o.value ===
                                oldCountry)) {
                                const option = new Option(oldCountry, oldCountry);
                                option.selected = true;
                                countrySelect.add(option);
                            }
                        });
                }

                // Function to fetch states
                function fetchStates(country) {
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
                            if (data.data && data.data.states) {
                                data.data.states.forEach(state => {
                                    const option = new Option(state.name, state.name);
                                    stateSelect.add(option);
                                });

                                // If there was a previous selection, set it
                                if (oldState) {
                                    stateSelect.value = oldState;
                                    fetchCities(country, oldState);
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error loading states:', error);
                            // If API fails but we have old value, create option
                            if (oldState && !Array.from(stateSelect.options).some(o => o.value === oldState)) {
                                const option = new Option(oldState, oldState);
                                option.selected = true;
                                stateSelect.add(option);
                            }
                        });
                }

                // Function to fetch cities
                function fetchCities(country, state) {
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
                            if (data.data) {
                                data.data.forEach(city => {
                                    const option = new Option(city, city);
                                    citySelect.add(option);
                                });

                                // If there was a previous selection, set it
                                if (oldCity) {
                                    citySelect.value = oldCity;
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error loading cities:', error);
                            // If API fails but we have old value, create option
                            if (oldCity && !Array.from(citySelect.options).some(o => o.value === oldCity)) {
                                const option = new Option(oldCity, oldCity);
                                option.selected = true;
                                citySelect.add(option);
                            }
                        });
                }
            });
        </script>


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
