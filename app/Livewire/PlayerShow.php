<?php

namespace App\Livewire;

use App\Models\Player;
use Livewire\Component;

class PlayerShow extends Component
{
    public Player $player;
    public $tacticalData = [];
    public $technicalData = [];

    protected $rules = [
        'tacticalData.*' => 'nullable|integer|min:0|max:100',
        'technicalData.*' => 'nullable|integer|min:0|max:100',
    ];

    public function mount(Player $player)
    {
        $this->player = $player;
      
        $this->tacticalData = $player->tactical_data ?? [
            'positioning' => 0,
            'vision' => 0,
            'work_rate' => 0,
            'leadership' => 0,
        ];
        $this->technicalData = $player->technical_data ?? [
            'passing' => 0,
            'shooting' => 0,
            'dribbling' => 0,
            'tackling' => 0,
        ];
    }

    public function render()
    {
        return view('livewire.player-show')->layout('components.layouts.app');
    }

    public function updateTacticalData()
    {
        $this->validate();
        $this->player->tactical_data = $this->tacticalData;
        $this->player->save();
        session()->flash('message', 'Tactical data updated successfully.');
    }

    public function updateTechnicalData()
    {
        $this->validate();
        $this->player->technical_data = $this->technicalData;
        $this->player->save();
        session()->flash('message', 'Technical data updated successfully.');
    }
}