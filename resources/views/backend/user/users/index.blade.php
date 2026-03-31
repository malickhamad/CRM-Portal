@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">SubUsers</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('user.dashboard') }}" class="d-flex align-items-center gap-1 hover-text-success text-success-1000">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">SubUsers</li>
                </ul>
            </div>
            <x-sweet-alert :type="session('sweetalert.type')" :message="session('sweetalert.message')" :title="session('sweetalert.title')" />

            <div class="row gy-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0 text-success-1000 ">Add SubUser</h5>
                            <a href="{{ route('user.subusers.create') }}" class="btn btn-brand-1">+ Add</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive scroll-lg basic-data-table">
                                <table class="table bordered-table mb-0 text-start" id="dataTable" data-page-length="10">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-start w-110-px">
                                                <div class="form-check style-check d-flex align-items-center">
                                                    <input class="" type="checkbox">
                                                    <label class="form-check-label">S.L</label>
                                                </div>
                                            </th>
                                            <th scope="col" class="text-start">Name</th>
                                            <th scope="col" class="text-start">Email</th>
                                            <th scope="col" class="text-start">Permissions</th>
                                            <th scope="col" class="text-start">Standards</th>
                                            <!-- New Standards column -->
                                            <th scope="col" class="text-start">Status</th>
                                            <th scope="col" class="text-start">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subusers as $key => $subuser)
                                            <tr>
                                                <!-- Serial Number -->
                                                <td class="text-start">
                                                    <div class="form-check style-check d-flex align-items-center">
                                                        <input class="" type="checkbox">
                                                        <label class="form-check-label">{{ $key + 1 }}</label>
                                                    </div>
                                                </td>

                                                <!-- Subuser Name -->
                                                <td class="text-start">
                                                    <div class="d-flex align-items-center">
                                                        <h6 class="text-md mb-0 fw-medium ms-2">{{ $subuser->name }}</h6>
                                                    </div>
                                                </td>

                                                <!-- Subuser Email -->
                                                <td class="text-start">{{ $subuser->email }}</td>

                                                <!-- Subuser Permissions -->
                                                <td class="text-start">
                                                    @if ($subuser->permissions->isNotEmpty())
                                                        <div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"
                                                            title="{{ $subuser->permissions->pluck('name')->join(', ') }}">
                                                            @foreach ($subuser->permissions as $permission)
                                                                <span
                                                                    class="badge bg-primary mb-1">{{ $permission->name }}</span>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <span class="text-muted">No permissions assigned</span>
                                                    @endif
                                                </td>


                                                <!-- Subuser Standards -->
                                                <td class="text-start">
                                                    @if ($subuser->standards->isNotEmpty())
                                                        <div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"
                                                            title="{{ $subuser->standards->pluck('name')->join(', ') }}">
                                                            @foreach ($subuser->standards as $standard)
                                                                <span
                                                                    class="badge bg-secondary mb-1">{{ $standard->name }}</span>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <span class="text-muted">No standards</span>
                                                    @endif
                                                </td>

                                                <!-- Subuser Status -->
                                                <td class="text-start">
                                                    <span
                                                        class="badge bg-{{ $subuser->status === 'active' ? 'success' : 'danger' }}">
                                                        {{ ucfirst($subuser->status) }}
                                                    </span>
                                                </td>

                                                <!-- Actions -->
                                                <td class="text-start d-flex align-items-center">
                                                    <a href="{{ route('user.subusers.edit', $subuser->id) }}"
                                                        class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center mx-2">
                                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                                    </a>
                                                    <form action="{{ route('user.subusers.destroy', $subuser->id) }}" method="POST" class="d-inline mx-2">
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
            </div>

        </div>
    @endsection
