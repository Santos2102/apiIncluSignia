@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Diagnósticos'])
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Listado de ') }} prácticas de {{$student -> person -> name. ' ' . $student -> person -> lastName }}</span>
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
                                        <th>Diagnóstico</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                        $i=0;
                                    @endphp

                                    @if(count($diagnostics)<=0)
                                        <th colspan="4" style="text-align:center;">SIN PRÁCTICAS REGISTRADAS</th>
                                    @else
                                        @foreach ($diagnostics as $diagnostic)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                
                                                <td>{{ Carbon\Carbon::parse($diagnostic->date)->format('d-m-Y') }}</td>
                                                <td>{{ $diagnostic->diagnostic }}</td>

                                                <td>
                                                    @can('Editar practica')
                                                        <a class="btn btn-sm btn-success " href="{{route('practicas.edit',encrypt($diagnostic->diagnosticsId))}}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @endcan
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
    </section>
@endsection
