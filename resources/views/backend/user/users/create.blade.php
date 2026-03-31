@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')
        <div class="main-panel">
            <div class="dashboard-main-body">

                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                    <h6 class="fw-semibold mb-0 text-success-1000">Add SubUsers</h6>
                    <ul class="d-flex align-items-center gap-2">
                        <li class="fw-medium">
                            <a href="{{ route('user.dashboard') }}"
                                class="d-flex align-items-center gap-1 hover-text-success text-success-1000">
                                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                                Dashboard
                            </a>
                        </li>
                        <li>-</li>
                        <li class="fw-medium text-success-1000 text-md">Add SubUser</li>
                    </ul>
                </div>

                <div class="row gy-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0 text-success-1000 ">Add SubUser</h5>
                            </div>
                            <div class="card-body">
                                <form class="row gy-3 needs-validation" action="{{ route('user.subusers.store') }}"
                                    method="POST" novalidate>
                                    @csrf
                                    <div class="col-md-6">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name"
                                            class="form-control radius-8 @error('name') is-invalid @enderror" id="name"
                                            placeholder="Enter subuser's name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email"
                                            class="form-control radius-8 @error('email') is-invalid @enderror"
                                            id="email" placeholder="Enter subuser's email" value="{{ old('email') }}"
                                            required>
                                        @error('email')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" name="password"
                                                class="form-control radius-8 @error('password') is-invalid @enderror"
                                                id="password" placeholder="Enter password" required>
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
                                                class="form-control radius-8 @error('password_confirmation') is-invalid @enderror"
                                                id="password_confirmation" placeholder="Confirm password" required>
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
                                            class="form-control radius-8 @error('status') is-invalid @enderror" required>
                                            <option value="active"
                                                {{ old('status', isset($subuser) ? $subuser->status : '') == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="inactive"
                                                {{ old('status', isset($subuser) ? $subuser->status : '') == 'inactive' ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select>
                                        @error('status')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Assign Permissions</label>
                                        <div class="border rounded p-3 radius-8"
                                            style="max-height: 200px; overflow-y: auto;">
                                            @foreach (auth()->user()->getAllPermissions() as $permission)
                                                <div class="form-check mb-2"> &nbsp;
                                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                                        id="permission_{{ $loop->index }}"
                                                        value="{{ $permission->name }}"
                                                        {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}>
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
                                        <div class="border rounded p-3 radius-8"
                                            style="max-height: 200px; overflow-y: auto;">
                                            @foreach ($standards as $standard)
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="standards[]"
                                                        value="{{ $standard->id }}" id="standard_{{ $standard->id }}s"
                                                        {{ in_array($standard->id, old('standards', [])) ? 'checked' : '' }}>
                                                    <label class="form-check-label ms-3"
                                                        for="standard_{{ $standard->id }}">
                                                        {{ $standard->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('standards')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 d-flex justify-content-end gap-2">
                                        <a href="{{ route('user.subusers.index') }}"
                                            class="btn btn-secondary">
                                            {{-- <iconify-icon icon="solar:close-circle-outline" class="icon"></iconify-icon> --}}
                                            <span>Cancel</span>
                                        </a>
                                        <button class="btn btn-brand-1" type="submit">
                                            {{-- <iconify-icon icon="solar:user-plus-outline" class="icon"></iconify-icon> --}}
                                            <span>Submit</span>
                                        </button>

                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</main>

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

