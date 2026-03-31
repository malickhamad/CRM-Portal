@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0 text-success-1000 ">Add Plans</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success ">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium text-success-1000 text-md">Add Plan</li>
                </ul>
            </div>

            <x-sweet-alert :type="session('sweetalert.type')" :message="session('sweetalert.message')" :title="session('sweetalert.title')" />

            <form action="{{ route('admin.subscription-plans.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-4">
                                    <!-- First Row -->
                                    <div class="col-md-6">
                                        <!-- Name Field -->
                                        <div class="form-group mb-3"> 
                                            <label for="name" class=" form-label text-success-1000 text-md">Name</label>
                                            <input type="text" name="name" id="name"
                                                class="form-control  form-control-sm @error('name') is-invalid @enderror"
                                                value="{{ old('name') }}" placeholder="Enter Name" />
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Price Field -->
                                        <div class="form-group mb-3">
                                            <label for="price" class="form-label text-success-1000 text-md">Price</label>
                                            <input type="number" step="0.01" min="0" name="price" id="price"
                                                class="form-control  form-control-sm @error('price') is-invalid @enderror"
                                                value="{{ old('price') }}" placeholder="Enter price" />
                                            @error('price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <!-- Second Row -->
                                    <div class="col-md-6">
                                        <!-- No. of Standards Allow Field -->
                                        <div class="form-group mb-3">
                                            <label for="no_of_standards" class="form-label text-success-1000 text-md">Standards Allow</label>
                                            <input type="number" name="no_of_standards" id="no_of_standards"
                                                class="form-control  form-control-sm @error('no_of_standards') is-invalid @enderror"
                                                value="{{ old('no_of_standards') }}" placeholder="Enter Standards allowed" />
                                            @error('no_of_standards')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Billing Cycle Field -->
                                        <div class="form-group mb-3">
                                            <label for="billing_cycle" class="form-label text-success-1000 text-md">Billing Cycle</label>
                                            <select class="form-control  form-control-sm @error('billing_cycle') is-invalid @enderror"
                                                id="billing_cycle" name="billing_cycle" required>
                                                <option value="">Select Billing Cycle</option>
                                                <option value="monthly" {{ old('billing_cycle') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                                <option value="yearly" {{ old('billing_cycle') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                                            </select>
                                            @error('billing_cycle')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <!-- Third Row -->
                                    <div class="col-md-6">
                                        <!-- Mark as Popular Field -->
                                        <div class="form-group mb-3">
                                            <label class="form-label form-label text-success-1000 text-md">Mark as Popular?</label><br>
                                            <div class="form-switch switch-success d-flex align-items-center gap-3">
                                                <input type="checkbox" name="is_popular" value="1"
                                                    class="form-check-input @error('is_popular') is-invalid @enderror"
                                                    {{ old('is_popular') ? 'checked' : '' }}>
                                            </div>
                                            @error('is_popular')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Icon Selection Dropdown -->
                                        <div class="form-group mb-3">
                                            <label class="form-label form-label text-success-1000 text-md">Select Icon</label>
                                            <div class="dropdown">
                                                <button class="btn btn-outline-secondary dropdown-toggle d-flex align-items-center"
                                                    type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    @if(old('icon'))
                                                        <img src="{{ asset('asset/frontend/imgs/page/pricing/' . old('icon')) }}"
                                                            alt="Selected Icon" width="25" height="25" class="me-2">
                                                        <span>{{ old('icon') }}</span>
                                                    @else
                                                        <iconify-icon icon="bx:image" class="me-2"></iconify-icon>
                                                        <span>Select an icon</span>
                                                    @endif
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                                    style="overflow-y: auto; max-height: 200px;">
                                                    <a class="dropdown-item d-flex align-items-center" href="#"
                                                        onclick="selectIcon('img1.jpeg', event)">
                                                        <img src="{{ asset('asset/frontend/imgs/page/pricing/img1.jpeg') }}" alt="Icon 1" width="25" height="25" class="me-2">
                                                        <span>Icon 1</span>
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center" href="#"
                                                        onclick="selectIcon('img2.jpeg', event)">
                                                        <img src="{{ asset('asset/frontend/imgs/page/pricing/img2.jpeg') }}" alt="Icon 2" width="25" height="25" class="me-2">
                                                        <span>Icon 2</span>
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center" href="#"
                                                        onclick="selectIcon('img3.jpeg', event)">
                                                        <img src="{{ asset('asset/frontend/imgs/page/pricing/img3.jpeg') }}" alt="Icon 3" width="25" height="25" class="me-2">
                                                        <span>Icon 3</span>
                                                    </a>
                                                    <a class="dropdown-item d-flex align-items-center" href="#"
                                                        onclick="selectIcon('img4.jpeg', event)">
                                                        <img src="{{ asset('asset/frontend/imgs/page/pricing/img4.jpeg') }}" alt="Icon 4" width="25" height="25" class="me-2">
                                                        <span>Icon 4</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <input type="hidden" id="selected-icon" name="icon" value="{{ old('icon') }}">
                                            @error('icon')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Description Field at Bottom -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="description" class="form-label text-success-1000 text-md">Description</label>
                                            <textarea name="description" id="description" cols="30" rows="6"
                                                class="form-control  form-control-sm @error('description') is-invalid @enderror"
                                                rows="3" placeholder="Enter a description...">{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit and Cancel Buttons -->
                                <div class="card-action my-3">
                                    <button type="submit" class="btn btn-brand-1">Submit</button>
                                    <a href="{{ route('admin.subscription-plans.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @endsection
    </main>

@push('custom-js')
    <script>
        function selectIcon(icon, event) {
            event.preventDefault();
            document.getElementById('selected-icon').value = icon;

            const dropdownButton = document.getElementById('dropdownMenuButton');
            dropdownButton.innerHTML = `
                <img src="{{ asset('asset/frontend/imgs/page/pricing/') }}/${icon}"
                     alt="Selected Icon" width="25" height="25" class="me-2">
                <span>${icon}</span>
            `;
        }
    </script>
@endpush
