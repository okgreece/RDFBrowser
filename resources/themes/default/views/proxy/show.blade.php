@extends('layouts.app')

@section('content')
<div class="container box">

    <h1>Proxy {{ $proxy->name }}
        <a href="{{ url('/RDFBrowser/proxy/' . $proxy->name . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Proxy"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['/RDFBrowser/proxy', $proxy->name],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Proxy',
                    'onclick'=>'return confirm("Confirm delete?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $proxy->id }}</td>
                    <th>Name</th><td>{{ $proxy->name }}</td>
                    <th>URL</th><td>{{ $proxy->url }}</td>
                </tr>
                
            </tbody>
        </table>
    </div>

</div>
@endsection
