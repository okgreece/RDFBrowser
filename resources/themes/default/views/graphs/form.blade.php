<div class="form-group {{ $errors->has('graph_name') ? 'has-error' : ''}}">
    {!! Form::label('graph_name', 'Graph Name', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('graph_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('graph_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('graph') ? 'has-error' : ''}}">
    {!! Form::label('graph', 'Graph', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::file('graph', null, ['class' => 'form-control']) !!}
        {!! $errors->first('graph', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>