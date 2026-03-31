@extends('backend.layouts.app')

@section('content')
    <main class="dashboard-main">
        @include('backend.layouts.partials.header')

<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0 text-success-1000 ">Questions</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 text-success-1000 text-md hover-text-success ">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium text-success-1000 text-md">Questions</li>
        </ul>
    </div>
    <x-sweet-alert :type="session('sweetalert.type')" :message="session('sweetalert.message')" :title="session('sweetalert.title')" />
        <!-- Datatable start -->
    <div class="card ">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title text-success-1000 ">Questions</h4>
            <a href="{{ route('admin.mcqs.create') }}" class="btn btn-brand-1">+ Add
            </a>
        </div>
        <div class="card-body basic-data-table  mt-3">
            <div class="row p-3">
                <div class="col-md-6 mb-3">
                    <select id="categoryFilter" class="form-control  form-control-sm">
                        <option value="">-- Filter by Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->name }}">{{$category->name }}</option>
                        @endforeach
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <select id="sectionFilter" class="form-control  form-control-sm">
                        <option value="">-- Filter by Section --</option>
                        @foreach ($sections as $section)
                            <option value="{{ $section->name }} @if($section->standard)({{ Str::limit($section->standard->name, 20, '...') }})@else'(No Standard)'@endif">
                                {{ $section->name }}
                                @if($section->standard)
                                    ({{ Str::limit($section->standard->name, 20, '...') }})
                                @else
                                    (No Standard)
                                @endif
                            </option>
                        @endforeach
                        <!-- Add more options as needed -->
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <!-- Table for MCQs -->
                <table class="table bordered-table mb-1" id="dataTable" data-page-length='10'>
                    <thead>
                        <tr>
                            <th scope="col" class="text-start w-110-px"> 
                              S.L
                            </th>
                            <th scope="col">Question</th>
                            <th scope="col">Section</th>
                            <th scope="col" >Category</th>
                            <!-- <th scope="col">Reference</th> -->
                            <th scope="col" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mcqs as $mcq)
                            <tr>
                                <td class="text-start">
                                            {{ $loop->iteration }}
                                </td>
                                <td >{{ Str::limit($mcq->question, 20, '...') }}</td>
                                <td >
                                    @if($mcq->section)
                                        {{ $mcq->section->name }}
                                        @if($mcq->section->standard)
                                            ({{ Str::limit($mcq->section->standard->name, 20, '...') }})
                                        @else
                                            (No Standard)
                                        @endif
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td >{{ $mcq->category->name ?? 'N/A' }}</td>
                                <!-- <td >{{ Str::limit($mcq->reference, 20, '...') ?? 'N/A' }}</td> -->
                                <td class="text-start d-flex align-items-center">
                                    <a href="{{ route('admin.mcqs.edit', $mcq->id) }}"
                                        class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center mx-2"
                                        data-bs-toggle="tooltip" title="Edit">
                                        <iconify-icon icon="lucide:edit"></iconify-icon>
                                    </a>
                                    <form action="{{ route('admin.mcqs.destroy', $mcq->id) }}"
                                        method="POST" class="d-inline mx-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="btn-delete w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                            data-bs-toggle="tooltip" title="Delete">
                                            <iconify-icon
                                                icon="mingcute:delete-2-line"></iconify-icon>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


@endsection
