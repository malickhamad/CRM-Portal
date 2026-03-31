
@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">Questions</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success ">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">Add Question</li>
                </ul>
            </div>
<div class="row gy-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0 text-success-1000 ">Add Question</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.mcqs.store') }}" method="POST" class="row gy-3 needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6">
                        <label class="form-label">Section</label>
                        <div class="icon-field has-validation">
                            <span class="icon">
                            </span>
                            <select name="section_id"
                                class="form-select @error('section_id') is-invalid @enderror" required>
                                <option value="">--Select--</option>
                                @foreach ($sections as $section)
                                <option value="{{ $section->id }}"
                                    {{ old('section_id') == $section->id ? 'selected' : '' }}>
                                    {{ $section->name }}-({{ \Illuminate\Support\Str::limit($section->standard->name ?? 'No Standard', 20, '...') }})
                                </option>
                                @endforeach
                            </select>
                            @error('section_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Category</label>
                        <div class="icon-field has-validation">
                            <select name="category" class="form-control  form-control-sm @error('category') is-invalid @enderror">
                                <option value="">--Select--</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category') == $category->id ? 'selected' : '' }}>
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
                            <span class="icon">
                            </span>
                            <textarea name="question" class="form-control  form-control-sm @error('question') is-invalid @enderror" rows="3"
                                placeholder="Enter Question" required>{{ old('question') }}</textarea>
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
                                placeholder="Enter Reference" value="{{ old('reference') }}">
                            @error('reference')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <!-- Action Plan Field -->
                    <div class="col-md-6">
                        <label class="form-label">Action Plan</label>
                        <div class="icon-field has-validation">
                            <textarea name="action_plan" class="form-control  form-control-sm @error('action_plan') is-invalid @enderror" rows="3"
                                placeholder="Enter Action Plan">{{ old('action_plan') }}</textarea>
                            @error('action_plan')
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
                            <small class="text-muted">Max file size: 5MB (PDF, DOC, DOCX, JPG, PNG)</small>
                        </div>
                    </div>


                    <br>
                    <hr>
                    <br>

                    <!-- Options Start -->
                    <h6 class='fw-semibold text-success-1000'>Options</h6>
                    <br>

                    <div id="options-container">
                        @for ($i = 0; $i < 2; $i++)
                            <!-- Start with two options -->
                            <div class="row mb-3 align-items-center option-row">
                                <div class="col-md-4">
                                    <label class="form-label">{{ $i + 1 }}. Option</label>
                                    <input type="text" name="answers[]"
                                        class="form-control  form-control-sm @error('answers.' . $i) is-invalid @enderror"
                                        placeholder="Enter Option {{ $i + 1 }}"
                                        value="{{ old('answers.' . $i) }}" required>
                                    @error('answers.' . $i)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Risk Involve</label>
                                    <select name="risk[]"
                                        class="form-select @error('risk.' . $i) is-invalid @enderror">
                                        <option value="High"
                                            {{ old('risk.' . $i) == 'High' ? 'selected' : '' }}>High</option>
                                        <option value="Medium"
                                            {{ old('risk.' . $i) == 'Medium' ? 'selected' : '' }}>Medium
                                        </option>
                                        <option value="Low"
                                            {{ old('risk.' . $i) == 'Low' ? 'selected' : '' }}>Low</option>
                                        <option value="Flag"
                                            {{ old('risk.' . $i) == 'Flag' ? 'selected' : '' }}>Flag</option>
                                    </select>
                                    @error('risk.' . $i)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Education</label>
                                    <textarea name="education[]" class="form-control  form-control-sm @error('education.' . $i) is-invalid @enderror" rows="1"
                                        placeholder="Enter Education">{{ old('education.' . $i) }}</textarea>
                                    @error('education.' . $i)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2 ">
                                    <button type="button" class="btn btn-secondary remove-option" style="margin-top:35px">Remove</button>
                                </div>
                            </div>
                        @endfor
                    </div>

                    <div class="mb-3">
                        <button type="button" id="add-option" class="btn btn-success mt-3">+ Add Option</button>
                    </div>
                    <!-- Options End -->

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-brand-1 float-right" onclick="this.disabled = true; this.form.submit();">Submit</button>
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

                let optionCount = {{ $i ?? 2 }}; // Start with 2 options

                // Add new option row
                addOptionButton.addEventListener('click', function() {
                    optionCount++;

                    const newOptionRow = document.createElement('div');
                    newOptionRow.classList.add('row', 'mb-3', 'option-row');
                    newOptionRow.innerHTML = `
                        <div class="col-md-3">
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
                        <div class="col-md-3">
                            <button type="button" class="btn mt-3 btn-danger remove-option">Remove</button>
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
