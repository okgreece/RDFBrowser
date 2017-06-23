@extends('layouts.app')

@section('content')
<div class="box box-primary">
    <div class="container">
        <div class="box-header">
            <h1>Edit Graph {{ $graph->id }}</h1>
        </div>
        <div class="box-body">
            {!! Form::model($graph, [
            'method' => 'PATCH',
            'url' => ['/RDFBrowser/graphs', $graph->id],
            'class' => 'form-horizontal',
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
                    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
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
@include('modals.closeEdit')