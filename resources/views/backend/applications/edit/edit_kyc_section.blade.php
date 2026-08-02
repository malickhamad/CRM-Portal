<div class="card shadow-sm border-0 mt-4">
    <div class="card-body">

        <div class="section-title"><span>KYC Verification</span></div>

        <div class="row g-4">

            {{-- Meter Pictures --}}
@if(isset($application) && in_array(strtolower($application->service_type), [
    'gas',
    'electricity',
    'electric gas'
]))

<div class="col-md-6">

    <label class="fw-semibold mb-2">
        <i class="bi bi-speedometer me-1 text-success"></i>
        Meter Pictures
    </label>


    <div class="kyc-upload-box" onclick="document.getElementById('meterPictures').click();">

        <p class="text-muted mb-0" id="meterPicturesText">
            Drop files here to upload
        </p>

        <input type="file"
            id="meterPictures"
            name="meter_pictures[]"
            multiple
            hidden
            onchange="showFiles(this,'meterPicturesPreview','meterPicturesText')">

    </div>


    {{-- New Selected Files --}}
    <div id="meterPicturesPreview" class="mt-2"></div>


    {{-- Existing Files --}}
    @if ($application->meter_pictures)

        <div class="mt-3 small">

            <div class="fw-semibold mb-2">
                Existing Files:
            </div>


            @foreach (explode(',', $application->meter_pictures) as $file)

                @php
                    $file = trim($file);
                    $name = basename($file);
                @endphp


                @if ($file)

                <div class="existing-file-item d-flex justify-content-between align-items-center border rounded px-2 py-2 mb-2">


                    <a href="{{ asset('storage/' . $file) }}"
                        target="_blank"
                        class="text-decoration-none text-dark text-truncate"
                        style="max-width:75%;">

                        <i class="bi bi-file-earmark text-primary me-1"></i>

                        {{ strlen($name) > 25 ? substr($name,0,22).'...' : $name }}

                    </a>


                    <button type="button"
                        class="btn btn-sm btn-outline-danger delete-existing-file"
                        data-column="meter_pictures"
                        data-file="{{ $file }}">

                        <i class="bi bi-trash"></i>

                    </button>


                </div>

                @endif

            @endforeach

        </div>

    @endif


</div>

