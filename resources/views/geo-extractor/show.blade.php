@extends('layouts.app')

@section('content')
<div class="container">

    <h1>GeoExtractor {{ $geoextractor->id }}
        <a href="{{ url('geo-extractor/' . $geoextractor->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit GeoExtractor"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['geoextractor', $geoextractor->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete GeoExtractor',
                    'onclick'=>'return confirm("Confirm delete?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $geoextractor->id }}</td>
                </tr>
                <tr><th> Title </th><td> {{ $geoextractor->title }} </td></tr><tr><th> Type </th><td> {{ $geoextractor->type }} </td></tr><tr><th> Generic </th><td> {{ $geoextractor->generic }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
