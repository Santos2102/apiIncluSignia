@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Estudiantes'])
    <div class="container-fluid">
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
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $student->code }}</td>
                                                <td>{{ $student->person->name }}</td>
                                                <td>{{ $student->person->lastName }}</td>
                                                <td>{{ $student->person->cui }}</td>
                                                <td>{{ Carbon\Carbon::parse($student->person->birthDate)->format('d-m-Y') }}</td>
                                                <td>{{ $student->person->age }}</td>
                                                <td>{{ $student->grade }}</td>
                                                <td>{{ $student->disability->disabilityName}}</td>

                                                <td>
                                                    <form action="{{ route('estudiantes.destroy',encrypt($student->studentId)) }}" method="POST">
                                                        <a class="btn btn-sm btn-success" href="{{ route('estudiantes.edit',encrypt($student->studentId)) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return eliminarEstudiante('Eliminar estudiante')"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
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
