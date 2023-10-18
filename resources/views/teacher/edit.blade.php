@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Docentes'])
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Actualizar') }} información</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('docentes.update',encrypt($teacher -> teacherId)) }}"  role="form" enctype="multipart/form-data">
                            @csrf
                            {{method_field('PUT')}}
                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input type="text" name="name" id="name" value="{{$teacher->person->name}}" required placeholder="Nombre" class="form-control">
                                        @error('name')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname">Apellido</label>
                                        <input type="text" name="lastname" id="lastname" value="{{$teacher->person->lastName}}" required placeholder="Apellido" class="form-control">
                                        @error('lastname')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cui">CUI</label>
                                        <input type="text" name="cui" id="cui" value="{{$teacher->person->cui}}" required placeholder="CUI" class="form-control">
                                        @error('cui')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cui">Fecha de nacimiento</label>
                                        <input type="date" name="birthDate" id="birthDate" value="{{$teacher->person->birthDate}}" required placeholder="Fecha de nacimiento" class="form-control">
                                        @error('birthDate')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="age">Edad</label>
                                        <input type="text" name="age" id="age" value="{{$teacher->person->age}}" required placeholder="Edad" class="form-control" readonly>
                                        @error('cui')
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


    <script type="text/javascript">
        $(document).ready(function() {
            
            $('#birthDate').on('change', function() {
                function calcularEdad(fechas) {
                    var hoy = new Date();
                    var cumpleanos = new Date(fechas);
                    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
                    var m = hoy.getMonth() - cumpleanos.getMonth();

                    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
                        edad--;
                    }

                    return edad;
                }
                document.getElementById('age').value = calcularEdad(document.getElementById('birthDate').value);
            });
        });
    </script>
@endsection
