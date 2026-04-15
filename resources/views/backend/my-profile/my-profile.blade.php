{{-- @extends('backend.layouts.app')

    @section('content')
        <main class="dashboard-main">
            @include('backend.layouts.partials.header')

            <div class="dashboard-main-body">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                    <h6 class="fw-semibold mb-0 text-success-1000">Notepad</h6>
                    <ul class="d-flex align-items-center gap-2">
                        <li class="fw-medium">
                            <a href="{{ route('admin.dashboard') }}"
                                class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success">
                                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                                Dashboard
                            </a>
                        </li>
                        <li>-</li>
                        <li class="fw-medium text-success-1000 text-md">Notepad</li>
                    </ul>
                </div>
                <x-sweet-alert :type="session('sweetalert.type')" :message="session('sweetalert.message')" :title="session('sweetalert.title')" />

                <style>
                    .cke_notification_warning {
                        display: none !important;
                    }
                </style>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card basic-data-table">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title text-success-1000 ">Notepads</h4>

                            </div>


                            <div class="card-body  ">




                                <div class="col-md-12">
                                    <div class=" basic-data-table">

                                        <div class="card-header">
                                            <a href="javascript:void(0)" class="btn btn-brand-1" data-bs-toggle="modal"
                                                data-bs-target="#notepadModal" id="addNotepadBtn">
                                                + Add Notepad
                                            </a>
                                        </div>

                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table bordered-table mb-0 text-start table-hover table-sm"
                                                    id="dataTable">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th class="col-10">File Name</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach ($notepads as $note)
                                                            <tr>
                                                                <td class="text-muted py-3">
                                                                    {{ $note->file_name }}
                                                                </td>

                                                                <td class="text-nowrap">
                                                                    <a href="javascript:void(0)"
                                                                        class="viewBtn w-32-px h-32-px bg-success-focus text-success green_color-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                                                        data-id="{{ $note->id }}"
                                                                        data-name="{{ $note->file_name }}">
                                                                        <iconify-icon icon="lucide:eye"></iconify-icon>
                                                                    </a>

                                                                    <a href="javascript:void(0)"
                                                                        class="editBtn w-32-px h-32-px bg-success-focus text-success green_color-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                                                        data-id="{{ $note->id }}"
                                                                        data-name="{{ $note->file_name }}">
                                                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                                                    </a>

                                                                   <form action="{{ route('admin.notepad.destroy', $note->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button"
                                                                class="btn-delete w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center border-0">
                                                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                                            </button>
                                                        </form>
                                                                    <!-- Hidden HTML content -->
                                                                    <div id="note-content-{{ $note->id }}"
                                                                        class="d-none">{!! $note->description !!}</div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>




                                <!-- ADD / EDIT MODAL -->
                                <div class="modal fade" id="notepadModal" tabindex="-1">
                                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content border-0 shadow" style="height: 90vh;">

                                            <div class="modal-header bg-light">
                                                <h5 class="modal-title fw-semibold">
                                                    <i class="bi bi-journal-text me-2 text-success"></i>
                                                    Notepad
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <form method="POST" action="{{ route('admin.notepad.store') }}"
                                                id="notepadForm">
                                                @csrf
                                                <input type="hidden" id="method_field" name="_method" value="POST">

                                                <div class="modal-body bg-white"
                                                    style="overflow-y:auto; max-height: calc(90vh - 140px);">
                                                    <div class="mb-3">
                                                        <input type="text" name="file_name" id="file_name"
                                                            class="form-control" placeholder="Enter file name" required>
                                                    </div>

                                                    <div class="d-flex align-items-stretch gap-2">
                                                        <div
                                                            class="d-flex align-items-center px-2 border rounded bg-light fw-semibold text-success">
                                                            Editor
                                                        </div>

                                                        <div class="flex-grow-1">
                                                            <textarea name="description" id="editor"></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer border-0 bg-light">
                                                    <button type="button" class="btn btn-light border"
                                                        data-bs-dismiss="modal">
                                                        Cancel
                                                    </button>

                                                    <button type="submit" class="btn bg_green_color text-white">
                                                        Save Notepad
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                                <!-- VIEW MODAL -->
                                <div class="modal fade" id="viewNotepadModal" tabindex="-1">
                                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content border-0 shadow" style="height: 80vh;">

                                            <div class="modal-header bg-light">
                                                <h5 class="modal-title fw-semibold">
                                                    <i class="bi bi-eye me-2 text-success"></i>
                                                    View Notepad
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body bg-white">
                                                <h5 id="view_title" class="mb-3"></h5>
                                                <div id="view_content"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                                <script>
                                    function initCkEditor4() {
                                        if (CKEDITOR.instances.editor) {
                                            return;
                                        }

                                        CKEDITOR.replace('editor', {
                                            height: 350,
                                            allowedContent: true,
                                            extraAllowedContent: '*(*);*{*}',
                                            filebrowserUploadUrl: "{{ route('admin.notepad.upload.image') }}?_token={{ csrf_token() }}",
                                            filebrowserUploadMethod: 'form'
                                        });
                                    }

                                    $(document).ready(function() {
                                        initCkEditor4();
                                    });

                                    $('#addNotepadBtn').on('click', function() {
                                        $('#notepadForm').attr('action', "{{ route('admin.notepad.store') }}");
                                        $('#method_field').val('POST');
                                        $('#file_name').val('');

                                        setTimeout(function() {
                                            initCkEditor4();
                                            if (CKEDITOR.instances.editor) {
                                                CKEDITOR.instances.editor.setData('');
                                            }
                                        }, 200);
                                    });

                                    $(document).on('click', '.editBtn', function() {
                                        let id = $(this).data('id');
                                        let name = $(this).data('name');
                                        let desc = $('#note-content-' + id).html() || '';

                                        $('#file_name').val(name);
                                        $('#notepadForm').attr('action', "{{ url('admin/notepad') }}/" + id);
                                        $('#method_field').val('PUT');

                                        $('#notepadModal').modal('show');

                                        setTimeout(function() {
                                            initCkEditor4();
                                            if (CKEDITOR.instances.editor) {
                                                CKEDITOR.instances.editor.setData(desc);
                                            }
                                        }, 200);
                                    });

                                    $(document).on('click', '.viewBtn', function() {
                                        let id = $(this).data('id');
                                        let name = $(this).data('name');
                                        let desc = $('#note-content-' + id).html() || '';

                                        $('#view_title').text(name);
                                        $('#view_content').html(desc);
                                        $('#viewNotepadModal').modal('show');
                                    });

                                    $('#notepadForm').on('submit', function() {
                                        if (CKEDITOR.instances.editor) {
                                            CKEDITOR.instances.editor.updateElement();
                                        }
                                    });

                                    $('#notepadModal').on('hidden.bs.modal', function() {
                                        $('#file_name').val('');
                                        $('#method_field').val('POST');
                                        $('#notepadForm').attr('action', "{{ route('admin.notepad.store') }}");

                                        if (CKEDITOR.instances.editor) {
                                            CKEDITOR.instances.editor.setData('');
                                        }
                                    });
                                </script>
                            </div>


                        </div>
                    </div>


                </div>
            </div>
            </div>

            </div>
        @endsection --}}








