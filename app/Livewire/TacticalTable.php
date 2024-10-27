<?php

namespace App\Livewire;

use App\Models\Player;
use Livewire\Component;
use App\Models\Tactical; // Import the Tactical model
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PlayerTacticalExport; // Import your export class
use App\Imports\PlayerTacticalImport; // Import your import class

class TacticalTable extends Component
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

    // Define tactical fields and their abbreviations
    private $fields = [
        'vision' => 'VIS',
        'positioning' => 'POS',
        'ability_to_loose_marker' => 'ALM',
        'counter_attack' => 'CTA',
        'unpredictability' => 'UNP',
        'read_the_game' => 'RTG',
        'space_creation' => 'SC',
        'tactical_awareness' => 'TA',
        'support_play' => 'SP',
        'creativity' => 'CRE',
        'defensive_ability' => 'DEF',
        'receive_ball_under_pressure' => 'RBP'
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
            'editingValue' => 'required|numeric|min:1|max:10' // Assuming ratings are 1-10
        ]);

        $tactical = Tactical::firstOrCreate(
            ['player_id' => $this->editingPlayerId],
            array_fill_keys(array_keys($this->fields), 0) // Default values
        );

        $tactical->update([
            $this->editingField => $this->editingValue
        ]);

        $this->stopEditing();
        $this->dispatch('valueUpdated');
    }

    private function getCurrentValue($playerId, $field)
    {
        $tactical = Tactical::where('player_id', $playerId)->first();
        return $tactical ? $tactical->$field : 0;
    }

    // Excel Export
    public function exportToExcel()
    {
        return Excel::download(new PlayerTacticalExport, 'player_tactical_data.xlsx');
    }

    public function importFromExcel()
    {
        // Validate the file
        $this->validate([
            'file' => 'required|mimes:xlsx,xls', // Ensure the file is of the correct type
        ]);

        // Perform the import using the validated file
        Excel::import(new PlayerTacticalImport, $this->file->getRealPath());

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

        $tacticals = Tactical::whereIn('player_id', $players->pluck('id'))
            ->get()
            ->keyBy('player_id');

        return view('livewire.tactical-table', [
            'players' => $players,
            'tacticals' => $tacticals,
            'fields' => $this->fields
        ]);
    }
}
