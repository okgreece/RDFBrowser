@extends('layouts.app')

@section('content')
<div class="container box">

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
                    <th>Order</th>
                    <td>{{ $geoextractor->order }}</td>
                </tr>
                <tr>
                    <th> Title </th>
                    <td> {{ $geoextractor->title }} </td>
                </tr>
                <tr>
                    <th> Type </th>
                    <td> {{ $geoextractor->type }} </td>
                </tr>
                <tr>
                    <th> Generic </th>
                    <td> {{ $geoextractor->generic }} </td>
                </tr>
                <tr>
                    <th> Generic Format</th>
                    <td> {{ $geoextractor->genericFormat }} </td>
                </tr>
                <tr>
                    <th> Latitude Property </th>
                    <td> {{ $geoextractor->lat }} </td>
                </tr>
                <tr>
                    <th> Latitude Format </th>
                    <td> {{ $geoextractor->latitudeFormat }} </td>
                </tr>
                <tr>
                    <th> Longitude Property </th>
                    <td> {{ $geoextractor->long }} </td>
                </tr>
                <tr>
                    <th> Longtitude Format </th>
                    <td> {{ $geoextractor->longtitudeFormat }} </td>
                </tr>
                <tr>
                    <th> Enabled </th>
                    <td> {{ $geoextractor->enabled ? 'True' : 'False' }} </td>
                </tr>
                
            </tbody>
        </table>
        <button type="button" onclick="goBack()" class="btn btn-primary">{{trans('theme/admin/modals/edit.back')}}</button>
    </div>

</div>
@endsection
<script>
function goBack() {
    window.history.back();
}
</script>