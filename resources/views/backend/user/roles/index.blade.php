@extends('backend.layouts.app')

@section('content')


    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Roles List</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('user.dashboard') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Roles</li>
                </ul>
            </div>
            <x-sweet-alert :type="session('sweetalert.type')" :message="session('sweetalert.message')" :title="session('sweetalert.title')" />
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Roles List</h4>
                            <a href="{{ route('user.roles.create') }}" class="btn btn-primary">+ Create Roles</a>
                        </div>


                        <div class="card-body basic-data-table">
                            <div class="table-responsive">
                                <table class="table bordered-table mb-0 text-start" id="dataTable" data-page-length='10'>
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-start">
                                                <div class="form-check style-check d-flex align-items-center">
                                                    <input class="" type="checkbox">
                                                    <label class="form-check-label">S.L</label>
                                                </div>
                                            </th>
                                            <th scope="col" class="text-start">Name</th>
                                            <th scope="col" class="text-start">Permissions</th>
                                            <th scope="col" class="text-start">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($roles->isNotEmpty())
                                            @foreach ($roles as $key => $role)
                                                <tr>
                                                    <td class="text-start">
                                                        <div class="form-check style-check d-flex align-items-center">
                                                            <input class="" type="checkbox">
                                                            <label class="form-check-label">{{ $key + 1 }}</label>
                                                        </div>
                                                    </td>
                                                    <td class="text-start">{{ $role->name }}</td>
                                                    <td class="text-start">
                                                        @if ($role->permissions->isNotEmpty())
                                                            @foreach ($role->permissions as $permission)
                                                                <span class="badge bg-primary">{{ $permission->name }}</span>
                                                            @endforeach
                                                        @else
                                                            <span class="text-muted">No permissions assigned</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-start d-flex">
                                                        <a href="{{ route('user.roles.edit', $role->id) }}"
                                                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center mx-2">
                                                            <iconify-icon icon="lucide:edit"></iconify-icon>
                                                        </a>
                                                        <form action="{{ route('user.roles.destroy', $role->id) }}" method="POST" class="d-inline mx-2">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                                                onclick="return confirm('Are you sure you want to delete this role?')">
                                                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="4" class="text-start">No roles available.</td>
                                            </tr>
                                        @endif
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
