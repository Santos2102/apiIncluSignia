<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('diagnosticsId') }}
            {{ Form::text('diagnosticsId', $diagnostic->diagnosticsId, ['class' => 'form-control' . ($errors->has('diagnosticsId') ? ' is-invalid' : ''), 'placeholder' => 'Diagnosticsid']) }}
            {!! $errors->first('diagnosticsId', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('diagnostic') }}
            {{ Form::text('diagnostic', $diagnostic->diagnostic, ['class' => 'form-control' . ($errors->has('diagnostic') ? ' is-invalid' : ''), 'placeholder' => 'Diagnostic']) }}
            {!! $errors->first('diagnostic', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('date') }}
            {{ Form::text('date', $diagnostic->date, ['class' => 'form-control' . ($errors->has('date') ? ' is-invalid' : ''), 'placeholder' => 'Date']) }}
            {!! $errors->first('date', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('studentId') }}
            {{ Form::text('studentId', $diagnostic->studentId, ['class' => 'form-control' . ($errors->has('studentId') ? ' is-invalid' : ''), 'placeholder' => 'Studentid']) }}
            {!! $errors->first('studentId', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>