@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">Messages</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">Messages List</li>
                </ul>
            </div>
            <x-sweet-alert :type="session('sweetalert.type')" :message="session('sweetalert.message')" :title="session('sweetalert.title')" />
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4 class="card-title text-success-1000 ">Messages List</h4>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive basic-data-table">
                                <table class="table bordered-table mb-0 text-start" id="dataTable" data-page-length='10'>
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-start">Sr.#</th>
                                            <th scope="col" class="text-start">Name</th>
                                            <th scope="col" class="text-start">Email</th>
                                            <th scope="col" class="text-start">Phone</th>
                                            <th scope="col" class="text-start">Company</th>
                                            <th scope="col" class="text-start">Subject</th>
                                            <th scope="col" class="text-start">Message</th>
                                            <th scope="col" class="text-start">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contacts as $key => $contact)
                                            <tr>
                                                <td class="text-start">{{ $key + 1 }}</td>
                                                <td class="text-start">{{ $contact->name }}</td>
                                                <td class="text-start">{{ $contact->email }}</td>
                                                <td class="text-start">{{ $contact->phone }}</td>
                                                <td class="text-start">{{ $contact->company }}</td>
                                                <td class="text-start">{{ $contact->subject }}</td>
                                                <td class="text-start">{!! Str::limit(strip_tags($contact->message), 50) !!}</td>
                                                <td class="text-start d-flex">
                                                    <div class="btn-group" role="group">
                                                        <!-- Delete Button -->
                                                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="d-inline mx-2"
                                                            onsubmit="return confirmDelete(event);">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button"
                                                                class=" btn-delete w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center "
                                                                data-bs-toggle="tooltip" title="Delete">
                                                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                                            </button>
                                                        </form>
                                                    </div>
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
    @endsection
