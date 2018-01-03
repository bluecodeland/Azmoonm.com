<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    {!! Form::label('user_id', 'User Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('aptitude_results') ? 'has-error' : ''}}">
    {!! Form::label('aptitude_results', 'Aptitude Results', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('aptitude_results', null, ['class' => 'form-control']) !!}
        {!! $errors->first('aptitude_results', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('fiqh_results') ? 'has-error' : ''}}">
    {!! Form::label('fiqh_results', 'Fiqh Results', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('fiqh_results', null, ['class' => 'form-control']) !!}
        {!! $errors->first('fiqh_results', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('usul_results') ? 'has-error' : ''}}">
    {!! Form::label('usul_results', 'Usul Results', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('usul_results', null, ['class' => 'form-control']) !!}
        {!! $errors->first('usul_results', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('essay_results') ? 'has-error' : ''}}">
    {!! Form::label('essay_results', 'Essay Results', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('essay_results', null, ['class' => 'form-control']) !!}
        {!! $errors->first('essay_results', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
