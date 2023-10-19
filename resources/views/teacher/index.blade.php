@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Docentes'])
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                            </span>

                             <div class="float-right">
                                <a href="{{ route('docentes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Nombre</th>
										<th>Apellido</th>
										<th>CUI</th>
										<th>Fecha de nacimiento</th>
                                        <th>Edad</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($teachers)==0)
                                        <th colspan="7" style="text-align:center;">SIN DOCENTES REGISTRADOS</th>
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
                                                <td>{{ Carbon\Carbon::parse($teacher->person->birthDate)->format('d-m-Y') }}</td>
                                                <td>{{ $teacher->person->age }}</td>


                                                <td>
                                                    <form action="{{ route('docentes.destroy',encrypt($teacher->teacherId)) }}" method="POST">
                                                        <a class="btn btn-sm btn-success" href="{{ route('docentes.edit',encrypt($teacher->teacherId)) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return eliminarDocente('Eliminar docente')"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
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
