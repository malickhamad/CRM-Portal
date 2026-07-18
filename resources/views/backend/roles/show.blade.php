@extends('backend.layouts.app')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded-top p-4">

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="float-start">
                    <h2> Show Role</h2>
                </div>
                <div class="float-end">
                    <a class="btn btn-secondary" href="{{ route('admin.roles.index') }}"> Back</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $role->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Permissions:</strong>
                    @if(!empty($rolePermissions))
                        @foreach($rolePermissions as $v)
                            <label class="label label-success">{{ $v->name }},</label>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

    </div>
    @include('backend.layouts.partials.footer')

</div>
@endsection
