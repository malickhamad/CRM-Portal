@extends('backend.layouts.app')

@section('content')
<main class="dashboard-main">
    @include('backend.layouts.partials.header')

    <div class="dashboard-main-body">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0 text-success-1000">Testimonials</h6>
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
        <x-sweet-alert :type="session('sweetalert.type')" :message="session('sweetalert.message')" :title="session('sweetalert.title')" />

        <div class="row">
            <div class="col-md-12">
                <div class="card basic-data-table">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title text-success-1000">Testimonials list</h4>
                        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-brand-1">+ Add</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table bordered-table mb-0 text-start" id="dataTable" data-page-length='10'>
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-start">Image</th>
                                        <th scope="col" class="text-start">Testimonial By</th>
                                        <th scope="col" class="text-start">Testimonial</th>
                                        <th scope="col" class="text-start">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($testimonials as $testimonial)
                                        <tr>
                                            <td class="text-start">
                                                @if ($testimonial->image)
                                                    <img src="{{ asset('storage/' . $testimonial->image) }}" width="60" alt="avatar">
                                                @else
                                                    <img src="{{ asset('default-avatar.png') }}" width="60" alt="default">
                                                @endif
                                            </td>
                                            <td class="text-start">{{ $testimonial->user->name ?? 'Unknown' }}</td>
                                            <td class="text-start">{!! Str::limit(strip_tags($testimonial->testimonial_detail), 80) !!}</td>
                                            <td class="text-start d-flex align-items-center gap-1">
                                                <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}"
                                                    class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center mx-2"
                                                    data-bs-toggle="tooltip" title="Edit">
                                                    <iconify-icon icon="lucide:edit"></iconify-icon>
                                                </a>
                                                <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" class="d-inline mx-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn-delete w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                                        data-bs-toggle="tooltip" title="Delete">
                                                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
