@extends('backend.layouts.app')

@section('content')
<main class="dashboard-main">
    @include('backend.layouts.partials.header')

    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0 text-success-1000">Edit Testimonial</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Dashboard
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium text-success-1000 text-md">Testimonials</li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 col-lg-8">
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control  form-control-sm @error('name') is-invalid @enderror"
                                            id="name" value="{{ old('name', $testimonial->name) }}" placeholder="Enter client name" required />
                                        @error('name')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="testimonial_detail" class="form-label">Testimonial</label>
                                        <textarea name="testimonial_detail" class="form-control  form-control-sm @error('testimonial_detail') is-invalid @enderror"
                                            id="editor" placeholder="Enter testimonial" required>{{ old('testimonial_detail', $testimonial->testimonial_detail) }}</textarea>
                                        @error('testimonial_detail')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="image" class="form-label">Client Image</label>
                                        <input type="file" name="image" class="form-control  form-control-sm @error('image') is-invalid @enderror"
                                            id="image" accept="image/*">
                                        @error('image')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror

                                        @if ($testimonial->image)
                                            <div class="mt-3">
                                                <img src="{{ asset('storage/' . $testimonial->image) }}" width="100" alt="testimonial image" />
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-brand-1 float-start">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
