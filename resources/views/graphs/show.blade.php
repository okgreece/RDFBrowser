@extends('layouts.app')

@section('content')
<div class="container box">

    <h1>Graph {{ $graph->id }}
        <a href="{{ url('/RDFBrowser/graphs/' . $graph->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Graph"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['/RDFBrowser/graphs', $graph->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Graph',
                    'onclick'=>'return confirm("Confirm delete?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $graph->id }}</td>
                </tr>
                <tr><th> Graph Name </th><td> {{ $graph->graph_name }} </td></tr><tr><th> Graph </th><td> {{ $graph->graph_file_name }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
