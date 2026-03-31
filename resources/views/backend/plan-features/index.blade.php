@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Featues List</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-edium">
                        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Plan Features</li>
                </ul>
            </div>
            <x-sweet-alert :type="session('sweetalert.type')" :message="session('sweetalert.message')" :title="session('sweetalert.title')" />

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Feature List</h4>
                            <a href="{{ route('admin.plan-features.create') }}" class="btn btn-primary">+ Create
                                New Feature</a>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive basic-data-table">
                                <table class="table bordered-table mb-0 text-start" id="dataTable" data-page-length='10'>
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-start"> <!-- Aligns left -->
                                                <div>
                                                    <label class="form-check-label">S.L</label>
                                                </div>
                                            </th>
                                            <th class="text-start">Feature Name</th>
                                            <th class="text-start">Plan Name</th>
                                            <th class="text-start">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($features as $key => $feature)
                                        <tr>
                                            <td class="text-start">{{ $key + 1 }}</td>
                                            <td class="text-start">{{ $feature->feature_name ?? 'N/A' }}</td>
                                            <td class="text-start">{{ optional($feature->plan)->name ?? 'N/A' }}</td>
                                            <td class="text-start d-flex">
                                                <a href="{{ route('admin.plan-features.edit', $feature->id) }}"
                                                    class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center mx-2"
                                                    data-bs-toggle="tooltip" title="Edit">
                                                    <iconify-icon icon="lucide:edit"></iconify-icon>
                                                </a>
                                                <form action="{{ route('admin.plan-features.destroy', $feature->id) }}" method="POST" class="d-inline mx-2">
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
        </div>

        </div>
    @endsection
