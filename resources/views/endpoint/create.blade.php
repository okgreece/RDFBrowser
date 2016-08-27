@extends('layouts.app')

@section('content')
<div class="box box-primary">
    <div class="container">
        <div class="box-header">
            <h1>Create New Endpoint</h1>
            <hr/>
        </div>
        <div class="box-body">

            {!! Form::open(['url' => '/endpoint', 'class' => 'form-horizontal']) !!}

                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('endpoint_url') ? 'has-error' : ''}}">
                {!! Form::label('endpoint_url', 'Endpoint Url', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('endpoint_url', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('endpoint_url', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('local') ? 'has-error' : ''}}">
                {!! Form::label('local', 'Local Endpoint', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <div class="checkbox">
                        <label>{!! Form::radio('local', '1', true) !!} Yes</label>
                    </div>
                    <div class="checkbox">
                        <label>{!! Form::radio('local', '0') !!} No</label>
                    </div>
                    {!! $errors->first('local', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group">
                <center>
                    <button type ="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Cancel</button>
                    {!! Form::submit('Create', ['class' => 'btn btn-success']) !!}
                </center>
            </div>
            {!! Form::close() !!}

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
@include('modals.closeCreate')