@extends('layouts.app')

@section('content')
<div class="container box">

    <h1>ImageExtractor {{ $imageextractor->id }}
        <a href="{{ url('RDFBrowser/image-extractor/' . $imageextractor->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit ImageExtractor"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['/RDFBrowser/imageextractor', $imageextractor->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete ImageExtractor',
                    'onclick'=>'return confirm("Confirm delete?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $imageextractor->id }}</td>
                </tr>
                <tr><th> Property </th><td> {{ $imageextractor->property }} </td></tr><tr><th> Priority </th><td> {{ $imageextractor->priority }} </td></tr><tr><th> Enabled </th><td> {{ $imageextractor->enabled }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
