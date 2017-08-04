@extends('layouts.app')

@section('content')
<div class="box box-primary">
    <div class="container">
        <div class="box-header">
            <h1>Edit Resource Class {{ $resourceclass->id }}</h1>
        </div>
        <div class="box-body">
            {!! Form::model($resourceclass, [
                'method' => 'PATCH',
                'url' => ['/RDFBrowser/resource-classes', $resourceclass->id],
                'class' => 'form-horizontal'
            ]) !!}

            @include('resource-classes.form')

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