@endif


            <!-- Picture ID -->
            <div class="col-md-6">
                <label class="fw-semibold mb-2">
                    <i class="bi bi-person-badge me-1 text-primary"></i> Picture ID
                </label>

                <div class="kyc-upload-box" onclick="document.getElementById('pictureId').click();">
                    <p class="text-muted mb-0" id="pictureIdText">Drop files here to upload</p>

                    <input type="file" id="pictureId" name="picture_id[]" multiple hidden
                        onchange="showFiles(this,'pictureIdPreview','pictureIdText')">
                </div>

                <!-- New Selected Files -->
                <div id="pictureIdPreview" class="mt-2"></div>

                <!-- Existing Files -->
                @if ($application->picture_id)
                    <div class="mt-3 small">

                        <div class="fw-semibold mb-2">
                            Existing Files:
                        </div>

                        @foreach (explode(',', $application->picture_id) as $file)
                            @php
                                $file = trim($file);
                                $name = basename($file);
                            @endphp

                            @if ($file)
                                <div
                                    class="existing-file-item d-flex justify-content-between align-items-center border rounded px-2 py-2 mb-2">

                                    <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                        class="text-decoration-none text-dark text-truncate" style="max-width:75%;">

                                        <i class="bi bi-file-earmark text-primary me-1"></i>

                                        {{ strlen($name) > 25 ? substr($name, 0, 22) . '...' : $name }}

                                    </a>

                                    <button type="button" class="btn btn-sm btn-outline-danger delete-existing-file"
                                        data-column="picture_id" data-file="{{ $file }}">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </div>
                            @endif
                        @endforeach

                    </div>
                @endif

            </div>



            <!-- Inside Outside Pics -->
            <div class="col-md-6">

                <label class="fw-semibold mb-2">
                    <i class="bi bi-building me-1 text-success"></i>
                    Inside/Outside Pics
                </label>

                <div class="kyc-upload-box" onclick="document.getElementById('insidePics').click();">

                    <p class="text-muted mb-0" id="insidePicsText">
                        Drop files here to upload
                    </p>

                    <input type="file" id="insidePics" name="inside_outside_pics[]" multiple hidden
                        onchange="showFiles(this,'insidePicsPreview','insidePicsText')">

                </div>

                <!-- New Selected Files -->
                <div id="insidePicsPreview" class="mt-2"></div>

                <!-- Existing Files -->
                @if ($application->inside_outside_pics)
                    <div class="mt-3 small">

                        <div class="fw-semibold mb-2">
                            Existing Files:
                        </div>

                        @foreach (explode(',', $application->inside_outside_pics) as $file)
                            @php
                                $file = trim($file);
                                $name = basename($file);
                            @endphp

                            @if ($file)
                                <div
                                    class="existing-file-item d-flex justify-content-between align-items-center border rounded px-2 py-2 mb-2">

                                    <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                        class="text-decoration-none text-dark text-truncate" style="max-width:75%;">

                                        <i class="bi bi-file-earmark text-primary me-1"></i>

                                        {{ strlen($name) > 25 ? substr($name, 0, 22) . '...' : $name }}

                                    </a>

                                    <button type="button" class="btn btn-sm btn-outline-danger delete-existing-file"
                                        data-column="inside_outside_pics" data-file="{{ $file }}">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </div>
                            @endif
                        @endforeach

                    </div>
                @endif

            </div>



            <!-- Bill -->
            <div class="col-md-6">

                <label class="fw-semibold mb-2">
                    <i class="bi bi-receipt me-1 text-warning"></i> Bill
                </label>

                <div class="kyc-upload-box" onclick="document.getElementById('billUpload').click();">

                    <p class="text-muted mb-0" id="billUploadText">
                        Drop files here to upload
                    </p>

                    <input type="file" id="billUpload" name="bill_upload[]" multiple hidden
                        onchange="showFiles(this,'billUploadPreview','billUploadText')">

                </div>

                <!-- Newly Selected Files -->
                <div id="billUploadPreview" class="mt-2"></div>

                <!-- Existing Files -->
                @if ($application->bill_upload)
                    <div class="mt-3 small">

                        <div class="fw-semibold mb-2">
                            Existing Files:
                        </div>

                        @foreach (explode(',', $application->bill_upload) as $file)
                            @php
                                $file = trim($file);
                                $name = basename($file);
                            @endphp

                            @if ($file)
                                <div
                                    class="existing-file-item d-flex justify-content-between align-items-center border rounded px-2 py-2 mb-2">

                                    <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                        class="text-decoration-none text-dark text-truncate" style="max-width:75%;">

                                        <i class="bi bi-file-earmark text-primary me-1"></i>

                                        {{ strlen($name) > 25 ? substr($name, 0, 22) . '...' : $name }}

                                    </a>

                                    <button type="button" class="btn btn-sm btn-outline-danger delete-existing-file"
                                        data-column="bill_upload" data-file="{{ $file }}">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </div>
                            @endif
                        @endforeach

                    </div>
                @endif

            </div>



            <!-- Bank Statement -->
            <div class="col-md-6">

                <label class="fw-semibold mb-2">
                    <i class="bi bi-bank me-1 text-info"></i> Bank Statement
                </label>

                <div class="kyc-upload-box" onclick="document.getElementById('bankStatement').click();">

                    <p class="text-muted mb-0" id="bankStatementText">
                        Drop files here to upload
                    </p>

                    <input type="file" id="bankStatement" name="bank_statement[]" multiple hidden
                        onchange="showFiles(this,'bankStatementPreview','bankStatementText')">

                </div>

                <!-- Newly Selected Files -->
                <div id="bankStatementPreview" class="mt-2"></div>

                <!-- Existing Files -->
                @if ($application->bank_statement)
                    <div class="mt-3 small">

                        <div class="fw-semibold mb-2">
                            Existing Files:
                        </div>

                        @foreach (explode(',', $application->bank_statement) as $file)
                            @php
                                $file = trim($file);
                                $name = basename($file);
                            @endphp

                            @if ($file)
                                <div
                                    class="existing-file-item d-flex justify-content-between align-items-center border rounded px-2 py-2 mb-2">

                                    <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                        class="text-decoration-none text-dark text-truncate" style="max-width:75%;">

                                        <i class="bi bi-file-earmark text-primary me-1"></i>

                                        {{ strlen($name) > 25 ? substr($name, 0, 22) . '...' : $name }}

                                    </a>

                                    <button type="button" class="btn btn-sm btn-outline-danger delete-existing-file"
                                        data-column="bank_statement" data-file="{{ $file }}">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </div>
                            @endif
                        @endforeach

                    </div>
                @endif

            </div>


            <!-- Additional Uploads -->
            <div class="col-md-6">

                <label class="fw-semibold mb-2">
                    <i class="bi bi-upload me-1 text-info"></i>
                    Additional Uploads
                </label>

                <div class="kyc-upload-box" onclick="document.getElementById('additionalUploads').click();">

                    <p class="text-muted mb-0" id="additionalUploadsText">
                        Drop files here to upload
                    </p>

                    <input type="file" id="additionalUploads" name="additional_uploads[]" multiple hidden
                        onchange="showFiles(this,'additionalUploadsPreview','additionalUploadsText')">

                </div>

                <!-- New Files -->
                <div id="additionalUploadsPreview" class="mt-2"></div>

                <!-- Existing Files -->

                @if ($application->additional_uploads)
                    <div class="mt-3 small">

                        <div class="fw-semibold mb-2">
                            Existing Files:
                        </div>

                        @foreach (explode(',', $application->additional_uploads) as $file)
                            @php
                                $file = trim($file);
                                $name = basename($file);
                            @endphp

                            @if ($file)
                                <div
                                    class="existing-file-item d-flex justify-content-between align-items-center border rounded px-2 py-2 mb-2">

                                    <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                        class="text-decoration-none text-dark text-truncate" style="max-width:75%">

                                        <i class="bi bi-file-earmark text-primary me-1"></i>

                                        {{ strlen($name) > 25 ? substr($name, 0, 22) . '...' : $name }}

                                    </a>

                                    <button type="button" class="btn btn-sm btn-outline-danger delete-existing-file"
                                        data-column="additional_uploads" data-file="{{ $file }}">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </div>
                            @endif
                        @endforeach

                    </div>
                @endif

            </div>


        </div>
    </div>
