<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fas fa-car me-2"></i>
            AutoRent
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="fas fa-home me-1"></i>Accueil
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('vehicles.index') }}">
                        <i class="fas fa-car me-1"></i>Nos véhicules
                    </a>
                </li>
                @auth
                    @if(!Auth::user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reservations.index') }}">
                                <i class="fas fa-calendar-check me-1"></i>Mes réservations
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>
            
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i>Connexion
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light btn-sm ms-2" href="{{ route('register') }}">
                            <i class="fas fa-user-plus me-1"></i>Inscription
                        </a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" 
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                <i class="fas fa-user text-primary"></i>
                            </div>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end shadow-lg border-0" aria-labelledby="navbarDropdown">
                            <div class="dropdown-header">
                                <strong>{{ Auth::user()->name }}</strong>
                                <br><small class="text-muted">{{ Auth::user()->email }}</small>
                            </div>
                            <div class="dropdown-divider"></div>
                            
                            <a class="dropdown-item" href="{{ route('profile.show') }}">
                                <i class="fas fa-user me-2"></i>Mon profil
                            </a>
                            
                            @if(Auth::user()->is_admin)
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-2"></i>Tableau de bord
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.vehicles.index') }}">
                                    <i class="fas fa-car me-2"></i>Gérer les véhicules
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.reservations.index') }}">
                                    <i class="fas fa-calendar me-2"></i>Gérer les réservations
                                </a>
                                <a class="dropdown-item" href="{{ route('admin.users.index') }}">
                                    <i class="fas fa-users me-2"></i>Gérer les utilisateurs
                                </a>
                            @endif
                            
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
