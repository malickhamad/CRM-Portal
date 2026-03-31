@extends('backend.layouts.app')

@section('content')
<main class="dashboard-main">
    @include('backend.layouts.partials.header')

    <div class="dashboard-main-body">
        <!-- Page Title and Breadcrumb -->
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
            <h6 class="fw-semibold mb-0 text-success-1000">Edit Customer</h6>
            <ul class="d-flex align-items-center gap-2">
                <li class="fw-medium">
                    <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success">
                        <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                        Dashboard
                    </a>
                </li>
                <li>-</li>
                <li class="fw-medium text-success-1000 text-md">Edit Customer: Step 2</li>
            </ul>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title text-success-1000 ">Step 2: Payment Details</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.customers.update.step2', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Subscription Plan -->
                        <div class="col-md-6 mb-4">
                            <label class="form-label">Subscription Plan <span class="text-danger">*</span></label>
                            <select name="plan_id" class="form-select @error('plan_id') is-invalid @enderror" required>
                                <option value="">Select a plan</option>
                                @foreach ($plans as $plan)
                                    <option value="{{ $plan->id }}"
                                        {{ old('plan_id', $currentPayment->subscribtion_plan_id ?? '') == $plan->id ? 'selected' : '' }}>
                                        {{ $plan->name }} - ${{ $plan->price }} ({{ ucfirst($plan->billing_cycle) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('plan_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Payment Method -->
                        <div class="col-md-12 mb-4">
                            <label class="form-label">Payment Method <span class="text-danger">*</span></label>
                            <div class="d-flex gap-4">
                                <div class="form-check d-flex align-items-center">
                                    <input class="form-check-input @error('payment_method') is-invalid @enderror"
                                        type="radio" name="payment_method" id="online"
                                        value="online"
                                        {{ old('payment_method', $currentPayment->payment_method ?? 'online') == 'online' ? 'checked' : '' }}>
                                    <label class="form-check-label ms-2" for="online">
                                        Online Transaction
                                    </label>
                                </div>
                                <div class="form-check d-flex align-items-center">
                                    <input class="form-check-input @error('payment_method') is-invalid @enderror"
                                        type="radio" name="payment_method" id="cheque"
                                        value="cheque"
                                        {{ old('payment_method', $currentPayment->payment_method ?? '') == 'cheque' ? 'checked' : '' }}>
                                    <label class="form-check-label ms-2" for="cheque">
                                        Cheque
                                    </label>
                                </div>
                            </div>
                            @error('payment_method')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Transaction Reference (Online) -->
                        <div class="col-md-6 mb-3 @if(old('payment_method', $currentPayment->payment_method ?? 'online') != 'online') d-none @endif" id="onlineFields">
                            <label class="form-label">Transaction Reference <span class="text-danger">*</span></label>
                            <input type="text" name="transaction_reference"
                                class="form-control  form-control-sm @error('transaction_reference') is-invalid @enderror"
                                value="{{ old('transaction_reference', $currentPayment->transaction_reference ?? '') }}"
                                @if(old('payment_method', $currentPayment->payment_method ?? 'online') == 'online') required @endif>
                            @error('transaction_reference')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Cheque Number (Cheque) -->
                        <div class="col-md-6 mb-3 @if(old('payment_method', $currentPayment->payment_method ?? '') != 'cheque') d-none @endif" id="chequeFields">
                            <label class="form-label">Cheque Number <span class="text-danger">*</span></label>
                            <input type="text" name="cheque_number"
                                class="form-control  form-control-sm @error('cheque_number') is-invalid @enderror"
                                value="{{ old('cheque_number', $currentPayment->cheque_number ?? '') }}"
                                @if(old('payment_method', $currentPayment->payment_method ?? '') == 'cheque') required @endif>
                            @error('cheque_number')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Standards -->
                        <div class="col-md-12 mb-4">
                            <label class="form-label">Standards <span class="text-danger">*</span></label>
                            @error('standards')
                                <div class="invalid-feedback d-block mb-2">{{ $message }}</div>
                            @enderror

                            @foreach ($standards as $standard)
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input @error('standards') is-invalid @enderror"
                                                type="checkbox"
                                                id="standard_{{ $standard->id }}"
                                                name="standards[]"
                                                value="{{ $standard->id }}"
                                                {{ in_array($standard->id, old('standards', $selectedStandards)) ? 'checked' : '' }}>
                                            <label class="form-check-label ms-3" for="standard_{{ $standard->id }}">
                                                {{ $standard->name }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4 gap-2">
                        <a href="{{ route('admin.customers.edit.step1', $user->id) }}"
                            class="btn btn-secondary d-inline-flex align-items-center">
                            <iconify-icon icon="solar:arrow-left-outline" class="icon me-1"></iconify-icon> Back
                        </a>
                        <button type="submit" class="btn btn-brand-1 d-inline-flex align-items-center">
                            Update <iconify-icon icon="solar:check-circle-outline" class="icon ms-1"></iconify-icon>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
</main>

@push('custom-js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Payment method toggle
        const onlineRadio = document.getElementById('online');
        const chequeRadio = document.getElementById('cheque');
        const onlineFields = document.getElementById('onlineFields');
        const chequeFields = document.getElementById('chequeFields');

        function toggleFields() {
            if (onlineRadio.checked) {
                onlineFields.classList.remove('d-none');
                chequeFields.classList.add('d-none');
                document.querySelector('[name="transaction_reference"]').required = true;
                document.querySelector('[name="cheque_number"]').required = false;
            } else {
                onlineFields.classList.add('d-none');
                chequeFields.classList.remove('d-none');
                document.querySelector('[name="transaction_reference"]').required = false;
                document.querySelector('[name="cheque_number"]').required = true;
            }
        }

        onlineRadio.addEventListener('change', toggleFields);
        chequeRadio.addEventListener('change', toggleFields);

        // Standards limit enforcement
        const planSelect = document.querySelector('select[name="plan_id"]');
        const checkboxes = document.querySelectorAll('input[name="standards[]"]');

        let plans = @json($plans);
        let maxAllowed = 0;

        function updateMaxAllowed() {
            const selectedPlanId = planSelect.value;
            const selectedPlan = plans.find(p => p.id == selectedPlanId);
            maxAllowed = selectedPlan ? selectedPlan.no_of_standards : 0;
        }

        function enforceLimit() {
            let checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length;
            checkboxes.forEach(box => {
                if (checkedCount >= maxAllowed && !box.checked) {
                    box.disabled = true;
                } else {
                    box.disabled = false;
                }
            });
        }

        planSelect.addEventListener('change', function() {
            updateMaxAllowed();
            checkboxes.forEach(cb => cb.checked = false);
            enforceLimit();
        });

        checkboxes.forEach(box => {
            box.addEventListener('change', enforceLimit);
        });

        // Initialize
        toggleFields();
        updateMaxAllowed();
        enforceLimit();
    });
</script>
@endpush
