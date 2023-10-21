<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" value>
            {{ Form::label('teacherId') }}
            {{ Form::text('teacherId', $teacher->teacherId, ['class' => 'form-control' . ($errors->has('teacherId') ? ' is-invalid' : ''), 'placeholder' => 'Teacherid']) }}
            {!! $errors->first('teacherId', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::text('status', $teacher->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('personId') }}
            {{ Form::text('personId', $teacher->personId, ['class' => 'form-control' . ($errors->has('personId') ? ' is-invalid' : ''), 'placeholder' => 'Personid']) }}
            {!! $errors->first('personId', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('roleId') }}
            {{ Form::text('roleId', $teacher->roleId, ['class' => 'form-control' . ($errors->has('roleId') ? ' is-invalid' : ''), 'placeholder' => 'Roleid']) }}
            {!! $errors->first('roleId', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>