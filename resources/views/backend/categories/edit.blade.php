@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">Edit Category</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('dashboard') }}" class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success ">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">Edit Category</li>
                </ul>
            </div>

            <div class="row gy-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-success-1000 mb-0">Edit Category</h4>
                        </div>
                        <div class="card-body">
                            <!-- Form with validation -->
                            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="row gy-3 needs-validation" novalidate>
                                @csrf
                                @method('PUT') <!-- Use PUT method for updates -->
                                <div class="col-md-12">
                                    <label class="form-label">Category Name</label>
                                    <div class="icon-field has-validation">
                                        <span class="icon">
                                            <iconify-icon icon="f7:person"></iconify-icon>
                                        </span>
                                        <input type="text" name="name" class="form-control  form-control-sm @error('name') is-invalid @enderror" placeholder="Enter Category Name" value="{{ old('name', $category->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-brand-1 float-right" type="submit">Update</button>
                                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
