@extends('layouts.app')

@section('content')
<div class="box box-primary">
    <div class="container">
        <div class="box-header">
            <h1>Edit GeoExtractor {{ $geoextractor->id }}</h1>
            <hr/>

        </div>

        <div class="box-body">
            {!! Form::model($geoextractor, [
            'method' => 'PATCH',
            'url' => ['/RDFBrowser/geo-extractor', $geoextractor->id],
            'class' => 'form-horizontal'
            ]) !!}

            <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                {!! Form::label('title', 'Title', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
                {!! Form::label('type', 'Type', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('type', ['dual' => 'dual', 'single' => 'single'],'dual', ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('generic') ? 'has-error' : ''}}">
                {!! Form::label('generic', 'Generic', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('generic', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('generic', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('genericFormat') ? 'has-error' : ''}}">
                {!! Form::label('genericFormat', 'Genericformat', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('genericFormat', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('genericFormat', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('lat') ? 'has-error' : ''}}">
                {!! Form::label('lat', 'Lat', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('lat', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('lat', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('latFormat') ? 'has-error' : ''}}">
                {!! Form::label('latFormat', 'Latformat', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('latFormat', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('latFormat', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('long') ? 'has-error' : ''}}">
                {!! Form::label('long', 'Long', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('long', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('long', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('longFormat') ? 'has-error' : ''}}">
                {!! Form::label('longFormat', 'Longformat', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('longFormat', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('longFormat', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('enabled') ? 'has-error' : ''}}">
                {!! Form::label('enabled', 'Enabled', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <div class="checkbox">
                        <label>{!! Form::radio('enabled', '1') !!} Yes</label>
                    </div>
                    <div class="checkbox">
                        <label>{!! Form::radio('enabled', '0', true) !!} No</label>
                    </div>
                    {!! $errors->first('enabled', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('order') ? 'has-error' : ''}}">
                {!! Form::label('order', 'Order', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('order', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('order', '<p class="help-block">:message</p>') !!}
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