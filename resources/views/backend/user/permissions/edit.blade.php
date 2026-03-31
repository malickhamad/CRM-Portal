s@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Edit Permissions</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('user.dashboard') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Permissions</li>
                </ul>
            </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-body">
                                <form action="{{ route('user.permissions.update', $permission->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" name="name" value="{{ old('name', $permission->name) }}"
                                            class="form-control" required>
                                    </div>
                                    <div class="card-action mt-3 mb-0 ">
                                        <button type="submit" class="btn btn-primary-600 float-right">Update</button>
                                        <a href="{{ route('user.permissions.index') }}" class="btn btn-danger ">Cancel</a>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    @endsection
