@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Geoextractor <a href="{{ url('/geo-extractor/create') }}" class="btn btn-primary btn-xs" title="Add New GeoExtractor"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Title </th><th> Type </th><th> Generic </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($geoextractor as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->title }}</td><td>{{ $item->type }}</td><td>{{ $item->generic }}</td>
                    <td>
                        <a href="{{ url('/geo-extractor/' . $item->id) }}" class="btn btn-success btn-xs" title="View GeoExtractor"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/geo-extractor/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit GeoExtractor"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/geo-extractor', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete GeoExtractor" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete GeoExtractor',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ));!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $geoextractor->render() !!} </div>
    </div>

</div>
@endsection
