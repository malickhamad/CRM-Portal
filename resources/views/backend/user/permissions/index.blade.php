@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Permissions List</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('user.dashboard') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Permissions</li>
                </ul>
            </div>
            <x-sweet-alert :type="session('sweetalert.type')" :message="session('sweetalert.message')" :title="session('sweetalert.title')" />



            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Permissions List</h4>
                            <a href="{{ route('user.permissions.create') }}" class="btn btn-primary">+ Create
                                Permission</a>
                        </div>
                        <div class="card-body basic-data-table">
                            <div class="table-responsive">
                                <tbody>
                                    @foreach ($permissions as $key => $permission)
                                        <tr>
                                            <td class="text-start">
                                                <div class="form-check style-check d-flex align-items-center">
                                                    <input class="" type="checkbox">
                                                    <label class="form-check-label">{{ $key + 1 }}</label>
                                                </div>
                                            </td>
                                            <td class="text-start">{{ $permission->name }}</td>
                                            <td class="text-start">{{ $permission->created_at->format('Y-m-d') }}</td>
                                            <td class="text-start d-flex">
                                                <a href="{{ route('user.permissions.edit', $permission->id) }}"
                                                    class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center mx-2"
                                                    data-bs-toggle="tooltip" title="Edit">
                                                    <iconify-icon icon="lucide:edit"></iconify-icon>
                                                </a>
                                                <form action="{{ route('user.permissions.destroy', $permission->id) }}" method="POST" class="d-inline mx-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                                        data-bs-toggle="tooltip" title="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this permission?')">
                                                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>



        </div>
    @endsection
