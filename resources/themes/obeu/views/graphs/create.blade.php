@extends('layouts.app')

@section('content')
<div class="box box-primary">
    <div class="container">
        <div class="box-header">
            <h1>Create New Graph</h1>
            <hr/>
        </div>
        <div class="box-body">

            {!! Form::open(['url' => '/RDFBrowser/graphs', 
                            'class' => 'form-horizontal',
                            'method' => 'POST',
                            'files' => true
                            ]) !!}
            
            <div class="form-group {{ $errors->has('graph_name') ? 'has-error' : ''}}">
                {!! Form::label('graph_name', 'Graph Name', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::text('graph_name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('graph_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('graph') ? 'has-error' : ''}}">
                {!! Form::label('graph', 'Graph', ['class' => 'col-md-4 control-label']) !!}
                <div class="col-md-6">
                    {!! Form::file('graph', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('graph', '<p class="help-block">:message</p>') !!}
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