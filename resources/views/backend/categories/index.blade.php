@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">Categories
                </h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('dashboard') }}"
                            class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success ">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">Categories</li>
                </ul>
            </div>
            <x-sweet-alert :type="session('sweetalert.type')" :message="session('sweetalert.message')" :title="session(key: 'sweetalert.title')" />

            <div class="row gy-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0 text-success-1000">Add Category</h4>
                        </div>
                        <div class="card-body">
                            <!-- Form with validation -->
                            <form action="{{ route('admin.categories.store') }}" method="POST"
                                class="row gy-3 needs-validation" novalidate>
                                @csrf
                                <div class="col-md-12">
                                    <label class="form-label ">Category Name</label>
                                    <div class="icon-field has-validation">
                                        <span class="icon">
                                            <iconify-icon icon="f7:person"></iconify-icon>
                                        </span>
                                        <input type="text" name="name"
                                            class="form-control  form-control-sm @error('name') is-invalid @enderror"
                                            placeholder="Enter Category Name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-brand-1 float-right" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table for Categories -->
            <div class="card basic-data-table mt-5">
                <div class="card-body p-24">
                    <div class="table-responsive scroll-lg">
                        <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                            <thead>
                                <tr>
                                    <th scope="col" class="text-start"> <!-- Aligns left -->
                                        <div>
                                            <label class="form-check-label">S.L</label>
                                        </div>
                                    </th>
                                    <th scope="col" class="text-start">Name</th>
                                    <th scope="col" class="text-start">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            <div class="form-check style-check d-flex align-items-center">
                                                <label class="form-check-label">{{ $loop->iteration }}</label>
                                            </div>
                                        </td class="text-start">
                                        <td class="text-start">{{ $category->name }}</td>
                                        <td class="text-start d-flex align-items-center">
                                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center mx-2">
                                                <iconify-icon icon="lucide:edit"></iconify-icon>
                                            </a>
                                            <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                                method="POST" class="d-inline delete-form mx-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="btn-delete w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
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
    @endsection
