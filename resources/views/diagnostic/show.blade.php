@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Diagnósticos'])
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Listado de ') }} prácticas</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('practicas.index') }}"> {{ __('Regresar') }}</a>
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
                                    @foreach ($diagnostics as $diagnostic)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ Carbon\Carbon::parse($diagnostic->date)->format('d-m-Y') }}</td>
                                            <td>{{ $diagnostic->diagnostic }}</td>

                                            <td>
                                                <a class="btn btn-sm btn-success " href="{{route('practicas.edit',encrypt($diagnostic->diagnosticsId))}}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
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
