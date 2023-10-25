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
                                    <div class="form-group">
                                        <label for="age">Correo</label>
                                        <input type="email" name="email" id="email" value="{{$teacher->email}}" required placeholder="Correo" class="form-control">
                                        @error('email')
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
        let contadorCuatro = 4;
        let contadorCinco = 5;
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
            $('#cui').on('keydown',function(){
                var obtenerCui = document.getElementById('cui');
                var codigo = event.which || event.keyCode;
                if(obtenerCui.value.length==0){
                    contadorCuatro=0;
                    contadorCinco=0;
                }
                if(obtenerCui.value.length <=14){
                    if(codigo >=96 && codigo <= 105 || codigo >=48 && codigo <= 57){
                        if(obtenerCui.value.length<=4){
                            contadorCuatro++;
                        }
                        if((obtenerCui.value.length>5 && obtenerCui.value.length<10) && contadorCinco<5){
                            contadorCinco++;
                        }
                    }
                    else if(codigo == 8){
                        if((contadorCuatro > 0 && contadorCuatro < 5) && (obtenerCui.value.length>-1 && obtenerCui.value.length<5)){
                            contadorCuatro--;
                        }
                        if((contadorCinco > 0 && contadorCinco < 6) && (obtenerCui.value.length>5 && obtenerCui.value.length<11)){
                            contadorCinco--;
                        }
                    }
                    if(obtenerCui.value.length==4 && contadorCuatro==5){
                        document.getElementById('cui').value = document.getElementById('cui').value+"-";
                        contadorCinco = 1;
                        if(contadorCuatro==5){
                            contadorCuatro = 4;
                        }
                    }
                    if(obtenerCui.value.length==10 && contadorCinco==5){
                        document.getElementById('cui').value = document.getElementById('cui').value+"-";
                        if(contadorCinco==5)
                        {
                            contadorCinco = 5;
                        }
                    }
                }
                else{
                    document.getElementById('cui').readOnly = true;
                }

                if(codigo == 8 && document.getElementById('cui').readOnly == true){
                    document.getElementById('cui').readOnly = false;
                }
            });
        });
    </script>
@endsection
