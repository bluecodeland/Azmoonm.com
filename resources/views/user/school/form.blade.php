<div class="form-group {{ $errors->has('picture') ? 'has-error' : ''}}">
    {!! Form::label('school', 'مرکز/مدرسه فقهی', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('school_id', $schools, null, ['class' => 'form-control']) !!}
        {!! $errors->first('school', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'ذخیره', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
