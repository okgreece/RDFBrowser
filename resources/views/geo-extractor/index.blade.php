@extends('layouts.app')

@section('content')
<div class="container box">

    <h1>Geo Extractor <a href="{{ url('/geo-extractor/create') }}" class="btn btn-primary btn-xs" title="Add New GeoExtractor"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Generic</th>
                    <th>Latitude Property</th>
                    <th>Longtitude Property</th>
                    <th> Enabled </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- */$x=0;/* --}}
                @foreach($geoextractor as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $item->order }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->type }}</td>
                    <td>{{ $item->generic }}</td>
                    <td>{{ $item->lat }}</td>
                    <td>{{ $item->long }}</td>
                    <td> {{ $item->enabled ? 'True' : 'False' }} </td>
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
