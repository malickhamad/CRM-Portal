@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')
        <div class="main-panel">
            <div class="dashboard-main-body">

                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                    <h6 class="fw-semibold mb-0 text-success-1000">Edit SubUser</h6>
                    <ul class="d-flex align-items-center gap-2">
                        <li class="fw-medium">
                            <a href="{{ route('user.dashboard') }}" class="d-flex align-items-center gap-1 hover-text-success text-success-1000">
                                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                                Dashboard
                            </a>
                        </li>
                        <li>-</li>
                        <li class="fw-medium text-success-1000 text-md">Edit SubUser</li>
                    </ul>
                </div>

                <div class="row gy-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0 text-success-1000 ">Edit SubUser</h5>
                            </div>
                            <div class="card-body">
                                <form class="row gy-3 needs-validation" action="{{ route('user.subusers.update', $subuser->id) }}" method="POST" novalidate>
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-6">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control  form-control-sm radius-8 @error('name') is-invalid @enderror" id="name"
                                            placeholder="Enter subuser's name" value="{{ old('name', $subuser->name) }}">
                                        @error('name')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control  form-control-sm radius-8 @error('email') is-invalid @enderror" id="email"
                                            placeholder="Enter subuser's email" value="{{ old('email', $subuser->email) }}">
                                        @error('email')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" name="password"
                                                class="form-control  form-control-sm radius-8 @error('password') is-invalid @enderror"
                                                id="password" placeholder="Enter new password (leave blank to keep current)">
                                            <span toggle="#password"
                                                class="input-group-text toggle-password cursor-pointer radius-8">
                                                <iconify-icon icon="mdi:eye-outline" class="icon"></iconify-icon>
                                            </span>
                                        </div>
                                        @error('password')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Confirm Password</label>
                                        <div class="input-group">
                                            <input type="password" name="password_confirmation"
                                                class="form-control  form-control-sm radius-8 @error('password_confirmation') is-invalid @enderror"
                                                id="password_confirmation" placeholder="Confirm new password">
                                            <span toggle="#password_confirmation"
                                                class="input-group-text toggle-password cursor-pointer radius-8">
                                                <iconify-icon icon="mdi:eye-outline" class="icon"></iconify-icon>
                                            </span>
                                        </div>
                                        @error('password_confirmation')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Status</label>
                                        <select name="status"
                                                    class="form-control  form-control-sm @error('status') is-invalid @enderror">
                                                    <option value="active"
                                                        {{ old('status', $subuser->status) == 'active' ? 'selected' : '' }}>
                                                        Active</option>
                                                    <option value="inactive"
                                                        {{ old('status', $subuser->status) == 'inactive' ? 'selected' : '' }}>
                                                        Inactive</option>
                                                </select>
                                        @error('status')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Assign Permissions</label>
                                        <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
                                            @foreach (auth()->user()->getAllPermissions() as $permission)
                                                <div class="form-check mb-2"> &nbsp;
                                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                                        id="permission_{{ $loop->index }}" value="{{ $permission->name }}"
                                                        {{ in_array($permission->name, old('permissions', $subuser->permissions->pluck('name')->toArray())) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="permission_{{ $loop->index }}">
                                                        {{ ucfirst($permission->name) }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('permissions')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Assign Standards</label>
                                        <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
                                            @foreach($standards as $standard)
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="standards[]"
                                                           value="{{ $standard->id }}" id="standard_{{ $standard->id }}"
                                                           {{ in_array($standard->id, old('standards', $userStandards)) ? 'checked' : '' }}>
                                                    <label class="form-check-label ms-3" for="standard_{{ $standard->id }}">
                                                        {{ $standard->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('standards')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <button class="btn btn-brand-1 float-right" type="submit">Update</button>
                                        <a href="{{ route('user.subusers.index') }}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    @endsection
    @push('custom-js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
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

            // Form validation
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        });
    </script>
@endpush

@push('custom-css')
    <style>
        .toggle-password {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .toggle-password:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .radius-8 {
            border-radius: 4px !important;
        }

        .form-control  form-control-sm.is-invalid,
        .was-validated .form-control  form-control-sm:invalid {
            border-color: #dc3545;
            padding-right: calc(1.5em + 0.75rem);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }
    </style>
@endpush
