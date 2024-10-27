<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link
      href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css') }}"
      rel="stylesheet"
    />
    <link
      href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css') }}"
      rel="stylesheet"
    />
    <link
      href="{{ asset('assets/css/style.css') }}"
      rel="stylesheet"
    />
  
     @livewireStyles
  </head>
  <body>
    <!-- Sidebar -->
   <!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="logo">
        <i class="bi bi-circle-fill"></i> Level Up
        <button id="sidebarClose" class="btn btn-link d-md-none ms-auto">
            <i class="bi bi-x"></i>
        </button>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{ request()->is('home') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i>
                Home
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('clubs.index') }}" class="nav-link {{ request()->is('clubs*') ? 'active' : '' }}">
                <i class="bi bi-house me-2"></i>
                Clubs
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('players.index') }}" class="nav-link {{ request()->is('players*') ? 'active' : '' }}">
                <i class="bi bi-person-circle me-2"></i>
                Players
            </a>
        </li>
      
    </ul>
</div>


    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay"></div>

    <!-- Main content -->
    <div class="main-content" id="main-content">
      <header class="header" id="header">
        <div class="container-fluid">
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <button
                id="sidebarToggleMobile"
                class="btn btn-link d-md-none me-2"
              >
                <i class="bi bi-list"></i>
              </button>
              <div class="mobile-logo d-md-none">
                <i class="bi bi-circle-fill"></i> Level Up
              </div>
              <input
                type="text"
                class="search-input d-none d-md-block"
                placeholder="Filter by name or description..."
              />
            </div>
            <div class="d-none d-md-flex align-items-center">
              <a href="#" class="nav-icon me-3"><i class="bi bi-bell"></i></a>
              <a href="#" class="nav-icon me-3"
                ><i class="bi bi-plus-circle"></i
              ></a>
              <a href="#" class="nav-icon"
                ><i class="bi bi-person-circle"></i
              ></a>
            </div>
          </div>
        </div>
      </header>

      <div style="padding-top: 70px">
       @yield('content')
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // Your JavaScript code for sidebar toggle
      const sidebar = document.getElementById("sidebar");
      const sidebarToggleMobile = document.getElementById("sidebarToggleMobile");
      const sidebarClose = document.getElementById("sidebarClose");
      const overlay = document.getElementById("overlay");
      const mainContent = document.getElementById("main-content");
      const header = document.getElementById("header");

      function toggleSidebar() {
        sidebar.classList.toggle("active");
        overlay.classList.toggle("active");
        mainContent.classList.toggle("active");
        header.classList.toggle("active");
      }

      sidebarToggleMobile.addEventListener("click", toggleSidebar);
      sidebarClose.addEventListener("click", toggleSidebar);
      overlay.addEventListener("click", toggleSidebar);

      // Adjust layout for desktop
      function adjustLayout() {
        if (window.innerWidth > 768) {
          sidebar.classList.remove("active");
          overlay.classList.remove("active");
          mainContent.classList.remove("active");
          header.classList.remove("active");
        }
      }

      window.addEventListener("resize", adjustLayout);
      adjustLayout(); // Call on page load
    </script>
    @livewireScripts
  </body>
</html>
