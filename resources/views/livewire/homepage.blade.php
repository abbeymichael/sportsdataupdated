<div>
    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-title">Scout Smart, <span class="accent-text">Play</span> Strong!</h1>
            <p class="lead mt-4 mb-5" style="font-size: 1.2rem; font-weight: 400; color: rgba(255, 255, 255, 0.8);">
                Dive into detailed player statistics, compare your favorite stars, and uncover the hidden gems of the beautiful game with ease.
            </p>
           
            <div class="search-container relative">
                <input 
                    wire:model.live="search"
                    type="text" 
                    class="form-control search-input" 
                    placeholder="Search players by name or club...">
                <div class="mt-3">
                    <a href="#" class="advanced-search">
                        <i class="fas fa-sliders-h me-2"></i>Advanced search
                    </a>
                </div>

                <!-- Search Results Dropdown -->
                @if($isSearching)
                    <div class="search-results-container">
                        @if($searchResults->isEmpty())
                            <div class="no-results">
                                No players found matching "{{ $search }}"
                            </div>
                        @else
                            <div class="search-results-grid">
                                @foreach($searchResults as $player)
                                <a href="{{ route('player.show', $player) }}" class="search-result-card">
                                    <div class="card-image">
                                        <img 
                                            src="{{ $player->image ? asset('storage/' . $player->image) : 'https://placehold.co/120x120' }}" 
                                            alt="{{ $player->name }}"
                                        >
                                    </div>
                                    <div class="card-content">
                                        <h4 class="player-name">{{ $player->name }}</h4>
                                        <span class="club-name">{{ $player->club->name }}</span>
                                    </div>
                                </a>
                            @endforeach
                            
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Featured Players Showcase - Always Visible -->
            <div class="mt-5">
                <h2 class="text-2xl font-semibold mb-4">Featured Players</h2>
                <div class="row g-4 justify-content-center">
                    @foreach ($featuredPlayers as $player)
                    <div class="col-md-2" wire:key="featured-{{ $player->id }}">
                        <div class="player-card text-center">
                            <a href="{{ route('player.show', $player) }}" class="text-decoration-none text-white">
                                <img 
                                    src="{{ $player->image ? asset('storage/' . $player->image) : 'https://placehold.co/56x56' }}" 
                                    class="player-image" 
                                    alt="{{ $player->name }}"
                                >
                                <h6 class="player-name">{{ $player->name }}</h6>
                                <p class="player-team">{{ $player->club->name }}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
                
                
                </div>
            </div>
        </div>
    </section>

    <!-- Key Features Section -->
    <section class="feature-section bg-darker">
        <div class="container">
            <h2 class="section-title">Key Features</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <h3 class="feature-title">Advanced Player Comparison</h3>
                        <p class="feature-text">Compare up to three players across various templates and metrics.</p>
                        <small class="text-muted fw-500">Compare 6,000+ players</small>
                        <a href="#" class="btn btn-link text-info ps-0">Learn More</a>
                    </div>
                </div>
                <!-- Repeat for other features -->
            </div>
        </div>
    </section>

    <!-- Footer -->
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h4 class="footer-title">ADVANCED SCOUTING TOOLS</h4>
                    <a href="#" class="footer-link">ScatterScout</a>
                    <a href="#" class="footer-link">Advanced Search Engine</a>
                    <a href="#" class="footer-link">Player Comparison</a>
                </div>
                <!-- Repeat for other footer sections -->
            </div>
        </div>
    </footer>

    <div wire:loading wire:target="search" 
    class="absolute right-4 top-4">
   <div class="animate-spin rounded-full h-5 w-5 border-b-2 border-white"></div>
</div>
</div>