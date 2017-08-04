@extends('layouts.app')

@section('content')
<div class="container box">

    <h1>Resource Class {{ $resourceclass->id }}
        <a href="{{ url('RDFBrowser/resource-classes/' . $resourceclass->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Resource Class"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['RDFBrowser/resourceclasses', $resourceclass->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Resource Class',
                    'onclick'=>'return confirm("Confirm delete?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $resourceclass->id }}</td>
                </tr>
                <tr>
                    <th> Class IRI </th>
                    <td> {{ $resourceclass->classUrl }} </td>
                </tr>
                <tr>
                    <th> Enabled </th>
                    <td> {{ $resourceclass->enabled }} </td>
                </tr>
                <tr>
                    <th> Pagination </th>
                    <td> {{ $resourceclass->pagination }} </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
