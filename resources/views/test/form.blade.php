<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('testId') }}
            {{ Form::text('testId', $test->testId, ['class' => 'form-control' . ($errors->has('testId') ? ' is-invalid' : ''), 'placeholder' => 'Testid']) }}
            {!! $errors->first('testId', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('level') }}
            {{ Form::text('level', $test->level, ['class' => 'form-control' . ($errors->has('level') ? ' is-invalid' : ''), 'placeholder' => 'Level']) }}
            {!! $errors->first('level', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('score') }}
            {{ Form::text('score', $test->score, ['class' => 'form-control' . ($errors->has('score') ? ' is-invalid' : ''), 'placeholder' => 'Score']) }}
            {!! $errors->first('score', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('dateTime') }}
            {{ Form::text('dateTime', $test->dateTime, ['class' => 'form-control' . ($errors->has('dateTime') ? ' is-invalid' : ''), 'placeholder' => 'Datetime']) }}
            {!! $errors->first('dateTime', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('studentId') }}
            {{ Form::text('studentId', $test->studentId, ['class' => 'form-control' . ($errors->has('studentId') ? ' is-invalid' : ''), 'placeholder' => 'Studentid']) }}
            {!! $errors->first('studentId', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>