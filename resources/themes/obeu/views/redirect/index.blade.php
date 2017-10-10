@extends('layouts.app')

@section('content')
<div class="container box">

    <h1>Redirect <a href="{{ url('/RDFBrowser/redirect/create') }}" class="btn btn-primary btn-xs" title="Add New Redirect"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Root </th><th> Type </th><th> Enabled </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($redirect as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->root }}</td><td>{{ $item->type }}</td><td>{{ $item->enabled }}</td>
                    <td>
                        <a href="{{ url('/RDFBrowser/redirect/' . $item->id) }}" class="btn btn-success btn-xs" title="View Redirect"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/RDFBrowser/redirect/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Redirect"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/RDFBrowser/redirect', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Redirect" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Redirect',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ));!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $redirect->render() !!} </div>
    </div>

</div>
@endsection
