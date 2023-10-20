@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Evaluaciones'])
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Listado de ') }} evaluaciones de {{$student -> person -> name. ' ' . $student -> person -> lastName }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('estudiantes.index') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Fecha</th>
                                        <th>Nivel</th>
                                        <th>Punteo</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=0;
                                    @endphp
                                    @foreach ($tests as $test)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ Carbon\Carbon::parse($test->created_at)->format('d-m-Y') }}</td>
                                            <td>{{ $test->level }}</td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <span class="me-2 text-xs font-weight-bold">{{$test->score}}%</span>
                                                    <div>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-gradient-info" role="progressbar"
                                                                aria-valuenow="{{$test->score}}" aria-valuemin="0" aria-valuemax="{{$test->score}}"
                                                                style="width: {{$test->score}}%;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-success " href="{{route('evaluaciones.edit',encrypt($test->testId))}}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
