@extends('layouts.app')

@section('content')
<div class="container box">

    <h1>Graphs <a href="{{ url('/RDFBrowser/graphs/create') }}" class="btn btn-primary btn-xs" title="Add New Graph"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Graph Name </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($graphs as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->graph_name }}</td>
                    <td>
                        <a href="{{ url('/RDFBrowser/graphs/' . $item->id) }}" class="btn btn-success btn-xs" title="View Graph"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/RDFBrowser/graphs/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Graph"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/RDFBrowser/graphs', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Graph" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Graph',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ));!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $graphs->render() !!} </div>
    </div>

</div>
@endsection
