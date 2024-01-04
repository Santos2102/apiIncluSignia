@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Estudiantes eliminados'])
    <div class="container pt-2">
        <div class="row">
            <form action="{{route('deletedStudents')}}" role="form">
                <div class="justify-content-center row">
                    <div class="col-xl-3 col-lg-4 col-md-5 col-sm-6 mb-2">
                        <div class="form-floating">
                            <select name="disabilityFilter" class="form-control" id="disabilityFilter" onchange="this.form.submit()">
                            <option value="" selected disabled>Sin filtros</option>
                            @foreach($disabilities as $disability)
                                <option value="{{encrypt($disability->disabilityId)}}">{{$disability->disabilityName}}</option>
                            @endforeach>
                            </select>
                            <label for="disabilityFilter">Discapacidad</label>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-8 col-sm-7 mb-2">
                        <div class="form-floating">
                            <input class="form-control text-dark" aria-describedby="basic-addon2" placeholder="Nombre" id="buscarNombre" type="text" name="buscarNombre" value="">
                            <label for="buscarNombre">Nombre</label>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-8 col-sm-7 mb-2">
                        <div class="form-floating">
                            <input class="form-control text-dark" aria-describedby="basic-addon2" placeholder="Apellido" id="buscarApellido" type="text" name="buscarApellido" value="">
                            <label for="buscarApellido">Apellido</label>
                        </div>
                    </div>
                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 form-floating">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                    <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 mb-2 form-floating">
                        <button type="button" class="btn btn-light" onclick="window.location='{{route('deletedStudents')}}'">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="container-fluid pt-1">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
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
                                    <th colspan="11" style="text-align:center;">SIN ESTUDIANTES ELIMINADOS</th>
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
                                                    <form action="{{ route('restoreStudent',encrypt($student->studentId)) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-dark btn-sm"><i class="fa fa-fw fa-refresh"></i> {{ __('Restaurar') }}</button>
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
