@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Organizations</div>

                @if(\Session::has('success'))
                <div class="alert alert-success">
                    {{\Session::get('success')}}
                </div>
                @endif
                @if(\Session::has('error'))
                <div class="alert alert-error">
                    {{\Session::get('error')}}
                </div>
                @endif

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/organization-save') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('organizationName') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Organization Name</label>

                            <div class="col-md-6">
                                <input id="organizationName" type="text" class="form-control" required="required" name="organizationName" value="{{ old('organizationName') }}">
                                @if ($errors->has('organizationName'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('organizationName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Description</label>
                            <div class="col-md-6">
                                <textarea rows="4" cols="30" class="form-control" required="required" name="description" id="description">
                                    {{ old('description') }}
                                </textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Add Organization
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($organizationData->count()>0)

    @include('organizationList');
    @endif

</div>
@endsection

@section('script')

<script>

    $(document).ready(function() {
        $('#example').DataTable();
    } );

</script>

@endsection
