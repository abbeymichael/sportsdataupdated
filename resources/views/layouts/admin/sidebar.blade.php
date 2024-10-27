<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Home -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}" wire:navigate>
                <i class="bi bi-house-door"></i>
                <span>Home</span>
            </a>
        </li>

        <!-- Clubs Section -->
        <li class="nav-heading">Clubs</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('clubs.index') ? 'active' : '' }}" href="{{ route('clubs.index') }}" wire:navigate>
                <i class="bi bi-people"></i> <!-- Replacing with a people icon -->
                <span>Clubs</span>
            </a>
        </li>

        <!-- Players Section -->
        <li class="nav-heading">Players</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ route('players.index') }}" wire:navigate>
                <i class="bi bi-person-badge"></i> <!-- Using a person icon to represent players -->
                <span>Players</span>
            </a>
        </li>

        <!-- Physical Data -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('physical.index') ? 'active' : '' }}" href="{{ route('physical.index') }}" wire:navigate>
                <i class="bi bi-heart-pulse"></i> <!-- Heart pulse icon for physical data -->
                <span>Physical Data</span>
            </a>
        </li>

        <!-- Technical Data -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('technical.index') ? 'active' : '' }}" href="{{ route('technical.index') }}" wire:navigate>
                <i class="bi bi-tools"></i> <!-- Tools icon for technical data -->
                <span>Technical Data</span>
            </a>
        </li>

        <!-- Tactical Data -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('tactical.index') ? 'active' : '' }}" href="{{ route('tactical.index') }}" wire:navigate>
                <i class="bi bi-compass"></i> <!-- Compass icon for tactical data -->
                <span>Tactical Data</span>
            </a>
        </li>

        <!-- Mental Data -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('mental.index') ? 'active' : '' }}" href="{{ route('mental.index') }}" wire:navigate>
                <i class="bi bi-head"></i> <!-- Brain icon for mental data -->
                <span>Mental Data</span>
            </a>
        </li>

    </ul>

    <!-- Fixed Settings Section -->
    <div class="settings">
        <ul class="settings-list">
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-gear"></i>
                    <span>Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-person-circle"></i> <!-- User icon for profile -->
                    <span>Profile</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