</div>



            <script>
                document.addEventListener("click", function(e) {

                    let btn = e.target.closest(".delete-existing-file");

                    if (!btn) return;

                    if (!confirm("Delete this file?")) return;


                    fetch("{{ route('admin.applications.delete.file', $application->id) }}", {

                            method: "DELETE",

                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Accept": "application/json",
                                "Content-Type": "application/json"
                            },

                            body: JSON.stringify({

                                column: btn.dataset.column,

                                file: btn.dataset.file

                            })

                        })

                        .then(res => res.json())

                        .then(function(res) {

                            if (res.success) {

                                btn.closest(".existing-file-item").remove();

                            } else {

                                alert("Unable to delete file.");

                            }

                        })

                        .catch(function() {

                            alert("Something went wrong.");

                        });

                });



                let fileStore = {};

                function showFiles(input, previewId, textId) {

                    const inputId = input.id;

                    if (!fileStore[inputId]) {
                        fileStore[inputId] = [];
                    }

                    Array.from(input.files).forEach(file => {

                        fileStore[inputId].push(file);

                    });

                    renderFiles(inputId, previewId, textId);
                }

                function renderFiles(inputId, previewId, textId) {

                    const preview = document.getElementById(previewId);

                    const text = document.getElementById(textId);

                    preview.innerHTML = "";

                    if (!fileStore[inputId] || fileStore[inputId].length === 0) {

                        text.innerHTML = "Drop files here to upload";

                        return;
                    }

                    text.innerHTML = fileStore[inputId].length + " file(s) selected";

                    let dataTransfer = new DataTransfer();

                    fileStore[inputId].forEach(function(file, index) {

                        dataTransfer.items.add(file);

                        let row = document.createElement("div");

                        row.className = "d-flex justify-content-between align-items-center border rounded px-2 py-2 mb-2";

                        let fileName = file.name.length > 25 ?
                            file.name.substring(0, 22) + "..." :
                            file.name;

                        row.innerHTML = `
                                        <span class="text-truncate" style="max-width:75%">
                                        <i class="bi bi-file-earmark text-success me-1"></i>
                                        ${fileName}
                                    </span>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="removeFile('${inputId}',${index},'${previewId}','${textId}')">

                                        <i class="bi bi-x-lg"></i>

                                    </button>
                                `;

                        preview.appendChild(row);

                    });

                    document.getElementById(inputId).files = dataTransfer.files;

                }

                function removeFile(inputId, index, previewId, textId) {

                    fileStore[inputId].splice(index, 1);

                    let dataTransfer = new DataTransfer();

                    fileStore[inputId].forEach(file => {

                        dataTransfer.items.add(file);

                    });

                    document.getElementById(inputId).files = dataTransfer.files;

                    renderFiles(inputId, previewId, textId);

                }
            </script>
