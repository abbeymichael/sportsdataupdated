<?php

namespace App\Livewire;

use App\Models\Player;
use App\Models\Physical;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PlayerPhysicalExport;
use App\Imports\PlayerPhysicalImport;

class PhysicalTable extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $club = '';
    public $position = '';
    public $editingField = null;
    public $editingPlayerId = null;
    public $editingValue = '';
    public $file;

    // Define physical fields and their abbreviations
    private $fields = [
        'aggression' => 'AGG',
        'strength' => 'STR',
        'explosiveness' => 'EXP',
        'power' => 'POW',
        'change_of_pace' => 'COP',
        'ball_protection' => 'BP',
        'jumping' => 'JMP',
        'stamina' => 'STA',
        'aerobic_capacity' => 'AC',
        'speed' => 'SPD',
        'agility' => 'AGI',
        'balance' => 'BAL',
        'acceleration' => 'ACC',
        'repeated_sprint_ability' => 'RSA'
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

        $physical = Physical::firstOrCreate(
            ['player_id' => $this->editingPlayerId],
            array_fill_keys(array_keys($this->fields), 0) // Default values
        );

        $physical->update([$this->editingField => $this->editingValue]);

        $this->stopEditing();
        $this->dispatch('valueUpdated');
    }

    private function getCurrentValue($playerId, $field)
    {
        $physical = Physical::where('player_id', $playerId)->first();
        return $physical ? $physical->$field : 0;
    }

    public function exportToExcel()
    {
        return Excel::download(new PlayerPhysicalExport, 'player_physical_data.xlsx');
    }

    public function importFromExcel()
    {
        // Validate the file
        $this->validate(['file' => 'required|mimes:xlsx,xls']);

        // Perform the import using the validated file
        Excel::import(new PlayerPhysicalImport, $this->file->getRealPath());

        // Dispatch the event to refresh data after import
        $this->dispatch('valueUpdated');

        // Flash success message
        session()->flash('message', 'Import successful!');
    }

    public function render()
    {
        $players = Player::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->club, function ($query) {
                $query->where('club', $this->club);
            })
            ->when($this->position, function ($query) {
                $query->where('position', $this->position);
            })
            ->paginate(15);

        $physicals = Physical::whereIn('player_id', $players->pluck('id'))->get()->keyBy('player_id');

        return view('livewire.physical-table', [
            'players' => $players,
            'physicals' => $physicals,
            'fields' => $this->fields
        ]);
    }
}
