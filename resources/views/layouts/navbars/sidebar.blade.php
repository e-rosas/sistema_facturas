<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src={{url('/img/Hm-logo-02.png')}} class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Bienvenido</h6>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>Salir</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src={{url('/img/Hm-logo-02.png')}}>
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-purple"></i> Inicio
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('patients.index') }}">
                        <i class="fas fa-user-shield text-blue"></i> Pacientes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('insurers.index') }}">
                        <i class="fas fa-shield-alt text-orange"></i> Aseguranzas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('invoices.index') }}">
                        <i class="fas fa-file-invoice-dollar text-red"></i> Facturas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('payments.index') }}">
                        <i class="fas fa-dollar-sign text-green"></i> Pagos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('credits.index') }}">
                        <i class="fas fa-money-check-alt text-info"></i> Notas de credito
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('diagnoses.index') }}">
                        <i class="fas fa-diagnoses text-black"></i> Diagnósticos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('services.index') }}">
                        <i class="fas fa-procedures text-yellow"></i> Servicios
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('items.index') }}">
                        <i class="fas fa-prescription-bottle text-pink"></i> Productos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('categories.index') }}">
                        <i class="fas fa-cube text-warning"></i> Categorias
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>