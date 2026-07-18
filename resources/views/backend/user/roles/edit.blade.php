@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Edit Roles</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('user.dashboard') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Roles</li>
                </ul>
            </div>

            <form method="POST" action="{{ route('user.roles.update', $role->id) }}">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <!-- Role Name Input -->
                                    <div class="col-md-6 col-lg-8">
                                        <div class="form-group">
                                            <label for="name" class="fs-5">Name</label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror" id="name"
                                                value="{{ old('name', $role->name) }}" placeholder="Enter Role Name" />
                                            @error('name')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Permissions Checkbox List -->
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label for="permissions" class="fs-5">Permissions</label>
                                        <div class="form-group">
                                            @foreach ($permission as $perm)
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" name="permission[]" value="{{ $perm->id }}"
                                                        class="form-check-input" id="permission_{{ $perm->id }}"
                                                        {{ in_array($perm->id, $rolePermissions) ? 'checked' : '' }}>
                                                    <label class="form-check-label ms-3"
                                                        for="permission_{{ $perm->id }}">
                                                        {{ $perm->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                            @error('permissions')
                                                <div class="text-danger mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Submit & Cancel Buttons -->
                                    <div class="card-action my-3">
                                        <button type="submit" class="btn btn-primary-600 float-right">Update</button>
                                        <a href="{{ route('user.roles.index') }}" class="btn btn-danger">Cancel</a>
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
