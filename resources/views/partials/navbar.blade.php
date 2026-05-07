<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="{{ url('/') }}">
      <i class="bi bi-shop me-2"></i>Dapur Takjil
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
            <i class="bi bi-house-door me-1"></i>Beranda
          </a>
        </li>
        
        @if(Auth::check() && Auth::user()->role === 'admin')
          <li class="nav-item">
            <a class="nav-link {{ request()->is('kelola') ? 'active' : '' }}" href="{{ url('/kelola') }}">
              <i class="bi bi-clipboard-data me-1"></i>Kelola Data
            </a>
          </li>
        @endif

        @auth
          <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
            <button class="btn btn-warning btn-sm position-relative" data-bs-toggle="modal" data-bs-target="#modalRencana">
              <i class="bi bi-cart-plus"></i> Rencana
              <span id="badgeRencana" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
            </button>
          </li>
        @endauth

        <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
          <button id="btnTema" class="btn btn-outline-light btn-sm">
            <i class="bi bi-moon-fill" id="ikonTema"></i>
          </button>
        </li>

        @auth
          <li class="nav-item ms-lg-3 me-lg-3 mt-2 mt-lg-0 d-flex align-items-center">
            <a href="{{ route('profile.edit') }}" class="text-white fw-medium text-decoration-none d-flex align-items-center">
              
              @if(Auth::user()->profile_image)
                  <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" alt="Avatar" class="rounded-circle me-2" style="width: 25px; height: 25px; object-fit: cover;">
              @else
                  <i class="bi bi-person-circle me-2"></i>
              @endif
              Hai, {{ Auth::user()->name }}!

            </a>
          </li>
          <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
            <form action="{{ route('logout') }}" method="POST" class="d-inline m-0 p-0">
              @csrf
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin keluar?');">
                <i class="bi bi-box-arrow-right"></i> Logout
              </button>
            </form>
          </li>
        @endauth

        @guest
          <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-warning btn-sm">Register</a>
          </li>
        @endguest

      </ul>
    </div>
  </div>
</nav>