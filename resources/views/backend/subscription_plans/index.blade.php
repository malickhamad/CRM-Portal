@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">Plans</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 hover-text-success text-success-1000 text-md">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-md text-success-1000">Plans</li>
                </ul>
            </div>
            <x-sweet-alert :type="session('sweetalert.type')" :message="session('sweetalert.message')" :title="session('sweetalert.title')" />
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title text-success-1000">Add Plan </h4>
                            <a href="{{ route('admin.subscription-plans.create') }}" class="btn btn-brand-1">+ Add
                            </a>
                        </div>
                        <div class="card-body basic-data-table">

                            <div class="table-responsive">

                                <table class="table bordered-table mb-0 text-start" id="dataTable" data-page-length='10'>
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-start"> <!-- Aligns left -->
                                                <div>
                                                    <label class="form-check-label text-md">S.L</label>
                                                </div>
                                            </th>
                                            <th scope="col" class="text-start text-md">Name</th>
                                            <th scope="col" class="text-start text-md">Price</th>
                                            <th scope="col" class="text-start text-md">Billing Cycle</th>
                                            <th scope="col" class="text-start text-md">Is Popular</th>
                                            <th scope="col" class="text-start text-md">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($plans as $key => $plan)
                                            <tr>
                                                <td class="text-start text-md">
                                                    <div class="form-check style-check d-flex align-items-center">
                                                        <label class="form-check-label">{{ $key + 1 }}</label>
                                                    </div>
                                                </td>
                                                <td class="text-start text-md ">{{ $plan->name }}</td>
                                                <td class="text-start text-md">${{ number_format($plan->price, 2) }}</td>
                                                <td class="text- text-md">{{ ucfirst($plan->billing_cycle) }}</td>
                                                <td class="text-start text-md">
                                                    <span class="badge {{ $plan->is_popular ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ $plan->is_popular ? 'Yes' : 'No' }}
                                                    </span>
                                                </td>
                                                <td class="text-start text-md d-flex align-items-center">
                                                    <a href="{{ route('admin.subscription-plans.edit', $plan->id) }}"
                                                        class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center mx-2"
                                                        data-bs-toggle="tooltip" title="Edit">
                                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                                    </a>
                                                    <form action="{{ route('admin.subscription-plans.destroy', $plan->id) }}" method="POST" class="d-inline mx-2">
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
