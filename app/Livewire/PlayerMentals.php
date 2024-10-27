<?php

namespace App\Livewire;

use App\Models\Player;
use Livewire\Component;
use App\Models\Mental;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PlayerMentalExport;
use App\Imports\PlayerMentalImport;

class PlayerMentals extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $club = '';
    public $position = '';
    public $editingField = null;
    public $editingPlayerId = null;
    public $editingValue = '';
    protected $players;
    public $file;

    private $fields = [
        'leadership' => 'Leadership',
        'temperament' => 'Temperament',
        'error_handling' => 'Error Handling',
        'determination' => 'Determination',
        'team_work' => 'Team Work',
        'decision_making' => 'Decision Making',
        'concentration' => 'Concentration',
        'charisma' => 'Charisma',
    ];

    protected $listeners = ['valueUpdated' => '$refresh'];

    public function startEditing($playerId, $field)
    {
        $this->editingPlayerId = $playerId;
        $this->editingField = $field;
        $this->editingValue = $this->getCurrentValue($playerId, $field);
    }

    public function stopEditing()
    {
        $this->editingPlayerId = null;
        $this->editingField = null;
        $this->editingValue = '';
    }

    public function saveValue()
    {
        if (!$this->editingPlayerId || !$this->editingField) {
            return;
        }

        $this->validate([
            'editingValue' => 'required|numeric|min:0|max:100'
        ]);

        $mental = Mental::firstOrCreate(
            ['player_id' => $this->editingPlayerId],
            array_fill_keys(array_keys($this->fields), 0)
        );

        $mental->update([
            $this->editingField => $this->editingValue
        ]);

        $this->stopEditing();
        $this->dispatch('valueUpdated');
    }

    private function getCurrentValue($playerId, $field)
    {
        $mental = Mental::where('player_id', $playerId)->first();
        return $mental ? $mental->$field : 0;
    }

    // Excel Export
    public function exportToExcel()
    {
        return Excel::download(new PlayerMentalExport, 'player_mental_data.xlsx');
    }

    public function importFromExcel()
    {
        // Validate the file
        $this->validate([
            'file' => 'required|mimes:xlsx,xls', // Ensure the file is of the correct type
        ]);
    
        // Perform the import using the validated file
        Excel::import(new PlayerMentalImport, $this->file->getRealPath());
    
        // Dispatch the event to refresh data after import
        $this->dispatch('valueUpdated');
    
        // Flash success message
        session()->flash('message', 'Import successful!');
    }
    
    public function render()
    {
        $players = Player::query()
            ->when($this->search, function($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->club, function($query) {
                $query->where('club', $this->club);
            })
            ->when($this->position, function($query) {
                $query->where('position', $this->position);
            })
            ->paginate(15);

        $mentals = Mental::whereIn('player_id', $players->pluck('id'))
            ->get()
            ->keyBy('player_id');

        return view('livewire.player-mentals', [
            'players' => $players,
            'mentals' => $mentals,
            'fields' => $this->fields
        ]);
    }
}
