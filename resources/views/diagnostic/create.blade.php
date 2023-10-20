@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Diagnósticos'])
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
                        <form method="POST" action="{{ route('practicas.store') }}"  role="form" enctype="multipart/form-data">
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
                                        <label for="name">Fecha</label>
                                        <input type="date" name="date" id="date" value="{{$date}}" required class="form-control">
                                        @error('date')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="diagnostic">Observaciones</label>
                                        <textarea  name="diagnostic" id="diagnostic" cols="10" rows="5" style="resize:none;" required placeholder="Observaciones" class="form-control">{{old('diagnostic')}}</textarea>
                                        @error('diagnostic')
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
