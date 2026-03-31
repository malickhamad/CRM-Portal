@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

        <div class="dashboard-main-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Featues List</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-edium">
                        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Plan Features</li>
                </ul>
            </div>
            <x-sweet-alert :type="session('sweetalert.type')" :message="session('sweetalert.message')" :title="session('sweetalert.title')" />

                <form action="{{ route('admin.plan-features.update', $feature->id) }}" method="POST">
                    @csrf
                    @method('PATCH') {{-- Use PATCH for updates --}}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card py-4">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-8">

                                            <div class="form-group">
                                                <label for="plan_id" class="fs-5">Select Plan</label>
                                                <select name="plan_id" id="plan_id" class="form-control @error('plan_id') is-invalid @enderror" required>
                                                    <option value="">-- Select Plan --</option>
                                                    @foreach($plans as $plan)
                                                        <option value="{{ $plan->id }}" {{ $feature->subscription_plan_id == $plan->id ? 'selected' : '' }}>
                                                            {{ $plan->name }} ({{ $plan->billing_cycle }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('plan_id')
                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="form-group mt-3">
                                                <label for="feature_name" class="fs-5">Feature Name</label>
                                                <input type="text" name="feature_name"
                                                    class="form-control @error('feature_name') is-invalid @enderror" id="feature_name"
                                                    value="{{ old('feature_name', $feature->feature_name) }}" placeholder="Enter Feature Name" required />
                                                @error('feature_name')
                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-action mx-3 mb-3 mt-3">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <a href="{{ route('admin.plan-features.index') }}" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection


@section('scripts')
@endsection
