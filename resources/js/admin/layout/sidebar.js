export default function initSidebar() {
  const STORAGE_KEY = 'aca-admin-sidebar-collapsed';
  const BREAKPOINT_LG = 992;

  const sidebar = document.getElementById('sidebar');
  const sidebarToggle = document.getElementById('sidebarToggle');
  const sidebarOverlay = document.getElementById('sidebarOverlay');
  const mainContent = document.querySelector('.main-content');

  if (!sidebar) return;

  // ---------------------------------------------------------------------------
  // State Management
  // ---------------------------------------------------------------------------

  function getSidebarState() {
    const stored = localStorage.getItem(STORAGE_KEY);
    return stored === 'true';
  }

  function saveSidebarState(isCollapsed) {
    localStorage.setItem(STORAGE_KEY, isCollapsed.toString());
  }

  function isMobile() {
    return window.innerWidth < BREAKPOINT_LG;
  }

  // ---------------------------------------------------------------------------
  // Sidebar Toggle Functions
  // ---------------------------------------------------------------------------

  function toggleSidebar() {
    if (isMobile()) return;

    const isCollapsed = sidebar.classList.toggle('collapsed');
    saveSidebarState(isCollapsed);
  }

  function toggleMobileSidebar() {
    if (!isMobile()) return;

    sidebar.classList.toggle('active');
    sidebarOverlay.classList.toggle('active');

    if (sidebar.classList.contains('active')) {
      document.body.style.overflow = 'hidden';
    } else {
      document.body.style.overflow = '';
    }
  }

  function closeMobileSidebar() {
    if (!isMobile()) return;

    sidebar.classList.remove('active');
    sidebarOverlay.classList.remove('active');
    document.body.style.overflow = '';
  }

  function initializeSidebar() {
    if (isMobile()) {
      sidebar.classList.remove('collapsed', 'active');
      sidebarOverlay.classList.remove('active');
      document.body.style.overflow = '';
    } else {
      const isCollapsed = getSidebarState();
      if (isCollapsed) {
        sidebar.classList.add('collapsed');
      } else {
        sidebar.classList.remove('collapsed');
      }
    }
  }

  // ---------------------------------------------------------------------------
  // Event Listeners
  // ---------------------------------------------------------------------------

  if (sidebarToggle) {
    sidebarToggle.addEventListener('click', function(e) {
      e.preventDefault();
      toggleSidebar();
    });
  }

  if (sidebarOverlay) {
    sidebarOverlay.addEventListener('click', function() {
      closeMobileSidebar();
    });
  }

  // Mobile close button
  const sidebarClose = document.getElementById('sidebarClose');
  if (sidebarClose) {
    sidebarClose.addEventListener('click', function() {
      closeMobileSidebar();
    });
  }

  function createMobileMenuButton() {
    if (isMobile() && mainContent) {
      const header = mainContent.querySelector('header');
      if (header && !header.querySelector('.mobile-menu-btn')) {
        const menuBtn = document.createElement('button');
        menuBtn.className = 'mobile-menu-btn';
        menuBtn.setAttribute('aria-label', 'Abrir menú');
        menuBtn.innerHTML = '<i class="bi bi-list"></i>';
        menuBtn.addEventListener('click', toggleMobileSidebar);

        header.insertBefore(menuBtn, header.firstChild);
      }
    }
  }

  function removeMobileMenuButton() {
    const menuBtn = document.querySelector('.mobile-menu-btn');
    if (menuBtn && !isMobile()) {
      menuBtn.remove();
    }
  }

  let resizeTimeout;
  window.addEventListener('resize', function() {
    clearTimeout(resizeTimeout);
    resizeTimeout = setTimeout(function() {
      initializeSidebar();

      if (isMobile()) {
        createMobileMenuButton();
      } else {
        removeMobileMenuButton();
      }
    }, 250);
  });

  const sidebarLinks = sidebar.querySelectorAll('.sidebar-link, .sidebar-footer-link');
  sidebarLinks.forEach(function(link) {
    link.addEventListener('click', function() {
      if (isMobile()) {
        setTimeout(closeMobileSidebar, 100);
      }
    });
  });

  // ---------------------------------------------------------------------------
  // Active Link Highlighting
  // ---------------------------------------------------------------------------

  function highlightActiveLink() {
    const currentPath = window.location.pathname;
    const currentPage = currentPath.split('/').pop() || 'index.html';

    // Remove active class from sidebar items
    document.querySelectorAll('.sidebar-item').forEach(function(item) {
      item.classList.remove('active');
    });

    // Remove active class from sidebar footer links
    document.querySelectorAll('.sidebar-footer-link').forEach(function(link) {
      link.classList.remove('active');
    });

    // Check for active link in sidebar items
    const activeSidebarLink = document.querySelector('.sidebar-link[href="' + currentPage + '"]');
    if (activeSidebarLink) {
      activeSidebarLink.closest('.sidebar-item').classList.add('active');
    }

    // Check for active link in sidebar footer
    const activeFooterLink = document.querySelector('.sidebar-footer-link[href="' + currentPage + '"]');
    if (activeFooterLink) {
      activeFooterLink.classList.add('active');
    }
  }

  // ---------------------------------------------------------------------------
  // Initialization
  // ---------------------------------------------------------------------------

  document.addEventListener('DOMContentLoaded', function() {
    initializeSidebar();
    highlightActiveLink();

    if (isMobile()) {
      createMobileMenuButton();
    }
  });

  // ---------------------------------------------------------------------------
  // Keyboard Navigation
  // ---------------------------------------------------------------------------

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && isMobile() && sidebar.classList.contains('active')) {
      closeMobileSidebar();
    }
  });
}
