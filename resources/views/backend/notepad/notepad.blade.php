    @extends('backend.layouts.app')

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
        @endsection
