@extends('layouts.app')

@section('content')
<div class="container box">

    <h1>user {{ $user->id }}
        <a href="{{ url('RDFBrowser/user/' . $user->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit user"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['user', $user->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete user',
                    'onclick'=>'return confirm("Confirm delete?")'
            ));!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <th> Name </th>
                    <td> {{ $user->name }} </td>
                </tr>
                <tr>
                    <th> Email </th>
                    <td> {{ $user->email }} </td>
                </tr>
                <tr>
                    <th> Role</th>
                    <td>
                    @foreach($user->roles()->get() as $role)
                    {{$role->display_name}}
                    @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
