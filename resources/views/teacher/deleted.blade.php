@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Docentes eliminados'])
    <div class="container-fluid">
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
										<th>Nombre</th>
										<th>Apellido</th>
										<th>CUI</th>
                                        <th>Correo</th>
										<th>Fecha de nacimiento</th>
                                        <th>Edad</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($teachers)==0)
                                        <th colspan="7" style="text-align:center;">SIN DOCENTES ELIMINADOS</th>
                                    @else
                                        @php
                                            $i=0;
                                        @endphp
                                        @foreach ($teachers as $teacher)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                
                                                <td>{{ $teacher->person->name }}</td>
                                                <td>{{ $teacher->person->lastName }}</td>
                                                <td>{{ $teacher->person->cui }}</td>
                                                <td>{{ $teacher->email }}</td>
                                                <td>{{ Carbon\Carbon::parse($teacher->person->birthDate)->format('d-m-Y') }}</td>
                                                <td>{{ $teacher->person->age }}</td>


                                                <td>
                                                    <form action="{{ route('restoreTeacher',encrypt($teacher->teacherId)) }}" method="POST">
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
        function eliminarDocente(value){
            action = confirm(value) ? true : event.preventDefault();
        }
    </script>
@endsection