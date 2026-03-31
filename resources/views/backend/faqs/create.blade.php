@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">FAQS Create</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">FAQS</li>
                </ul>
            </div>
            <x-sweet-alert :type="session('sweetalert.type')" :message="session('sweetalert.message')" :title="session('sweetalert.title')" />
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.faqs.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-lg-8">
                                            <div class="form-group mb-3">
                                                <label for="question" class="form-label ">Question</label>
                              ,                  <input type="text" name="question"
                                                    class="form-control  form-control-sm @error('question') is-invalid @enderror" id="question"
                                                    value="{{ old('question') }}" placeholder="Enter question"
                                                    required />
                                                @error('question')
                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="answer" class="form-label">Answer</label>
                                                <textarea name="answer" class="form-control  form-control-sm @error('answer') is-invalid @enderror" id="editor"
                                                    placeholder="Enter Answer" required>{{ old('answer') }}</textarea>
                                                @error('answer')
                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>


                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-brand-1 float-right">Submit</button>
                                        <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endsection

    @push('custom-js')
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>

    <script>
      CKEDITOR.replace("editor", {
    height: 300,
    removePlugins: "elementspath",
    toolbar: [
        { name: "document", items: ["Source", "-", "Preview", "Print"] },
        { name: "clipboard", items: ["Undo", "Redo"] },
        { name: "editing", items: ["Find", "Replace"] },
        { name: "basicstyles", items: ["Bold", "Italic", "Underline", "Strike"] },
        { name: "paragraph", items: ["NumberedList", "BulletedList", "-", "Outdent", "Indent", "-", "Blockquote"] },
        { name: "insert", items: ["Image", "Table", "HorizontalRule", "SpecialChar"] },
        { name: "styles", items: ["Styles", "Format", "Font", "FontSize"] },
        { name: "colors", items: ["TextColor", "BGColor"] }
    ],
    filebrowserUploadUrl: "/ckeditor/upload",
    filebrowserUploadMethod: "form"
});

    </script>
    @endpush

