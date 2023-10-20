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
                        <span class="card-title">{{ __('Nuevo') }}</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('evaluaciones.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="name">Código de estudiante</label>
                                        <input type="text" name="code" id="code" value="{{old('code')}}" required placeholder="Código de estudiante" class="form-control">
                                        @error('code')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Nivel</label>
                                        <select name="level" class="form-control text-dark" id="level" required>
                                            <option selected value=""></option>
                                            <option value="Facil">Fácil</option>
                                            <option value="Medio">Medio</option>
                                            <option value="Dificil">Difícil</option>
                                        </select>
                                        @error('level')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="diagnostic">Score</label>
                                        <input type="text" name="score" id="score" value="{{old('score')}}" required placeholder="Punteo" class="form-control">
                                        @error('score')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="box-footer mt20">
                                    <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
