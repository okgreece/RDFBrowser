<div class="form-group {{ $errors->has('root') ? 'has-error' : ''}}">
    {!! Form::label('root', 'Root', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('root', null, ['class' => 'form-control']) !!}
        {!! $errors->first('root', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    {!! Form::label('type', 'Type', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('type', ['Suffix', 'Pubby', 'NoRedirection'], null, ['class' => 'form-control']) !!}
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('enabled') ? 'has-error' : ''}}">
    {!! Form::label('enabled', 'Enabled', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
                    <div class="checkbox">
                <label>{!! Form::radio('enabled', '1') !!} Yes</label>
            </div>
            <div class="checkbox">
                <label>{!! Form::radio('enabled', '0', true) !!} No</label>
            </div>
        {!! $errors->first('enabled', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('html') ? 'has-error' : ''}}">
    {!! Form::label('html', 'Html', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('html', null, ['class' => 'form-control']) !!}
        {!! $errors->first('html', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('data') ? 'has-error' : ''}}">
    {!! Form::label('data', 'Data', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textarea('data', null, ['class' => 'form-control']) !!}
        {!! $errors->first('data', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>