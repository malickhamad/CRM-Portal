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
                    <div class="col-md-12 ">
                        <div class="card basic-data-table">

                            <div class="card-header">
                                <a href="#" class="btn btn-brand-1" data-bs-toggle="modal"
                                    data-bs-target="#addNotepadModal">
                                    + Add Notepad
                                </a>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table bordered-table mb-0 text-start table-hover table-sm">

                                        <thead class="table-light">
                                            <tr>
                                                <th class="col-10">File Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td class="text-muted py-3">Meeting Notes</td>
                                                <td class="text-nowrap">
                                                    <a href="#"
                                                        class="w-32-px h-32-px bg-success-focus text-success green_color-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="lucide:eye"></iconify-icon>
                                                    </a>
                                                    <a href="#"
                                                        class="w-32-px h-32-px bg-success-focus text-success green_color-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                                    </a>
                                                    <a href="#"
                                                        class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-muted py-3">Project Ideas</td>
                                                <td class="text-nowrap">
                                                    <a href="#"
                                                        class="w-32-px h-32-px bg-success-focus text-success green_color-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="lucide:eye"></iconify-icon>
                                                    </a>
                                                    <a href="#"
                                                        class="w-32-px h-32-px bg-success-focus text-success green_color-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                                    </a>
                                                    <a href="#"
                                                        class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-muted py-3">Daily Tasks</td>
                                                <td class="text-nowrap">
                                                    <a href="#"
                                                        class="w-32-px h-32-px bg-success-focus text-success green_color-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="lucide:eye"></iconify-icon>
                                                    </a>
                                                    <a href="#"
                                                        class="w-32-px h-32-px bg-success-focus text-success green_color-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                                    </a>
                                                    <a href="#"
                                                        class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-muted py-3">Laravel Learning Notes</td>
                                                <td class="text-nowrap">
                                                    <a href="#"
                                                        class="w-32-px h-32-px bg-success-focus text-success green_color-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="lucide:eye"></iconify-icon>
                                                    </a>
                                                    <a href="#"
                                                        class="w-32-px h-32-px bg-success-focus text-success green_color-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                                    </a>
                                                    <a href="#"
                                                        class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="text-muted py-3">Client Feedback</td>
                                                <td class="text-nowrap">
                                                    <a href="#"
                                                        class="w-32-px h-32-px bg-success-focus text-success green_color-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="lucide:eye"></iconify-icon>
                                                    </a>
                                                    <a href="#"
                                                        class="w-32-px h-32-px bg-success-focus text-success green_color-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                                    </a>
                                                    <a href="#"
                                                        class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- ================= MODAL ================= -->
                <div class="modal fade" id="addNotepadModal" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

                        <!-- FIXED MODAL HEIGHT -->
                        <div class="modal-content border-0 shadow" style="height: 90vh;">

                            <!-- HEADER -->
                            <div class="modal-header border-0 bg-light">
                                <h5 class="modal-title fw-semibold">
                                    <i class="bi bi-journal-text me-2 text-success"></i>
                                    Add Notepad
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <form method="POST" action="#" id="notepadForm" class="d-flex flex-column flex-grow-1">
                                @csrf

                                <!-- BODY (SCROLL ONLY HERE) -->
                                <div class="modal-body bg-white" style="overflow-y:auto; max-height: calc(90vh - 140px);">

                                    <!-- File Name -->
                                    <div class="mb-3">
                                        <input type="text" name="file_name" class="form-control"
                                            placeholder="Enter file name" required>
                                    </div>

                                    <!-- Editor -->
                                    <div class="d-flex align-items-stretch gap-2">

                                        <div
                                            class="d-flex align-items-center px-2 border rounded bg-light fw-semibold text-success">
                                            Editor
                                        </div>

                                        <div class="flex-grow-1">
                                            <textarea name="description" id="editor" class="form-control"></textarea>
                                        </div>

                                    </div>

                                </div>

                                <!-- FOOTER (ALWAYS VISIBLE) -->
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

            </div>
        </div>

        <!-- CKEDITOR -->
        <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

        <script>
            ClassicEditor
                .create(document.querySelector('#editor'))
                .then(editor => {

                    const editable = editor.ui.view.editable.element;

                    function setHeight() {

                        let height = 200;

                        if (window.innerWidth < 1200 && window.innerWidth >= 768) {
                            height = 150;
                        }

                        if (window.innerWidth < 768) {
                            height = 120;
                        }

                        editable.style.height = height + 'px';
                        editable.style.minHeight = height + 'px';
                        editable.style.maxHeight = height + 'px';
                        editable.style.overflowY = 'auto';

                        editor.editing.view.change(writer => {
                            writer.setStyle(
                                'height',
                                height + 'px',
                                editor.editing.view.document.getRoot()
                            );
                        });
                    }

                    setHeight();
                    window.addEventListener('resize', setHeight);

                })
                .catch(error => console.error(error));
        </script>


@endsection
