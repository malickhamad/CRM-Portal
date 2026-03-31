@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <!-- Page Title and Breadcrumb -->
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">Edit Customer</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">Edit Customer: Step 1</li>
                </ul>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-success-1000 ">Step 1: Account Information</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.customers.update.step1', $user->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

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
                                <input type="email" name="email" id="editEmailInput"
                                    class="form-control  form-control-sm @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user->email) }}" required oninput="validateEditEmail(this)">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="editEmailError" class="text-danger small mt-1" style="display:none;"></div>
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
                                <label class="form-label">Business Name <span class="text-danger">*</span></label>
                                <input type="text" name="business_name"
                                    class="form-control  form-control-sm @error('business_name') is-invalid @enderror"
                                    value="{{ old('business_name', $user->business_name) }}" required>
                                @error('business_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone Number -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" name="phone" id="editPhoneInput"
                                    class="form-control  form-control-sm @error('phone') is-invalid @enderror"
                                    value="{{ old('phone', $user->phone) }}" required oninput="validateEditPhone(this)">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="editPhoneError" class="text-danger small mt-1" style="display:none;"></div>
                            </div>

                            <!-- Country -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Country <span class="text-danger">*</span></label>
                                <select name="country" id="country"
                                    class="form-control  form-control-sm @error('country') is-invalid @enderror" required>
                                    @if (old('country', $user->country))
                                        <option value="{{ old('country', $user->country) }}" selected>
                                            {{ old('country', $user->country) }}</option>
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
                                    @if (old('state', $user->state))
                                        <option value="{{ old('state', $user->state) }}" selected>
                                            {{ old('state', $user->state) }}</option>
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
                                    @if (old('city', $user->city))
                                        <option value="{{ old('city', $user->city) }}" selected>
                                            {{ old('city', $user->city) }}</option>
                                    @endif
                                </select>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Street Address -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Street Address <span class="text-danger">*</span></label>
                                <input type="text" name="street_address"
                                    class="form-control  form-control-sm @error('street_address') is-invalid @enderror"
                                    value="{{ old('street_address', $user->street_address) }}" required>
                                @error('street_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>




                            <!-- Status -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror"
                                    required>
                                    <option value="active"
                                        {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive"
                                        {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Profile Picture -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Profile Picture</label>
                                <input type="file" name="profile_picture"
                                    class="form-control  form-control-sm @error('profile_picture') is-invalid @enderror">
                                <!-- Display current profile picture -->
                                @if (isset($user->profile_picture) && $user->profile_picture)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture"
                                            class="img-thumbnail" style="max-width: 150px;">
                                    </div>
                                @endif
                                @error('profile_picture')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="d-flex justify-content-end mt-4 gap-3">
                            <div>
                                <button type="submit"
                                    class="btn btn-success-600 zz d-inline-flex align-items-center text-white">
                                    <span>Update</span>
                                    <iconify-icon icon="solar:check-circle-outline" class="icon ms-1"></iconify-icon>
                                </button>
                            </div>
                            <div>
                                <a href="{{ route('admin.customers.edit.step2', $user->id) }}">
                                    <button type="button"
                                        class="btn btn-brand-1 d-inline-flex align-items-center text-white">
                                        <span>Next: Payment Details</span>
                                        <iconify-icon icon="solar:arrow-right-outline" class="icon ms-1"></iconify-icon>
                                    </button>
                                </a>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endsection
</main>

@push('custom-js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize countries dropdown
            const countrySelect = document.getElementById("country");
            const stateSelect = document.getElementById("state");
            const citySelect = document.getElementById("city");

            // Fetch countries and set the current value
            fetch("https://countriesnow.space/api/v0.1/countries/positions")
                .then(response => response.json())
                .then(data => {
                    const currentCountry = "{{ old('country', $user->country) }}";
                    data.data.forEach(country => {
                        const option = document.createElement("option");
                        option.value = country.name;
                        option.text = country.name;
                        if (country.name === currentCountry) {
                            option.selected = true;
                        }
                        countrySelect.add(option);
                    });

                    // If country has a value, load its states
                    if (currentCountry) {
                        loadStates(currentCountry);
                    }
                });

            // When country changes, fetch states
            countrySelect.addEventListener("change", function() {
                loadStates(this.value);
            });

            // When state changes, fetch cities
            stateSelect.addEventListener("change", function() {
                const country = countrySelect.value;
                const state = this.value;
                if (country && state) {
                    loadCities(country, state);
                }
            });

            function loadStates(country) {
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
                        stateSelect.innerHTML = "";
                        const currentState = "{{ old('state', $user->state) }}";

                        // Add default option
                        const defaultOption = document.createElement("option");
                        defaultOption.value = "";
                        defaultOption.text = "Select State";
                        stateSelect.add(defaultOption);

                        data.data.states.forEach(state => {
                            const option = document.createElement("option");
                            option.value = state.name;
                            option.text = state.name;
                            if (state.name === currentState) {
                                option.selected = true;
                            }
                            stateSelect.add(option);
                        });

                        // If state has a value, load its cities
                        if (currentState) {
                            loadCities(country, currentState);
                        }
                    });
            }

            function loadCities(country, state) {
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
                        citySelect.innerHTML = "";
                        const currentCity = "{{ old('city', $user->city) }}";

                        // Add default option
                        const defaultOption = document.createElement("option");
                        defaultOption.value = "";
                        defaultOption.text = "Select City";
                        citySelect.add(defaultOption);

                        data.data.forEach(city => {
                            const option = document.createElement("option");
                            option.value = city;
                            option.text = city;
                            if (city === currentCity) {
                                option.selected = true;
                            }
                            citySelect.add(option);
                        });
                    });
            }

            // Toggle show/hide password with Iconify icons
            document.querySelectorAll('.toggle-password').forEach(item => {
                item.addEventListener('click', function(e) {
                    const input = document.querySelector(this.getAttribute('toggle'));
                    const icon = this.querySelector('iconify-icon');

                    if (input.getAttribute('type') === 'password') {
                        input.setAttribute('type', 'text');
                        icon.setAttribute('icon', 'mdi:eye-off-outline');
                    } else {
                        input.setAttribute('type', 'password');
                        icon.setAttribute('icon', 'mdi:eye-outline');
                    }
                });
            });
        });
    </script>


    <script>
        function validateEditEmail(input) {
            const emailError = document.getElementById('editEmailError');
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

        function validateEditPhone(input) {
            const phoneError = document.getElementById('editPhoneError');
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
@endpush
