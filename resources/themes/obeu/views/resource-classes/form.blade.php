<div class="form-group {{ $errors->has('classUrl') ? 'has-error' : ''}}">
    {!! Form::label('classUrl', 'Class URI', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('classUrl', null, ['class' => 'form-control']) !!}
        {!! $errors->first('classUrl', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('enabled') ? 'has-error' : ''}}">
    {!! Form::label('enabled', 'Enabled', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
                    <div class="checkbox">
                <label>{!! Form::radio('enabled', '1', true) !!} Yes</label>
            </div>
            <div class="checkbox">
                <label>{!! Form::radio('enabled', '0') !!} No</label>
            </div>
        {!! $errors->first('enabled', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('pagination') ? 'has-error' : ''}}">
    {!! Form::label('pagination', 'Pagination', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
                    <div class="checkbox">
                <label>{!! Form::radio('pagination', '1', true) !!} Yes</label>
            </div>
            <div class="checkbox">
                <label>{!! Form::radio('pagination', '0') !!} No</label>
            </div>
        {!! $errors->first('pagination', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('pagination_size') ? 'has-error' : ''}}">
    {!! Form::label('pagination_size', 'Pagination Size', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('pagination_size', 20, ['class' => 'form-control']) !!}
        {!! $errors->first('pagination_size', '<p class="help-block">:message</p>') !!}
    </div>
</div>