<?php

namespace App\Livewire;

use App\Models\Player;
use Livewire\Component;
use App\Models\Technical;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PlayerTechnicalExport;
use App\Imports\PlayerTechnicalImport;

class TechnicalTable extends Component
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
        'technique' => 'TEC',
        'dribbling' => 'DRI',
        'using_both_feet' => 'UBF',
        'ball_control' => 'BCT',
        'long_shots' => 'LSH',
        'pass_forward' => 'PFW',
        'pass_sideways' => 'PSW',
        'pass_backwards' => 'PBW',
        'crossing' => 'CRS',
        'long_throws' => 'LTH',
        'heading' => 'HED',
        'finishing' => 'FIN',
        'play_under_pressure' => 'PUP'
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

        $technical = Technical::firstOrCreate(
            ['player_id' => $this->editingPlayerId],
            array_fill_keys(array_keys($this->fields), 0)
        );

        $technical->update([
            $this->editingField => $this->editingValue
        ]);

        $this->stopEditing();
        $this->dispatch('valueUpdated');
    }

    private function getCurrentValue($playerId, $field)
    {
        $technical = Technical::where('player_id', $playerId)->first();
        return $technical ? $technical->$field : 0;
    }

    // Excel Export
    public function exportToExcel()
    {
        return Excel::download(new PlayerTechnicalExport, 'player_technical_data.xlsx');
    }

    public function importFromExcel()
    {
        // Validate the file
        $this->validate([
            'file' => 'required|mimes:xlsx,xls', // Ensure the file is of the correct type
        ]);
    
        // Perform the import using the validated file
        Excel::import(new PlayerTechnicalImport, $this->file->getRealPath());
    
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

        $technicals = Technical::whereIn('player_id', $players->pluck('id'))
            ->get()
            ->keyBy('player_id');

        return view('livewire.technical-table', [
            'players' => $players,
            'technicals' => $technicals,
            'fields' => $this->fields
        ]);
    }
}
