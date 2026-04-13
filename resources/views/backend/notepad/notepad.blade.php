@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body bg-light position-relative pt-5">

            <!-- Back Button -->
            <div class="position-absolute top-0 start-0 mt-3 ms-3">
                <a href="javascript:history.back()"
                    class="btn btn-light border shadow-sm rounded-pill px-3 py-2 fw-semibold d-flex align-items-center gap-2 bg_green_color">
                    ← Back
                </a>
            </div>

            <div class="container-fluid bg-white px-3 py-5">

                <!-- HEADER -->
                <div class="mb-3 px-3 py-2 bg-white border rounded">
                    <h6 class="fw-bold mb-0 green_color">
                        <i class="bi bi-ui-checks-grid me-1"></i> Notepad
                    </h6>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        <div class="card basic-data-table">

                            <!-- ADD BUTTON -->
                            <div class="card-header">
                                <a href="javascript:void(0)" class="btn btn-brand-1" data-bs-toggle="modal"
                                    data-bs-target="#notepadModal">
                                    + Add Notepad
                                </a>
                            </div>

                            <!-- TABLE -->
                            <div class="card-body">
                                <div class="table-responsive">

                                    <table class="table bordered-table mb-0 text-start table-hover table-sm" id="dataTable" >

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

                                                        <!-- VIEW -->
                                                        <a href="javascript:void(0)"
                                                            class="viewBtn w-32-px h-32-px bg-success-focus text-success green_color-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                                            data-name="{{ $note->file_name }}"
                                                            data-desc="{!! $note->description !!}">
                                                            <iconify-icon icon="lucide:eye"></iconify-icon>
                                                        </a>

                                                        <!-- EDIT -->
                                                        <a href="javascript:void(0)"
                                                            class="editBtn w-32-px h-32-px bg-success-focus text-success green_color-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                                            data-id="{{ $note->id }}" data-name="{{ $note->file_name }}"
                                                            data-desc="{!! $note->description !!}">
                                                            <iconify-icon icon="lucide:edit"></iconify-icon>
                                                        </a>

                                                        <!-- DELETE -->
                                                        <form action="{{ route('admin.notepad.destroy', $note->id) }}"
                                                            method="POST" class="d-inline-flex align-items-center m-0"
                                                            onsubmit="return confirm('Are you sure you want to delete this note?')">

                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center border-0">
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

        <!-- ================= ADD / EDIT MODAL ================= -->
        <div class="modal fade" id="notepadModal" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

                <div class="modal-content border-0 shadow" style="height: 90vh;">

                    <!-- HEADER -->
                    <div class="modal-header bg-light">
                        <h5 class="modal-title fw-semibold">
                            <i class="bi bi-journal-text me-2 text-success"></i>
                            Notepad
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <form method="POST" action="{{ route('admin.notepad.store') }}" id="notepadForm">

                        @csrf
                        <input type="hidden" id="method_field" name="_method" value="POST">

                        <div class="modal-body bg-white" style="overflow-y:auto; max-height: calc(90vh - 140px);">

                            <div class="mb-3">
                                <input type="text" name="file_name" id="file_name" class="form-control"
                                    placeholder="Enter file name" required>
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

                            <button type="button" class="btn btn-light border" data-bs-dismiss="modal">
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

        <!-- ================= VIEW MODAL ================= -->
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

                        <!-- 🔥 IMPORTANT: HTML RENDERED HERE -->
                        <div id="view_content"></div>

                    </div>

                </div>

            </div>
        </div>



    <!-- CKEDITOR -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        let editorInstance;

        /* INIT CKEDITOR */
        ClassicEditor.create(document.querySelector('#editor'))
            .then(editor => {
                editorInstance = editor;
            });

        /* ================= ADD ================= */
        $('[data-bs-target="#notepadModal"]').on('click', function() {

            $('#notepadForm').attr('action', "{{ route('admin.notepad.store') }}");
            $('#method_field').val('POST');

            $('#file_name').val('');
            editorInstance.setData('');
        });

        /* ================= EDIT ================= */
        $(document).on('click', '.editBtn', function() {

            let id = $(this).data('id');
            let name = $(this).data('name');
            let desc = $(this).attr('data-desc');

            $('#file_name').val(name);

            $('#notepadForm').attr('action', "{{ url('admin/notepad') }}/" + id);
            $('#method_field').val('PUT');

            editorInstance.setData(desc);

            $('#notepadModal').modal('show');
        });

        /* ================= VIEW (FINAL FIX - HTML STRUCTURE PRESERVED) ================= */
        $(document).on('click', '.viewBtn', function() {

            let name = $(this).data('name');
            let desc = $(this).attr('data-desc');

            $('#view_title').text(name);

            // 🔥 RENDER FULL HTML STRUCTURE (PARAGRAPHS, BOLD, ETC)
            $('#view_content').html(desc);

            $('#viewNotepadModal').modal('show');
        });

        /* RESET */
        $('#notepadModal').on('hidden.bs.modal', function() {

            $('#file_name').val('');
            editorInstance.setData('');
            $('#method_field').val('POST');

        });
    </script>
@endsection
