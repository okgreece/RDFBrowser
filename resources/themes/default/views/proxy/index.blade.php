@extends('layouts.app')

@section('content')
<div class="container box">

    <h1>Proxy <a href="{{ url('/RDFBrowser/proxy/create') }}" class="btn btn-primary btn-xs" title="Add New Proxy"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>URL</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($proxy as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->url }}</td>
                    <td>
                        <a href="{{ url('/RDFBrowser/proxy/' . $item->name) }}" class="btn btn-success btn-xs" title="View Proxy"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/RDFBrowser/proxy/' . $item->name . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Proxy"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/RDFBrowser/proxy', $item->name],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Proxy" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Proxy',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ));!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $proxy->render() !!} </div>
    </div>

</div>
@endsection
