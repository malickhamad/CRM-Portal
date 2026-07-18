@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000 ">My Subscription</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('user.dashboard') }}" class="d-flex align-items-center gap-1 hover-text-success text-success-1000">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">My Subscription</li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-success-1000 ">Subscription Plan</h4>

                        </div>
                        <div class="card-body">
                            @if ($currentPayment)
                                <div class="alert alert-info mb-4">
                                    <p>
                                        <strong>Current Plan:</strong>
                                        {{ optional($currentPayment->subscriptionPlan)->name ?? 'N/A' }} -
                                        ${{ optional($currentPayment->subscriptionPlan)->price ?? '0.00' }}
                                        @if ($currentPayment->subscriptionPlan)
                                            ({{ ucfirst($currentPayment->subscriptionPlan->billing_cycle) }})
                                        @endif
                                    </p>
                                    <p>
                                        <strong>Status:</strong>
                                        {{ $currentPayment->is_active ? 'Active' : 'Inactive' }}
                                        @if ($currentPayment->is_active && $currentPayment->ends_at)
                                            (Expires on:
                                            {{ \Carbon\Carbon::parse($currentPayment->ends_at)->format('M d, Y') }})
                                        @endif
                                    </p>
                                </div>
                            @endif

                            <form method="POST" class='mt-3'>
                                @csrf
                                <div class="mb-3">
                                    <label for="plan_id" class="form-label">Select Plan</label>
                                    <select name="plan_id" class="form-select" required>
                                        <option value="">Select a plan</option>
                                        @foreach ($plans as $plan)
                                            <option value="{{ $plan->id }}">
                                                {{ $plan->name }} - ${{ $plan->price }}
                                                ({{ ucfirst($plan->billing_cycle) }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Select Standards</label><br>
                                    @foreach ($standards as $standard)
                                        <div class="form-check d-flex align-items-center">
                                            <input class="form-check-input me-2" type="checkbox" name="standards[]"
                                                value="{{ $standard->id }}" id="standard{{ $standard->id }}"
                                                {{ in_array($standard->id, $selectedStandards ?? []) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="standard{{ $standard->id }}">
                                                {{ $standard->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>


                                <div class="d-flex justify-content-end mt-4 mx-2 gap-2">

                                    <a href="{{ route('user.profile') }}"
                                    class="btn btn-secondary d-inline-flex align-items-center">
                                    <span>Back to Profile</span>
                                </a>
                                <button type="button" id="updateSubscriptionBtn"
                                        class="btn btn-brand-1 d-inline-flex align-items-center">
                                        <span>Update Subscription</span>
                                        <iconify-icon icon="solar:check-circle-outline" class="icon ms-1"></iconify-icon>
                                    </button>


                                </div>

                            </form>

                            <!-- Scripts -->
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const planSelect = document.querySelector('select[name="plan_id"]');
                                    const checkboxes = document.querySelectorAll('input[name="standards[]"]');
                                    const updateButton = document.getElementById('updateSubscriptionBtn');

                                    let maxAllowed = {{ $selectedPlan ? $selectedPlan->no_of_standards : 0 }};

                                    function updateMaxAllowed() {
                                        const selectedPlan = planSelect.value;
                                        @foreach ($plans as $plan)
                                            if (selectedPlan == '{{ $plan->id }}') {
                                                maxAllowed = {{ $plan->no_of_standards }};
                                            }
                                        @endforeach
                                    }

                                    function enforceLimit() {
                                        let checkedCount = document.querySelectorAll('input[name="standards[]"]:checked').length;
                                        checkboxes.forEach(box => {
                                            if (checkedCount >= maxAllowed && !box.checked) {
                                                box.disabled = true;
                                            } else {
                                                box.disabled = false;
                                            }
                                        });
                                    }

                                    checkboxes.forEach(box => {
                                        box.addEventListener('change', enforceLimit);
                                    });

                                    planSelect.addEventListener('change', function() {
                                        updateMaxAllowed();

                                        // Uncheck all standards checkboxes when plan changes
                                        checkboxes.forEach(box => {
                                            box.checked = false;
                                        });

                                        enforceLimit();
                                    });

                                    enforceLimit();

                                    updateButton.addEventListener('click', function() {
                                        const selectedPlanId = planSelect.value;

                                        if (!selectedPlanId) {
                                            alert('Please select a plan first!');
                                            return;
                                        }

                                        // Collect selected standards
                                        const selectedStandards = Array.from(document.querySelectorAll('input[name="standards[]"]:checked'))
                                            .map(input => input.value);

                                        // Send POST request to backend with selected standards
                                        const form = document.createElement('form');
                                        form.method = 'POST';
                                        form.action = "{{ url('/checkout') }}/" + selectedPlanId;
                                        form.style.display = 'none';

                                        // Add CSRF token
                                        const csrfInput = document.createElement('input');
                                        csrfInput.type = 'hidden';
                                        csrfInput.name = '_token';
                                        csrfInput.value = "{{ csrf_token() }}";
                                        form.appendChild(csrfInput);

                                        // Add selected standards
                                        selectedStandards.forEach(function(standardId) {
                                            const input = document.createElement('input');
                                            input.type = 'hidden';
                                            input.name = 'standards[]';
                                            input.value = standardId;
                                            form.appendChild(input);
                                        });

                                        document.body.appendChild(form);
                                        form.submit();
                                    });
                                });
                            </script>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection


