@extends('backend.layouts.app')

@section('content')


<main class="dashboard-main">
    @include('backend.layouts.partials.header')

    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0 text-success-1000">Add Role</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Dashboard
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium text-success-1000 text-md">Add Role</li>
            </ul>
        </div>
                <form method="POST" action="{{ route('admin.roles.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Role Name Input -->
                                        <div class="col-md-6 col-lg-8">
                                            <div class="form-group">
                                                <label for="name" class="form-label fs-5">Name</label>
                                                <input type="text" name="name" class="form-control  form-control-sm @error('name') is-invalid @enderror"
                                                    id="name" value="{{ old('name') }}" placeholder="Enter Role Name" />
                                                @error('name')
                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Permissions Checkbox List -->
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <label for="permissions" class="form-label fs-5">Permissions</label>
                                            <div class="form-group mb-2">
                                                @foreach($permissions as $permission)
                                                    <div class="form-check mb-2">
                                                        <input type="checkbox" name="permission[]" value="{{ $permission->id }}"
                                                            class="form-check-input" id="permission_{{ $permission->id }}">
                                                        <label class="form-check-label ms-3" for="permission_{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                                @error('permissions*')
                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                          <!-- Submit & Cancel Buttons -->
                                <div class="card-action my-3">
                                    <button type="submit" class="btn btn-brand-1 float-right">Submit</button>
                                    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancel</a>
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
