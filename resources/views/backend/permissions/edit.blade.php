@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">Edit Permission</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">Edit Permission</li>
                </ul>
            </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-body">
                                <form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="name" class='form-label'>Name:</label>
                                        <input type="text" name="name" value="{{ old('name', $permission->name) }}"
                                            class="form-control  form-control-sm" required>
                                    </div>
                                    <div class="card-action mt-3 mb-0 ">
                                        <button type="submit" class="btn btn-brand-1 float-right">Update</button>
                                        <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary ">Cancel</a>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    @endsection