@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main bg-light min-vh-100">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="container-fluid px-3 py-3">

                {{-- Employee Profile --}}
                <div class="card border-0 shadow-sm mb-3 rounded-4 overflow-hidden">
                    <div class="card-body p-0">

                        {{-- top strip --}}
                        <div class="bg_green_color px-3 px-md-4 py-3">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <div>
                                    <div class="text-white fw-bold" style="font-size:20px; line-height:1;">
                                        Employee Profile
                                    </div>
                                    <div class="text-white-50" style="font-size:11px;">
                                        Dashboard &nbsp; - &nbsp; Profile
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge rounded-pill text-bg-light fw-medium px-3 py-2" style="font-size:10px;">
                                        Code: 104
                                    </span>
                                    <span class="badge rounded-pill bg-success-subtle text-success-emphasis fw-medium px-3 py-2" style="font-size:10px;">
                                        ● Working
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="p-3 p-md-4 bg-body-tertiary">
                            <div class="card border-0 shadow-sm rounded-4">
                                <div class="card-body p-3">

                                    <div class="d-flex align-items-start gap-3">

                                        {{-- Avatar --}}
                                        <div class="flex-shrink-0">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold shadow-sm bg_green_color fs-5"
                                                style="width:68px;height:68px;">
                                                X
                                            </div>
                                        </div>

                                        <div class="flex-grow-1">

                                            {{-- name section --}}
                                            <div class="pb-2 mb-3 border-bottom">
                                                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                                                    <div>
                                                        <h4 class="mb-1 fw-bold text-dark" style="font-size:22px; line-height:1.05;">
                                                            Shoaib Shah
                                                        </h4>
                                                        <div class="text-muted" style="font-size:11px;">
                                                            S / D / O
                                                        </div>
                                                    </div>

                                                    <div class="d-flex flex-wrap gap-2">
                                                        <span class="badge rounded-pill bg-success-subtle text-success-emphasis fw-medium px-3 py-2" style="font-size:10px;">
                                                            ● Working
                                                        </span>
                                                        <span class="badge rounded-pill text-bg-light fw-medium px-3 py-2" style="font-size:10px;">
                                                            Code: 104
                                                        </span>
                                                        <span class="badge rounded-pill bg-light text-success-emphasis fw-medium px-3 py-2 border" style="font-size:10px;">
                                                            Out Source
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- info table --}}
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-sm align-middle mb-0" style="font-size:11px;">
                                                    <tbody>
                                                        <tr>
                                                            <td class="fw-semibold bg-light py-1 px-3 text-nowrap">CODE :</td>
                                                            <td class="py-1 px-3 text-nowrap">104</td>
                                                            <td class="fw-semibold bg-light py-1 px-3 text-nowrap">DESIGNATION :</td>
                                                            <td class="py-1 px-3 text-nowrap">Out Source</td>
                                                            <td class="fw-semibold bg-light py-1 px-3 text-nowrap">STATUS :</td>
                                                            <td class="py-1 px-3 text-nowrap">Working</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-semibold bg-light py-1 px-3 text-nowrap">CNIC NO :</td>
                                                            <td class="py-1 px-3 text-nowrap">00000-0000000-0</td>
                                                            <td class="fw-semibold bg-light py-1 px-3 text-nowrap">MOBILE NO :</td>
                                                            <td class="py-1 px-3 text-nowrap">03427635722</td>
                                                            <td class="fw-semibold bg-light py-1 px-3 text-nowrap">EMAIL :</td>
                                                            <td class="py-1 px-3 text-nowrap"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-semibold bg-light py-1 px-3 text-nowrap">MARITAL STATUS :</td>
                                                            <td class="py-1 px-3 text-nowrap">Married</td>
                                                            <td class="fw-semibold bg-light py-1 px-3 text-nowrap">DATE OF BIRTH :</td>
                                                            <td class="py-1 px-3 text-nowrap">13-10-2025</td>
                                                            <td class="fw-semibold bg-light py-1 px-3 text-nowrap">RELIGION :</td>
                                                            <td class="py-1 px-3 text-nowrap"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-semibold bg-light py-1 px-3 text-nowrap">FLOOR :</td>
                                                            <td class="py-1 px-3 text-nowrap">Out source</td>
                                                            <td class="fw-semibold bg-light py-1 px-3 text-nowrap">SHIFT :</td>
                                                            <td class="py-1 px-3 text-nowrap"></td>
                                                            <td class="fw-semibold bg-light py-1 px-3 text-nowrap">DEPARTMENT :</td>
                                                            <td class="py-1 px-3 text-nowrap">Out Source</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-semibold bg-light py-1 px-3 text-nowrap">Account Title :</td>
                                                            <td class="py-1 px-3 text-nowrap"></td>
                                                            <td class="fw-semibold bg-light py-1 px-3 text-nowrap"></td>
                                                            <td class="py-1 px-3 text-nowrap"></td>
                                                            <td class="fw-semibold bg-light py-1 px-3 text-nowrap">Account Number :</td>
                                                            <td class="py-1 px-3 text-nowrap"></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-semibold bg-light py-1 px-3 text-nowrap">ADDRESS :</td>
                                                            <td class="py-1 px-3" colspan="5">139B ali mall d ground faisalabad</td>
                                                        </tr>
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

                {{-- Qualifications --}}
                <div class="card border-0 shadow-sm mb-3 rounded-4 overflow-hidden">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
                        <span class="fw-semibold green_color" style="font-size:13px;">Qualifications</span>
                        <div class="text-muted d-flex gap-2" style="font-size:11px;">
                            <span>□</span>
                            <span>−</span>
                            <span>✕</span>
                        </div>
                    </div>
                    <div class="card-body p-2 bg-white">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm align-middle mb-0" style="font-size:11px;">
                                <thead class="table-success">
                                    <tr>
                                        <th class="fw-semibold py-1 px-3 text-nowrap">DEGREE</th>
                                        <th class="fw-semibold py-1 px-3 text-nowrap">YEAR</th>
                                        <th class="fw-semibold py-1 px-3 text-nowrap">MAJOR SUBJECT</th>
                                        <th class="fw-semibold py-1 px-3 text-nowrap">DIVISION</th>
                                        <th class="fw-semibold py-1 px-3 text-nowrap">MARKS</th>
                                        <th class="fw-semibold py-1 px-3 text-nowrap">UNIVERSITY / BOARD</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-1 px-3"></td>
                                        <td class="py-1 px-3"></td>
                                        <td class="py-1 px-3"></td>
                                        <td class="py-1 px-3"></td>
                                        <td class="py-1 px-3"></td>
                                        <td class="py-1 px-3"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Experience --}}
                <div class="card border-0 shadow-sm mb-3 rounded-4 overflow-hidden">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
                        <span class="fw-semibold green_color" style="font-size:13px;">Experience</span>
                        <div class="text-muted d-flex gap-2" style="font-size:11px;">
                            <span>□</span>
                            <span>−</span>
                            <span>✕</span>
                        </div>
                    </div>
                    <div class="card-body p-2 bg-white">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm align-middle mb-0" style="font-size:11px;">
                                <thead class="table-success">
                                    <tr>
                                        <th class="fw-semibold py-1 px-3 text-nowrap">DEPARTMENT</th>
                                        <th class="fw-semibold py-1 px-3 text-nowrap">DESIGNATION</th>
                                        <th class="fw-semibold py-1 px-3 text-nowrap">FROM</th>
                                        <th class="fw-semibold py-1 px-3 text-nowrap">TO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-1 px-3"></td>
                                        <td class="py-1 px-3"></td>
                                        <td class="py-1 px-3"></td>
                                        <td class="py-1 px-3"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Misc Information --}}
                <div class="card border-0 shadow-sm mb-3 rounded-4 overflow-hidden">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
                        <span class="fw-semibold green_color" style="font-size:13px;">Misc Information</span>
                        <div class="text-muted d-flex gap-2" style="font-size:11px;">
                            <span>□</span>
                            <span>−</span>
                            <span>✕</span>
                        </div>
                    </div>
                    <div class="card-body p-2 bg-white">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm align-middle mb-0" style="font-size:11px;">
                                <tbody>
                                    <tr class="table-success">
                                        <td class="fw-semibold py-1 px-3 text-nowrap w-50">EMERGENCY CONTACT :</td>
                                        <td class="fw-semibold py-1 px-3 text-nowrap">CONTACT NAME :</td>
                                        <td class="fw-semibold py-1 px-3 text-nowrap">RELATION :</td>
                                    </tr>
                                    <tr>
                                        <td class="py-1 px-3"></td>
                                        <td class="py-1 px-3"></td>
                                        <td class="py-1 px-3"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Commissions Details --}}
                <div class="card border-0 shadow-sm mb-3 rounded-4 overflow-hidden">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
                        <span class="fw-semibold green_color" style="font-size:13px;">Comissions Details</span>
                        <div class="text-muted d-flex gap-2" style="font-size:11px;">
                            <span>□</span>
                            <span>−</span>
                            <span>✕</span>
                        </div>
                    </div>

                    <div class="card-body px-3 py-3 bg-white">

                        <h6 class="fw-bold mb-2 green_color" style="font-size:13px;">FEB 2026</h6>
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-hover table-sm text-center align-middle mb-0" style="font-size:11px;">
                                <thead class="table-success">
                                    <tr>
                                        <th class="py-1 px-2 text-nowrap">Sr</th>
                                        <th class="py-1 px-2 text-nowrap">Sale Num</th>
                                        <th class="py-1 px-2 text-nowrap">Sale Date</th>
                                        <th class="py-1 px-2 text-nowrap">Mature Date</th>
                                        <th class="py-1 px-2 text-nowrap">Paid Date</th>
                                        <th class="py-1 px-2 text-nowrap">Agent</th>
                                        <th class="py-1 px-2 text-nowrap">Buisness Name</th>
                                        <th class="py-1 px-2 text-nowrap">Service</th>
                                        <th class="py-1 px-2 text-nowrap">Commission</th>
                                        <th class="py-1 px-2 text-nowrap">Payout</th>
                                        <th class="py-1 px-2 text-nowrap">Amount Transfer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-1 px-2">1</td>
                                        <td class="py-1 px-2">550</td>
                                        <td class="py-1 px-2">28-01-2026</td>
                                        <td class="py-1 px-2">23-02-2026</td>
                                        <td class="py-1 px-2">02-03-2026</td>
                                        <td class="py-1 px-2">Shoaib Shah</td>
                                        <td class="py-1 px-2 text-nowrap">RAJ INTERNATIONAL STORE LTD</td>
                                        <td class="py-1 px-2 text-nowrap">Card Machine (1)</td>
                                        <td class="fw-bold py-1 px-2 text-nowrap">PKR 76,230</td>
                                        <td class="py-1 px-2"><span class="badge rounded-pill bg_green_color px-3 py-1">Finalized</span></td>
                                        <td class="py-1 px-2">Transferred</td>
                                    </tr>
                                    <tr>
                                        <td class="py-1 px-2">2</td>
                                        <td class="py-1 px-2">577</td>
                                        <td class="py-1 px-2">06-02-2026</td>
                                        <td class="py-1 px-2">26-02-2026</td>
                                        <td class="py-1 px-2">02-03-2026</td>
                                        <td class="py-1 px-2">Shoaib Shah</td>
                                        <td class="py-1 px-2 text-nowrap">TV MANCHESTER LTD</td>
                                        <td class="py-1 px-2 text-nowrap">Card Machine (1)</td>
                                        <td class="fw-bold py-1 px-2 text-nowrap">PKR 93,654</td>
                                        <td class="py-1 px-2"><span class="badge rounded-pill bg_green_color px-3 py-1">Finalized</span></td>
                                        <td class="py-1 px-2">Transferred</td>
                                    </tr>
                                    <tr>
                                        <td class="py-1 px-2">3</td>
                                        <td class="py-1 px-2">578</td>
                                        <td class="py-1 px-2">06-02-2026</td>
                                        <td class="py-1 px-2">26-02-2026</td>
                                        <td class="py-1 px-2">02-03-2026</td>
                                        <td class="py-1 px-2">Shoaib Shah</td>
                                        <td class="py-1 px-2 text-nowrap">TV MANCHESTER LTD</td>
                                        <td class="py-1 px-2 text-nowrap">Card Machine (1)</td>
                                        <td class="fw-bold py-1 px-2 text-nowrap">PKR 93,654</td>
                                        <td class="py-1 px-2"><span class="badge rounded-pill bg_green_color px-3 py-1">Finalized</span></td>
                                        <td class="py-1 px-2">Transferred</td>
                                    </tr>
                                    <tr>
                                        <td class="py-1 px-2">4</td>
                                        <td class="py-1 px-2">658</td>
                                        <td class="py-1 px-2">24-02-2026</td>
                                        <td class="py-1 px-2">26-02-2026</td>
                                        <td class="py-1 px-2">02-03-2026</td>
                                        <td class="py-1 px-2">Shoaib Shah</td>
                                        <td class="py-1 px-2 text-nowrap">K &amp; B Food And Wine</td>
                                        <td class="py-1 px-2 text-nowrap">Card Machine (1)</td>
                                        <td class="fw-bold py-1 px-2 text-nowrap">PKR 93,654</td>
                                        <td class="py-1 px-2"><span class="badge rounded-pill bg_green_color px-3 py-1">Finalized</span></td>
                                        <td class="py-1 px-2">Transferred</td>
                                    </tr>
                                    <tr class="table-light">
                                        <td colspan="8" class="text-center fw-bold py-1 px-2">Total</td>
                                        <td class="fw-bold py-1 px-2 text-nowrap">PKR 357,192</td>
                                        <td colspan="2" class="py-1 px-2"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h6 class="fw-bold mb-2 green_color" style="font-size:13px;">MARCH 2026</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-sm text-center align-middle mb-0" style="font-size:11px;">
                                <thead class="table-success">
                                    <tr>
                                        <th class="py-1 px-2 text-nowrap">Sr</th>
                                        <th class="py-1 px-2 text-nowrap">Sale Num</th>
                                        <th class="py-1 px-2 text-nowrap">Sale Date</th>
                                        <th class="py-1 px-2 text-nowrap">Mature Date</th>
                                        <th class="py-1 px-2 text-nowrap">Paid Date</th>
                                        <th class="py-1 px-2 text-nowrap">Agent</th>
                                        <th class="py-1 px-2 text-nowrap">Buisness Name</th>
                                        <th class="py-1 px-2 text-nowrap">Service</th>
                                        <th class="py-1 px-2 text-nowrap">Commission</th>
                                        <th class="py-1 px-2 text-nowrap">Payout</th>
                                        <th class="py-1 px-2 text-nowrap">Amount Transfer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-1 px-2">1</td>
                                        <td class="py-1 px-2">592</td>
                                        <td class="py-1 px-2">11-02-2026</td>
                                        <td class="py-1 px-2">11-03-2026</td>
                                        <td class="py-1 px-2"></td>
                                        <td class="py-1 px-2">Shoaib Shah</td>
                                        <td class="py-1 px-2 text-nowrap">NSEJAS CALABAR KITCHEN</td>
                                        <td class="py-1 px-2 text-nowrap">Card Machine (1)</td>
                                        <td class="fw-bold py-1 px-2 text-nowrap">PKR 89,298</td>
                                        <td class="py-1 px-2"><span class="badge rounded-pill bg_green_color px-3 py-1">Finaliz For Payout</span></td>
                                        <td class="py-1 px-2">Pending</td>
                                    </tr>
                                    <tr>
                                        <td class="py-1 px-2">2</td>
                                        <td class="py-1 px-2">595</td>
                                        <td class="py-1 px-2">11-02-2026</td>
                                        <td class="py-1 px-2">11-03-2026</td>
                                        <td class="py-1 px-2"></td>
                                        <td class="py-1 px-2">Shoaib Shah</td>
                                        <td class="py-1 px-2 text-nowrap">Budleigh Mini Super Market</td>
                                        <td class="py-1 px-2 text-nowrap">Card Machine (1)</td>
                                        <td class="fw-bold py-1 px-2 text-nowrap">PKR 89,298</td>
                                        <td class="py-1 px-2"><span class="badge rounded-pill bg_green_color px-3 py-1">Finaliz For Payout</span></td>
                                        <td class="py-1 px-2">Pending</td>
                                    </tr>
                                    <tr>
                                        <td class="py-1 px-2">3</td>
                                        <td class="py-1 px-2">619</td>
                                        <td class="py-1 px-2">16-02-2026</td>
                                        <td class="py-1 px-2">11-03-2026</td>
                                        <td class="py-1 px-2"></td>
                                        <td class="py-1 px-2">Shoaib Shah</td>
                                        <td class="py-1 px-2 text-nowrap">HOMEBAZAARUK LTD</td>
                                        <td class="py-1 px-2 text-nowrap">Card Machine (1)</td>
                                        <td class="fw-bold py-1 px-2 text-nowrap">PKR 89,298</td>
                                        <td class="py-1 px-2"><span class="badge rounded-pill bg_green_color px-3 py-1">Finaliz For Payout</span></td>
                                        <td class="py-1 px-2">Pending</td>
                                    </tr>
                                    <tr class="table-light">
                                        <td colspan="8" class="text-center fw-bold py-1 px-2">Total</td>
                                        <td class="fw-bold py-1 px-2 text-nowrap">PKR 267,894</td>
                                        <td colspan="2" class="py-1 px-2"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                {{-- Documents --}}
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
                        <span class="fw-semibold green_color" style="font-size:13px;">Documents</span>
                        <div class="text-muted d-flex gap-2" style="font-size:11px;">
                            <span>□</span>
                            <span>−</span>
                            <span>✕</span>
                        </div>
                    </div>
                    <div class="card-body bg-white" style="height:90px;"></div>
                </div>

            </div>
        </div>
    </main>
@endsection
