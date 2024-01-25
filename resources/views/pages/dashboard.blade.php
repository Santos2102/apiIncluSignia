@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Inicio'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="form-floating">
                @if(auth()->user()->id==1)
                    <h1>¡BIENVENIDO! {{auth()->user()->firstname}}</h1>
                @else
                    <h1>¡BIENVENIDO! {{auth()->user()->firstname}} {{auth()->user()->lastname}}</h1>
                @endif
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
