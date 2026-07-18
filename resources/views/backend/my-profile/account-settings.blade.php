@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">Account Settings</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">Account Settings</li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.update-password') }}" method="POST">
                                @csrf

                                <!-- Current Password -->
                                <div class="form-group mb-3">
                                    <label for="current_password" class='form-label'>Current Password:</label>
                                    <input type="password" name="current_password" id="current_password"
                                           class="form-control  form-control-sm @error('current_password') is-invalid @enderror" required>
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- New Password -->
                                <div class="form-group mb-3">
                                    <label for="password" class='form-label'>New Password:</label>
                                    <input type="password" name="password" id="password"
                                           class="form-control  form-control-sm @error('password') is-invalid @enderror" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group mb-3">
                                    <label for="password_confirmation" class='form-label'>Confirm New Password:</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                           class="form-control  form-control-sm @error('password_confirmation') is-invalid @enderror" required>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="card-action mt-3 mb-0">
                                    <button type="submit" class="btn btn-brand-1 float-right">Update Password</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
