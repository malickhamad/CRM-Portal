@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <!-- Page Title and Breadcrumb -->
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000">Add Customer</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">Payment Details</li>
                </ul>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-success-1000 ">Step 2: Standards | Payment Details</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.customers.process-payment', $user->id) }}">                        @csrf

                        <div class="row">
                        <div class="col-md-6 mb-4">
                                <label class="form-label">Subscription Plan <span class="text-danger">*</span></label>
                                <select name="plan_id" class="form-select" required>
                                    <option value="">Select a plan</option>
                                    @foreach ($plans as $plan)
                                        <option value="{{ $plan->id }}">
                                            {{ $plan->name }} - ${{ $plan->price }} ({{ ucfirst($plan->billing_cycle) }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- <div class="col-md-6 mb-4">
                                <label class="form-label">Amount <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" name="amount" class="form-control  form-control-sm" required>
                            </div> --}}

                            <div class="col-md-12 mb-4">
                                <label class="form-label">Payment Method <span class="text-danger">*</span></label>
                                <div class="d-flex gap-4">
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input" type="radio" name="payment_method" id="online"
                                            value="online" checked>
                                        <label class="form-check-label ms-2" for="online">
                                            Online Transaction
                                        </label>
                                    </div>
                                    <div class="form-check d-flex align-items-center">
                                        <input class="form-check-input" type="radio" name="payment_method" id="cheque"
                                            value="cheque">
                                        <label class="form-check-label ms-2" for="cheque">
                                            Cheque
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3" id="onlineFields">
                                <label class="form-label">Transaction Reference <span class="text-danger">*</span></label>
                                <input type="text" name="transaction_reference" class="form-control  form-control-sm">
                            </div>

                            <div class="col-md-6 mb-3 d-none" id="chequeFields">
                                <label class="form-label">Cheque Number <span class="text-danger">*</span></label>
                                <input type="text" name="cheque_number" class="form-control  form-control-sm">
                            </div>
                            <hr>
                            <div class="col-md-12 mb-4">
                                <label class="form-label">Standards <span class="text-danger">*</span></label>
                                @foreach ($standards as $standard)
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="standard_{{ $standard->id }}" name="standards[]"
                                                    value="{{ $standard->id }}">
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
                            <a href="{{ route('admin.customers.create') }}" class="btn btn-secondary d-inline-flex align-items-center">
                                <iconify-icon icon="solar:arrow-left-outline" class="icon me-1"></iconify-icon> Back
                            </a>
                            <button type="submit" class="btn btn-brand-1 d-inline-flex align-items-center" >
                                Save <iconify-icon icon="solar:check-circle-outline"
                                    class="icon ms-1"></iconify-icon>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endsection
        </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

            // Initialize on page load
            toggleFields();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

            updateMaxAllowed();
            enforceLimit();
        });
    </script>

