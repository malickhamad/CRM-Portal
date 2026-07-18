@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">Users</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">Users</li>
                </ul>
            </div>
            <x-sweet-alert :type="session('sweetalert.type')" :message="session('sweetalert.message')" :title="session('sweetalert.title')" />

            <div class="row">
                <div class="col-md-12">
                    <div class="card basic-data-table">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title text-success-1000">Add User</h4>
                            <a href="{{ route('admin.users.create') }}" class="btn btn-brand-1">+ Add</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive scroll-lg">
                                <table class="table bordered-table mb-0 text-start" id="dataTable" data-page-length='10'>
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-start">
                                                <div>
                                                    <label class="form-check-label">S.L</label>
                                                </div>
                                            </th>
                                            <th scope="col" class="text-start">Name</th>
                                            {{-- <th scope="col" class="text-start">Type</th> --}}
                                            <th scope="col" class="text-start">Roles</th>
                                            {{-- <th scope="col" class="text-start">Standards</th> <!-- New Standards column --> --}}
                                            <th scope="col" class="text-start">Created By</th>
                                            <th scope="col" class="text-start">Status</th>
                                            <th scope="col" class="text-start">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <td class="text-start">
                                                    <div class="form-check style-check d-flex align-items-center">
                                                        <label class="form-check-label">{{ $key + 1 }}</label>
                                                    </div>
                                                </td>
                                                <td class="text-start">
                                                    <div class="d-flex align-items-center">
                                                        <h6 class="text-md mb-0 fw-medium ms-2">{{ $user->name }}</h6>
                                                    </div>
                                                </td>
                                                {{-- <td class="text-start">
                                                    @if ($user->hasRole('Admin'))
                                                        <span class="badge bg-danger">Admin</span>
                                                    @elseif ($user->Subuser)
                                                        <span class="badge bg-warning">Subuser</span>
                                                    @elseif ($user->hasRole('User'))
                                                        <span class="badge bg-info">Company</span>
                                                    @else
                                                        @foreach ($user->roles as $role)
                                                            <span class="badge bg-success">{{ $role->name }}</span>
                                                        @endforeach
                                                    @endif
                                                </td> --}}
                                                <td class="text-start">
                                                    @foreach ($user->roles as $role)
                                                        <span class="badge bg-primary">{{ $role->name }}</span>
                                                    @endforeach
                                                </td>

                                                <td class="text-start">
                                                    @if ($user->parent_id)
                                                        {{ $user->parent->name ?? 'Unknown' }}
                                                    @elseif ($user->hasRole('Admin'))
                                                        System
                                                    @else
                                                        {{ $user->created_by ?? 'Admin' }}
                                                    @endif
                                                </td>
                                                <td class="text-start">
                                                    <span class="badge bg-{{ $user->status == 'active' ? 'success' : 'danger' }}">
                                                        {{ ucfirst($user->status) }}
                                                    </span>
                                                </td>
                                                <td class="text-start d-flex">
                                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                                        class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center mx-2">
                                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                                    </a>
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline mx-2">
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
