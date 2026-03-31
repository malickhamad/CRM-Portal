@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')
        <div class="main-panel">
            <div class="dashboard-main-body">

                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                    <h6 class="fw-semibold mb-0 text-success-1000">Edit User</h6>
                    <ul class="d-flex align-items-center gap-2">
                        <li class="fw-medium">
                            <a href="{{ route('dashboard') }}" class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success">
                                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                                Dashboard
                            </a>
                        </li>
                        <li>-</li>
                        <li class="fw-medium text-success-1000 text-md">Edit User</li>
                    </ul>
                </div>

                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-8">
                                            <div class="form-group mb-3">
                                                <label for="name" class="fs-5">Name</label>
                                                <input type="text" name="name"
                                                    class="form-control  form-control-sm @error('name') is-invalid @enderror" id="name"
                                                    value="{{ old('name', $user->name) }}" placeholder="Enter Name" />
                                                @error('name')
                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="email" class="fs-5">Email</label>
                                                <input type="text" name="email"
                                                    class="form-control  form-control-sm @error('email') is-invalid @enderror" id="email"
                                                    value="{{ old('email', $user->email) }}" placeholder="Enter Email" />
                                                @error('email')
                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="password" class="fs-5">Password</label>
                                                <input type="password" name="password"
                                                    class="form-control  form-control-sm @error('password') is-invalid @enderror"
                                                    id="password"
                                                    placeholder="Enter New Password (leave blank to keep current)" />
                                                @error('password')
                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="Roles" class="fs-5">Roles</label>
                                                <select name="roles[]" class="form-control  form-control-sm">
                                                    @foreach ($roles as $value => $label)
                                                        <option value="{{ $value }}"
                                                            {{ in_array($value, old('roles', $user->roles->pluck('name')->toArray())) ? 'selected' : '' }}>
                                                            {{ $label }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{-- <div class="form-group mb-3">
                                                <label class="form-label">Roles</label>
                                                <input type="text" class="form-control  form-control-sm radius-8" value="Admin" readonly>
                                                <input type="hidden" name="roles[]" value="admin">
                                            </div> --}}

                                            <div class="form-group mb-3">
                                                <label for="status" class="fs-5">Status</label>
                                                <select name="status"
                                                    class="form-control  form-control-sm @error('status') is-invalid @enderror">
                                                    <option value="active"
                                                        {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>
                                                        Active</option>
                                                    <option value="inactive"
                                                        {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>
                                                        Inactive</option>
                                                </select>
                                                @error('status')
                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

{{--
                                            <div class="form-group mb-3">
                                                <label class="fs-5">Standards</label>
                                                <div class="row">
                                                    <div class="col-md-12">
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
                                                </div>
                                                @error('standards')
                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div> --}}

                                        </div>

                                        <div class="card-action mt-2">
                                            <button type="submit"class="btn btn-brand-1">Update</button>
                                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        </div>
    @endsection
