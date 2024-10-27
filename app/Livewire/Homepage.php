<?php

namespace App\Livewire;

use App\Models\Player;
use Livewire\Component;

class Homepage extends Component
{
    public $search = '';
    public $searchResults = [];
    public $isSearching = false;

    public function updatedSearch($value)
    {
        $this->isSearching = strlen($value) > 0;

        if ($this->isSearching) {
            $this->searchResults = Player::query()
                ->where(function ($query) use ($value) {
                    $query->where('name', 'like', '%' . $value . '%')
                        ->orWhereHas('club', function ($query) use ($value) {
                            $query->where('name', 'like', '%' . $value . '%');
                        });
                })
                ->with('club')
                ->limit(8)
                ->get();
        } else {
            $this->searchResults = collect([]);
        }
    }

    public function getFeaturedPlayersProperty()
    {
        return Player::query()
            ->with('club')
            ->inRandomOrder()
            ->limit(6)
            ->get();
    }

    public function render()
    {
        return view('livewire.homepage', [
            'featuredPlayers' => $this->featuredPlayers,
        ]);
    }
}