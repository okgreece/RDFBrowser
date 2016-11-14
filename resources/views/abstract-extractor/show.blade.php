@extends('layouts.app')

@section('content')
<div class="container box">

    <h1>Abstract Extractor {{ $abstractextractor->id }}
        <a href="{{ url('/RDFBrowser/abstract-extractor/' . $abstractextractor->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit AbstractExtractor"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['RDFBrowser/abstractextractor', $abstractextractor->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Abstract Extractor',
                    'onclick'=>'return confirm("Confirm delete?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th> Property </th>
                    <td> {{ $abstractextractor->property }} </td>
                </tr>
                <tr>
                    <th> Priority </th>
                    <td> {{ $abstractextractor->priority }} </td>
                </tr>
                <tr>
                    <th> Enabled </th>
                    <td> {{ $abstractextractor->enabled }} </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
