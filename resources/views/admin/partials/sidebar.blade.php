<aside class="sidebar" id="sidebar">

  <div class="sidebar-logo d-none d-lg-flex">
    <img src="{{ asset('assets/admin/img/aca-iso.svg') }}" alt="ACA Ganadería" class="sidebar-logo-img">
  </div>

  <button class="sidebar-toggle d-none d-lg-flex" id="sidebarToggle" aria-label="Toggle Sidebar">
    <i class="bi bi-chevron-left"></i>
  </button>

  <div class="sidebar-mobile-header d-lg-none">
    <img src="{{ asset('assets/admin/img/aca-iso.svg') }}" alt="ACA Ganadería Logo" class="sidebar-logo-img">
    <button type="button" class="btn-close btn-close-white" id="sidebarClose" aria-label="Close"></button>
  </div>

  <nav class="sidebar-nav">
    <ul class="sidebar-menu">

      <li class="sidebar-item {{ request()->routeIs('admin.home.*') ? 'active' : '' }}">
        <a href="{{ route('admin.home') }}" class="sidebar-link">
          <i class="bi bi-house-door icon-24"></i>
          <span class="sidebar-text">Home</span>
        </a>
      </li>

      <li class="sidebar-item {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
        <a href="{{ route('admin.reports.index') }}" class="sidebar-link">
          <i class="bi bi-file-earmark-text icon-24"></i>
          <span class="sidebar-text">Informes</span>
        </a>
      </li>

      <li class="sidebar-item">
        <a href="#" class="sidebar-link">
          <i class="bi bi-people icon-24"></i>
          <span class="sidebar-text">Usuarios</span>
        </a>
      </li>
    </ul>
  </nav>

  <div class="sidebar-footer">
    <a href="#" class="sidebar-footer-link">
      <i class="bi bi-gear icon-24"></i>
      <span class="sidebar-text">Configuración</span>
    </a>

    <form class="sidebar-footer-link" method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="sidebar-footer-link btn btn-link p-0 text-start">
        <i class="bi bi-box-arrow-right icon-24"></i>
        <span class="sidebar-text">Salir</span>
      </button>
    </form>

    <div class="sidebar-user">
      <div class="sidebar-user-avatar">
        <div class="avatar-placeholder">
          {{ strtoupper(mb_substr(auth()->user()->name ?? 'U', 0, 1)) }}
        </div>
      </div>
      <div class="sidebar-user-info">
        <div class="sidebar-user-name">{{ auth()->user()->name ?? '' }}</div>
        <div class="sidebar-user-role">{{ (auth()->user()?->is_admin ?? false) ? 'Admin' : 'Usuario' }}</div>
      </div>
    </div>
  </div>

</aside>
