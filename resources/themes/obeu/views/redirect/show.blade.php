@extends('layouts.app')

@section('content')
<div class="container box">

    <h1>Redirect {{ $redirect->id }}
        <a href="{{ url('RDFBrowser/redirect/' . $redirect->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Redirect"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['RDFBrowser/redirect', $redirect->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Redirect',
                    'onclick'=>'return confirm("Confirm delete?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $redirect->id }}</td>
                </tr>
                <tr><th> Root </th><td> {{ $redirect->root }} </td></tr><tr><th> Type </th><td> {{ $redirect->type }} </td></tr><tr><th> Enabled </th><td> {{ $redirect->enabled }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
