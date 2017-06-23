@extends('layouts.app')

@section('content')
<div class="container box">

    <h1>Endpoint <a href="{{ url('RDFBrowser/endpoint/create') }}" class="btn btn-primary btn-xs" title="Add New Endpoint"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th> Name </th>
                    <th> Endpoint Url </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($endpoint as $item)
                {{-- */$x++;/* --}}
                <tr>
                    
                    <td>{{ $item->name }}</td><td>{{ $item->endpoint_url }}</td>
                    <td>
                        <a href="{{ url('/RDFBrowser/endpoint/' . $item->id) }}" class="btn btn-success btn-xs" title="View Endpoint"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/RDFBrowser/endpoint/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Endpoint"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/RDFBrowser/endpoint', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Endpoint" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Endpoint',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ));!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $endpoint->render() !!} </div>
    </div>

</div>
@endsection
