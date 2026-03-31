@extends('backend.layouts.app')

@section('content')


    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">Roles</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-successhover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">Roles</li>
                </ul>
            </div>
            <x-sweet-alert :type="session('sweetalert.type')" :message="session('sweetalert.message')" :title="session('sweetalert.title')" />
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title text-success-1000 ">Add Role</h4>
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-brand-1">+ Add</a>
                        </div>


                        <div class="card-body basic-data-table">
                            <div class="table-responsive">
                                <table class="table bordered-table mb-0 text-start" id="dataTable" data-page-length='10'>
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-start" style="width: 80px;">
                                                <div>
                                                    <label class="form-check-label">S.L</label>
                                                </div>
                                            </th>
                                            <th scope="col" class="text-start" style="width: 200px;">Name</th>
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
                                                            <label class="form-check-label">{{ $key + 1 }}</label>
                                                        </div>
                                                    </td>
                                                    <td class="text-start">{{ $role->name }}</td>
                                                    <td class="text-start">
                                                        @if ($role->permissions->isNotEmpty() || $role->users->isNotEmpty())
                                                            @foreach ($role->permissions as $permission)
                                                                <span class="badge bg-success-800">{{ $permission->name }}</span>
                                                            @endforeach

                                                            {{-- Check for subusers' permissions if available --}}
                                                            @if ($role->users->isNotEmpty())
                                                                @foreach ($role->users as $user)
                                                                    @foreach ($user->permissions as $permission)
                                                                        <span class="badge bg-success-800">{{ $permission->name }}</span>
                                                                    @endforeach
                                                                @endforeach
                                                            @endif
                                                        @else
                                                            <span class="text-muted">No permissions assigned</span>
                                                        @endif
                                                    </td>

                                                    <td class="text-start d-flex align-items-center">
                                                        <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                            class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center mx-2">
                                                            <iconify-icon icon="lucide:edit"></iconify-icon>
                                                        </a>
                                                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="d-inline mx-2">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button"
                                                                class="btn-delete w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center mb-0">
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
