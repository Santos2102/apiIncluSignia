@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Evaluaciones'])
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if ($message = Session::get('error'))
                    <div class="alert alert-error">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Actualizar') }} información</span>
                    </div>
                    <div class="card-body">
                    <form method="POST" action="{{ route('evaluaciones.update', encrypt($test->testId)) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PUT') }}
                            @csrf
                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="name">Código de estudiante</label>
                                        <input type="text" name="code" id="code" value="{{$student->code}}" required placeholder="Código de estudiante" class="form-control">
                                        @error('code')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nivel</label>
                                        <select name="level" class="form-control text-dark" id="level" required>
                                            <option value="Facil" {{$test -> level == 'Facil' ? 'selected' : ''}}>Facil</option>
                                            <option value="Medio" {{$test -> level == 'Medio' ? 'selected' : ''}}>Medio</option>
                                            <option value="Difícil" {{$test -> level == 'Difícil' ? 'selected' : ''}}>Difícil</option>
                                        </select>
                                        @error('level')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="diagnostic">Punteo</label>
                                        <input type="text" name="score" id="score" value="{{$test->score}}" required placeholder="Punteo" class="form-control">
                                        @error('score')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="box-footer mt20">
                                    <button type="submit" class="btn btn-primary">{{ __('Actualizar') }}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

