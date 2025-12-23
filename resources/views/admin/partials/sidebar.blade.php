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

      <li class="sidebar-item {{ request()->routeIs('admin.home') ? 'active' : '' }}">
        <a href="{{ route('admin.home') }}" class="sidebar-link">
          <i class="bi bi-house-door icon-24"></i>
          <span class="sidebar-text">Home</span>
        </a>
      </li>

      <li class="sidebar-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
        <a href="{{ route('admin.products.index') }}" class="sidebar-link">
          <i class="bi bi-box-seam icon-24"></i>
          <span class="sidebar-text">Productos</span>
        </a>
      </li>

      <li class="sidebar-item {{ request()->routeIs('admin.sections.nutrition.*') ? 'active' : '' }}">
        <a href="{{ route('admin.sections.nutrition.index') }}" class="sidebar-link">

          @if(isset($sidebarSections['nutricion']) && $sidebarSections['nutricion']->icon_url)
            <img src="{{ $sidebarSections['nutricion']->icon_url }}"
                alt="{{ $sidebarSections['nutricion']->icon_alt }}"
                class="icon-24">
          @else
            <i class="bi bi-box-seam icon-24"></i>
          @endif

          <span class="sidebar-text">Nutrición</span>
        </a>
      </li>

      <li class="sidebar-item {{ request()->routeIs('admin.sections.sanidad.*') ? 'active' : '' }}">
        <a href="{{ route('admin.sections.sanidad.index') }}" class="sidebar-link">
          
          @if(isset($sidebarSections['sanidad']) && $sidebarSections['sanidad']->icon_url)
            <img src="{{ $sidebarSections['sanidad']->icon_url }}"
                alt="{{ $sidebarSections['sanidad']->icon_alt }}"
                class="icon-24">
          @else
            <i class="bi bi-box-seam icon-24"></i>
          @endif

          <span class="sidebar-text">Sanidad</span>
        </a>
      </li>

      <li class="sidebar-item {{ request()->routeIs('admin.sections.hacienda.*') ? 'active' : '' }}">
        <a href="{{ route('admin.sections.hacienda.index') }}" class="sidebar-link">
          
          @if(isset($sidebarSections['hacienda']) && $sidebarSections['hacienda']->icon_url)
            <img src="{{ $sidebarSections['hacienda']->icon_url }}"
                alt="{{ $sidebarSections['hacienda']->icon_alt }}"
                class="icon-24">
          @else
            <i class="bi bi-box-seam icon-24"></i>
          @endif

          <span class="sidebar-text">Hacienda</span>
        </a>
      </li>

      <li class="sidebar-item {{ request()->routeIs('admin.sections.production.*') ? 'active' : '' }}">
        <a href="{{ route('admin.sections.production.index') }}" class="sidebar-link">
          
          @if(isset($sidebarSections['produccion']) && $sidebarSections['produccion']->icon_url)
            <img src="{{ $sidebarSections['produccion']->icon_url }}"
                alt="{{ $sidebarSections['produccion']->icon_alt }}"
                class="icon-24">
          @else
            <i class="bi bi-box-seam icon-24"></i>
          @endif

          <span class="sidebar-text">Producción</span>
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
    <li class="sidebar-item {{ request()->routeIs('admin.configuration.*') ? 'active' : '' }}">
      <a href="{{ route('admin.configuration.index') }}" class="sidebar-footer-link">
        <i class="bi bi-gear icon-24"></i>
        <span class="sidebar-text">Configuración</span>
      </a>
    </li>

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
