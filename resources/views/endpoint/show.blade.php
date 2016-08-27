@extends('layouts.app')

@section('content')
<div class="container box">

    <h1>Endpoint
        <a href="{{ url('endpoint/' . $endpoint->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Endpoint"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['endpoint', $endpoint->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Endpoint',
                    'onclick'=>'return confirm("Confirm delete?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                
                <tr>
                    <th> Name </th>
                    <td> {{ $endpoint->name }} </td>
                </tr>
                <tr>
                    <th> Endpoint Url </th>
                    <td> {{ $endpoint->endpoint_url }} </td>
                </tr>
                <tr>
                    <th> Local Endpoint </th>
                    <td> {{ $endpoint->local }} </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
