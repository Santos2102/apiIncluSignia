@extends('layouts.app')

@section('template_title')
    {{ $student->name ?? "{{ __('Show') Student" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Student</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('students.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Studentid:</strong>
                            {{ $student->studentId }}
                        </div>
                        <div class="form-group">
                            <strong>Code:</strong>
                            {{ $student->code }}
                        </div>
                        <div class="form-group">
                            <strong>Grade:</strong>
                            {{ $student->grade }}
                        </div>
                        <div class="form-group">
                            <strong>Direction:</strong>
                            {{ $student->direction }}
                        </div>
                        <div class="form-group">
                            <strong>Inscriptiondate:</strong>
                            {{ $student->inscriptionDate }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $student->status }}
                        </div>
                        <div class="form-group">
                            <strong>Disabilityid:</strong>
                            {{ $student->disabilityId }}
                        </div>
                        <div class="form-group">
                            <strong>Personid:</strong>
                            {{ $student->personId }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
