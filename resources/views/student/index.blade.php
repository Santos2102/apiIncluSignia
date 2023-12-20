@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Estudiantes'])
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                    <form action="{{route('estudiantes.index')}}" role="form">
                <div class="justify-content-center row">
                    <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6 mb-2">
                        <div class="form-floating">
                            <select name="disabilityFilter" class="form-control" id="disabilityFilter" onchange="this.form.submit()">
                            <option value="" selected disabled>Sin filtros</option>
                            @foreach($disabilities as $disability)
                                <option value="{{encrypt($disability->disabilityId)}}">{{$disability->disabilityName}}</option>
                            @endforeach
                            </select>
                            <label for="disabilityFilter">Discapacidad</label>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 mb-2">
                        <button type="button" class="btn btn-primary" onclick="window.location='{{route('estudiantes.index')}}'">Eliminar filtro</button>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-8 col-sm-7 mb-2">
                        <div class="form-floating">
                            <input class="form-control text-dark" aria-describedby="basic-addon2" placeholder="Búsqueda por nombre" id="buscarNombre" type="text" name="buscarNombre" value="" required>
                            <label for="buscarNombre">Nombre</label>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-1 col-sm-1">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </div>
            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid pt-1">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                            </span>

                             <div class="float-right">
                                <a href="{{ route('estudiantes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Nuevo') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Código</th>
										<th>Nombre</th>
										<th>Apellido</th>
										<th>CUI</th>
										<th>Fecha de nacimiento</th>
                                        <th>Edad</th>
                                        <th>Grado</th>
                                        <th>Discapacidad</th>
                                        
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($students)==0)
                                    <th colspan="11" style="text-align:center;">SIN ESTUDIANTES REGISTRADOS</th>
                                    @else
                                        @php
                                            $i=0;
                                        @endphp
                                        @foreach ($students as $student)
                                            <tr>
                                                <td style="text-align:center;">{{ ++$i }}</td>
                                                <td style="text-align:center;">{{ $student->code }}</td>
                                                <td style="text-align:center;">{{ $student->person->name }}</td>
                                                <td style="text-align:center;">{{ $student->person->lastName }}</td>
                                                <td style="text-align:center;">{{ $student->person->cui }}</td>
                                                <td style="text-align:center;">{{ Carbon\Carbon::parse($student->person->birthDate)->format('d-m-Y') }}</td>
                                                <td style="text-align:center;">{{ $student->person->age }}</td>
                                                <td style="text-align:center;">{{ $student->grade }}</td>
                                                <td style="text-align:center;">{{ $student->disability->disabilityName}}</td>

                                                <td>
                                                    <form action="{{ route('estudiantes.destroy',encrypt($student->studentId)) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        
                                                        @can('Ver evaluacion')
                                                            <a class="btn btn-sm btn-primary " href="{{route('practicas.show',encrypt($student->studentId))}}"><i class="fa fa-fw fa-book"></i> {{ __('Practicas') }}</a>
                                                        @endcan

                                                        @can('Ver practica')
                                                            <a class="btn btn-sm btn-info " href="{{route('evaluaciones.show',encrypt($student->studentId))}}"><i class="fa fa-fw fa-check"></i> {{ __('Evaluaciones') }}</a>
                                                        @endcan

                                                        @can('Editar estudiantes')
                                                            <a class="btn btn-sm btn-success" href="{{ route('estudiantes.edit',encrypt($student->studentId)) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                        @endcan

                                                        @can('Eliminar estudiantes')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return eliminarEstudiante('Eliminar estudiante')"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                        @endcan
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function eliminarEstudiante(value){
            action = confirm(value) ? true : event.preventDefault();
        }
    </script>
@endsection
