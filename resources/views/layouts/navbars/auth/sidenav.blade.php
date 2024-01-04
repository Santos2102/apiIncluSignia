<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}">
            <img src="./img/icono.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">IncluSignia</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Inicio</span>
                </a>
            </li>
            @can('Ver docentes')
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Docentes</h6>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{route('docentes.index')}}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Ver</span>
                </a>
            </li>
            @endcan
            @can('Crear docentes')
            <li class="nav-item">
                <a class="nav-link" href="{{route('docentes.create')}}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-fat-add text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Nuevo</span>
                </a>
            </li>
            @endcan
            @can('Docentes eliminados')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('deletedTeachers') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-fat-remove text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Eliminados</span>
                </a>
            </li>
            @endcan
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Estudiantes</h6>
            </li>
            @can('Ver estudiantes')
            <li class="nav-item">
                <a class="nav-link" href="{{route('estudiantes.index')}}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Ver</span>
                </a>
            </li>
            @endcan
            @can('Crear estudiantes')
            <li class="nav-item">
                <a class="nav-link" href="{{route('estudiantes.create')}}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-fat-add text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Nuevo</span>
                </a>
            </li>
            @endcan
            @can('Estudiantes eliminados')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('deletedStudents')}}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-fat-remove text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Eliminados</span>
                </a>
            </li>
            @endcan
            @can('Crear evaluacion')
            <li class="nav-item">
                <a class="nav-link" href="{{route('evaluaciones.create')}}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-app text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Evaluación</span>
                </a>
            </li>
            @endcan
            @can('Crear practica')
            <li class="nav-item">
                <a class="nav-link" href="{{route('practicas.create')}}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-app text-info text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Práctica</span>
                </a>
            </li>
            @endcan
        </ul>
    </div>
</aside>
