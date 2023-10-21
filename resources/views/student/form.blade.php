<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('studentId') }}
            {{ Form::text('studentId', $student->studentId, ['class' => 'form-control' . ($errors->has('studentId') ? ' is-invalid' : ''), 'placeholder' => 'Studentid']) }}
            {!! $errors->first('studentId', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('code') }}
            {{ Form::text('code', $student->code, ['class' => 'form-control' . ($errors->has('code') ? ' is-invalid' : ''), 'placeholder' => 'Code']) }}
            {!! $errors->first('code', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('grade') }}
            {{ Form::text('grade', $student->grade, ['class' => 'form-control' . ($errors->has('grade') ? ' is-invalid' : ''), 'placeholder' => 'Grade']) }}
            {!! $errors->first('grade', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('direction') }}
            {{ Form::text('direction', $student->direction, ['class' => 'form-control' . ($errors->has('direction') ? ' is-invalid' : ''), 'placeholder' => 'Direction']) }}
            {!! $errors->first('direction', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('inscriptionDate') }}
            {{ Form::text('inscriptionDate', $student->inscriptionDate, ['class' => 'form-control' . ($errors->has('inscriptionDate') ? ' is-invalid' : ''), 'placeholder' => 'Inscriptiondate']) }}
            {!! $errors->first('inscriptionDate', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::text('status', $student->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('disabilityId') }}
            {{ Form::text('disabilityId', $student->disabilityId, ['class' => 'form-control' . ($errors->has('disabilityId') ? ' is-invalid' : ''), 'placeholder' => 'Disabilityid']) }}
            {!! $errors->first('disabilityId', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('personId') }}
            {{ Form::text('personId', $student->personId, ['class' => 'form-control' . ($errors->has('personId') ? ' is-invalid' : ''), 'placeholder' => 'Personid']) }}
            {!! $errors->first('personId', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>