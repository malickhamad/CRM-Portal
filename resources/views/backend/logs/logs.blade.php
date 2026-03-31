    @extends('backend.layouts.app')

    @section('content')
        <main class="dashboard-main">
            @include('backend.layouts.partials.header')

            <div class="dashboard-main-body">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                    <h6 class="fw-semibold mb-0 text-success-1000">Logs/Activities</h6>
                    <ul class="d-flex align-items-center gap-2">
                        <li class="fw-medium">
                            <a href="{{ route('admin.dashboard') }}"
                                class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success">
                                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                                Dashboard
                            </a>
                        </li>
                        <li>-</li>
                        <li class="fw-medium text-success-1000 text-md">Logs</li>
                    </ul>
                </div>
                <x-sweet-alert :type="session('sweetalert.type')" :message="session('sweetalert.message')" :title="session('sweetalert.title')" />

                <div class="row">
                <div class="col-md-12">
                    <div class="card basic-data-table">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title text-success-1000 ">Logs</h4>
                            <
                        </div>
                            <div class="card-body  ">
                                {{-- show here logs --}}
                                <div class="table-responsive">
                                    <table class="table bordered-table mb-0 text-start" id="dataTable"
                                        data-page-length='10'>
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-start w-110-px"> <!-- Aligns left -->
                                                    <div>
                                                        <label class="form-check-label">S.L</label>
                                                    </div>
                                                </th>
                                                <th>User</th>
                                                <th>Event</th>
                                                <th>Time</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($logs as $key => $log)
                                                <tr>
                                                    <td class="text-start">               
                                                           {{ $key + 1 }}
                                                    </td>
                                                    <td class="text-start">
                                                        {{ $log->causer ? $log->causer->name : 'Unknown' }}</td>
                                                    <td class="text-start">{{ $log->description }}</td>
                                                    <td class="text-start">{{ $log->created_at->format('d-m-Y H:i:s') }}
                                                    </td>
                                                    <td class="text-start d-flex">
                                                        <form action="{{ route('admin.logs.destroy', $log->id) }}"
                                                            method="POST" class="d-inline mx-2">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button"
                                                                class="btn-delete w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center "
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

                                <!-- Clear All Logs Button -->
                                <form action="{{ route('admin.logs.clear') }}" method="POST" class="mt-3">
                                    @csrf
                                    <button type="submit" class="btn btn-warning"
                                        onclick="return confirm('Are you sure you want to clear all logs?')">
                                        Clear All Logs
                                    </button>
                                </form>


                            </div>
                        </div>
                    </div>


                </div>
            </div>
            </div>

            </div>
        @endsection
