@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">MCQs Edit</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('admin.dashboard') }}"
                            class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success ">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">Questions</li>
                </ul>
            </div>

            <div class="row gy-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0 text-success-1000 ">Edit Question</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.mcqs.update', $mcq->id) }}" method="POST"
                                class="row gy-3 needs-validation" novalidate enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="col-md-6">
                                    <label class="form-label">Section</label>
                                    <div class="icon-field has-validation">
                                        <span class="icon"></span>
                                        <select name="section_id"
                                            class="form-select @error('section_id') is-invalid @enderror" required>
                                            <option value="">--Select--</option>
                                            @foreach ($sections as $section)
                                                <option value="{{ $section->id }}"
                                                    {{ old('section_id', $mcq->section_id) == $section->id ? 'selected' : '' }}>
                                                    {{ $section->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('section_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Compliance Category (optional)</label>
                                    <div class="icon-field has-validation">
                                        <select name="category"
                                            class="form-control  form-control-sm @error('category') is-invalid @enderror">
                                            <option value="">--Select--</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category', $mcq->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Question</label>
                                    <div class="icon-field has-validation">
                                        <span class="icon"></span>
                                        <textarea name="question" class="form-control  form-control-sm @error('question') is-invalid @enderror" rows="3"
                                            placeholder="Enter Question" required>{{ old('question', $mcq->question) }}</textarea>
                                        @error('question')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Reference</label>
                                    <div class="icon-field has-validation">
                                        <span class="icon"></span>
                                        <input type="text" name="reference"
                                            class="form-control  form-control-sm @error('reference') is-invalid @enderror"
                                            placeholder="Enter Reference" value="{{ old('reference', $mcq->reference) }}">
                                        @error('reference')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Attachment Field -->
                                <div class="col-md-6">
                                    <label class="form-label">Attachment (Optional)</label>
                                    <div class="icon-field has-validation">
                                        <input type="file" name="attachment"
                                            class="form-control form-control-sm @error('attachment') is-invalid @enderror">
                                        @error('attachment')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if ($mcq->attachment_path)
                                            <div class="mt-2">
                                                <small>Current file:
                                                    <a href="{{ asset('storage/' . $mcq->attachment_path) }}"
                                                        target="_blank">
                                                        View Attachment
                                                    </a>
                                                </small>
                                                <br>
                                                <label class="mt-1">
                                                    <input type="checkbox" name="remove_attachment" value="1">
                                                    Remove current attachment
                                                </label>
                                            </div>
                                        @else
                                            <small class="text-muted">No attachment uploaded</small>
                                        @endif
                                        <small class="text-muted d-block">Max file size: 5MB (PDF, DOC, DOCX, JPG,
                                            PNG)</small>
                                    </div>
                                </div>

                                <!-- Action Plan Field -->
                                <div class="col-md-6">
                                    <label class="form-label">Action Plan</label>
                                    <div class="icon-field has-validation">
                                        <textarea name="action_plan" class="form-control  form-control-sm @error('action_plan') is-invalid @enderror"
                                            rows="3" placeholder="Enter Action Plan">{{ old('action_plan', $mcq->action_plan) }}</textarea>
                                        @error('action_plan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <br>
                                <hr>
                                <br>

                                <!-- Options Start -->
                                <h6 class='fw-semibold text-success-1000'>Options</h6>
                                <br>

                                <div id="options-container">
                                    @foreach ($mcq->answers as $i => $answer)
                                        <div class="row mb-3 align-items-center option-row">
                                            <div class="col-md-3">
                                                <label class="form-label">{{ $i + 1 }}. Option</label>
                                                <input type="text" name="answers[]"
                                                    class="form-control  form-control-sm @error('answers.' . $i) is-invalid @enderror"
                                                    placeholder="Enter Option {{ $i + 1 }}"
                                                    value="{{ old('answers.' . $i, $answer->answer) }}" required>
                                                @error('answers.' . $i)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label">Risk Involve</label>
                                                <select name="risk[]"
                                                    class="form-select @error('risk.' . $i) is-invalid @enderror">
                                                    <option value="High"
                                                        {{ old('risk.' . $i, $answer->risk) == 'High' ? 'selected' : '' }}>
                                                        High</option>
                                                    <option value="Medium"
                                                        {{ old('risk.' . $i, $answer->risk) == 'Medium' ? 'selected' : '' }}>
                                                        Medium</option>
                                                    <option value="Low"
                                                        {{ old('risk.' . $i, $answer->risk) == 'Low' ? 'selected' : '' }}>
                                                        Low</option>
                                                    <option value="Flag"
                                                        {{ old('risk.' . $i, $answer->risk) == 'Flag' ? 'selected' : '' }}>
                                                        Flag</option>
                                                </select>
                                                @error('risk.' . $i)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Education</label>
                                                <textarea name="education[]" class="form-control  form-control-sm @error('education.' . $i) is-invalid @enderror"
                                                    rows="1" placeholder="Enter Education">{{ old('education.' . $i, $answer->education) }}</textarea>
                                                @error('education.' . $i)
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-2 text-start">
                                                <button type="button" class="btn btn-danger remove-option"
                                                    style="margin-top:35px">Remove</button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mb-3">
                                    <button type="button" id="add-option" class="btn btn-success mt-3">+ Add
                                        Option</button>
                                </div>
                                <!-- Options End -->

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-brand-1 float-right">Update</button>
                                    <a href="{{ route('admin.mcqs.index') }}" class="btn btn-secondary me-2">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const optionsContainer = document.getElementById('options-container');
                const addOptionButton = document.getElementById('add-option');

                let optionCount = {{ count($mcq->answers) }};

                // Add new option row
                addOptionButton.addEventListener('click', function() {
                    optionCount++;

                    const newOptionRow = document.createElement('div');
                    newOptionRow.classList.add('row', 'mb-3', 'option-row');
                    newOptionRow.innerHTML = `
                        <div class="col-md-2">
                            <label class="form-label">${optionCount}. Option</label>
                            <input type="text" name="answers[]"
                                class="form-control  form-control-sm"
                                placeholder="Enter Option ${optionCount}" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Risk Involve</label>
                            <select name="risk[]" class="form-select">
                                <option value="High">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>
                                <option value="Flag">Flag</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Action Plan</label>
                            <textarea name="action_plan[]" class="form-control  form-control-sm" rows="1" placeholder="Enter Action Plan"></textarea>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Education</label>
                            <textarea name="education[]" class="form-control  form-control-sm" rows="1" placeholder="Enter Education"></textarea>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-option" style="margin-top:35px">Remove</button>
                        </div>
                    `;

                    optionsContainer.appendChild(newOptionRow);
                });

                // Remove option row
                optionsContainer.addEventListener('click', function(e) {
                    if (e.target.classList.contains('remove-option')) {
                        const optionRow = e.target.closest('.option-row');
                        optionRow.remove();

                        // Reorder option labels after removal
                        const optionRows = optionsContainer.querySelectorAll('.option-row');
                        optionCount = 0;
                        optionRows.forEach((row, index) => {
                            row.querySelector('.form-label').textContent = `${index + 1}. Option`;
                            optionCount++;
                        });
                    }
                });
            });
        </script>
    @endsection
