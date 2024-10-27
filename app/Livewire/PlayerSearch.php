<?php

namespace App\Livewire;

use App\Models\Player;
use Livewire\Component;

class PlayerSearch extends Component
{
    public $search = '';
    public $isSearching = false;

    public function updatedSearch($value)
    {
        $this->isSearching = !empty($value);
    }

    public function render()
    {
        $searchResults = Player::where('name', 'like', '%' . $this->search . '%')->get();

        return view('livewire.player-search', [
            'searchResults' => $searchResults,
            'isSearching' => $this->isSearching,
        ]);
    }
}