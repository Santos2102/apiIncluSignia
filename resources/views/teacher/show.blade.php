@extends('layouts.app')

@section('template_title')
    {{ $teacher->name ?? "{{ __('Show') Teacher" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Teacher</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('docentes.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Teacherid:</strong>
                            {{ $teacher->teacherId }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $teacher->status }}
                        </div>
                        <div class="form-group">
                            <strong>Personid:</strong>
                            {{ $teacher->personId }}
                        </div>
                        <div class="form-group">
                            <strong>Roleid:</strong>
                            {{ $teacher->roleId }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
