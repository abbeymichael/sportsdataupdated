<div>
    <input type="search" class="search-bar" placeholder="Search players..." wire:model.live="search">

  

    @if($isSearching)
    <div class="search-container1">
        <div class="search-results-container1">
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
    </div>
    @endif
   
</div>
