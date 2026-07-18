@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')
        <div class="main-panel">
            <div class="dashboard-main-body">

                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                    <h6 class="fw-semibold mb-0 text-success-1000">Add User</h6>
                    <ul class="d-flex align-items-center gap-2">
                        <li class="fw-medium">
                            <a href="{{ route('dashboard') }}" class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success">
                                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                                Dashboard
                            </a>
                        </li>
                        <li>-</li>
                        <li class="fw-medium text-success-1000 text-md">Add User</li>
                    </ul>
                </div>

                <div class="row gy-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0 text-success-1000 ">Create Users</h5>
                            </div>
                            <div class="card-body">
                                <form class="row gy-3 needs-validation" action="{{ route('admin.users.store') }}"
                                    method="POST" novalidate>
                                    @csrf
                                    <div class="col-md-6">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" name="name"
                                            class="form-control  form-control-sm radius-8 @error('name') is-invalid @enderror" id="name"
                                            placeholder="Enter Full Name" value="{{ old('name') }}">
                                        @error('name')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email"
                                            class="form-control  form-control-sm radius-8 @error('email') is-invalid @enderror"
                                            id="email" placeholder="Enter email address" value="{{ old('email') }}">
                                        @error('email')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password"
                                            class="form-control  form-control-sm radius-8 @error('password') is-invalid @enderror"
                                            id="password" placeholder="Enter Password">
                                        @error('password')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Roles</label>
                                        <select name="roles[]" class="form-control  form-control-sm radius-8 form-select">
                                            @foreach ($roles as $value => $label)
                                                <option value="{{ $value }}"
                                                    {{ in_array($value, old('roles', [])) ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <label class="form-label">Roles</label>
                                        <input type="text" class="form-control  form-control-sm radius-8" value="Admin" readonly>
                                        <input type="hidden" name="roles[]" value="admin"> <!-- Assuming 'admin' is the role name -->
                                    </div> --}}
                                    <div class="col-md-6">
                                        <label class="form-label">Status</label>
                                        <select name="status"
                                            class="form-control  form-control-sm radius-8 form-select @error('status') is-invalid @enderror">
                                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                            </option>
                                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select>
                                        @error('status')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <button class="btn btn-brand-1 float-right" type="submit">Submit</button>
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



            </div>

        </div>
    @endsection
