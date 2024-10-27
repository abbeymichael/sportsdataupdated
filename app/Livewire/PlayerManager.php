<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Player;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PlayersImport;
use App\Exports\PlayersExport;

class PlayerManager extends Component
{
    use WithFileUploads, WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $dob, $height, $weight, $position, $preferred_foot, $club_id, $image;
    public $player_id;
    public $isEditing = false;
    public $confirmingDelete = false;
    public $importFile;

    protected $rules = [
        'name' => 'required|string|max:255',
        'dob' => 'required|date',
        'height' => 'required|numeric',
        'weight' => 'required|numeric',
        'position' => 'required|string|max:50',
        'preferred_foot' => 'required|in:left,right',
        'club_id' => 'required|exists:clubs,id',
        'image' => 'nullable|image|max:1024',
    ];

    public function render()
    {
        return view('livewire.player-manager', [
            'players' => Player::paginate(10)
        ]);
    }

    public function create()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'dob' => $this->dob,
            'height' => $this->height,
            'weight' => $this->weight,
            'position' => $this->position,
            'preferred_foot' => $this->preferred_foot,
            'club_id' => $this->club_id,
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('players', 'public');
        }

        Player::create($data);
        $this->resetFields();
        $this->dispatch('close-modal');
        session()->flash('message', 'Player created successfully.');
    }

    public function edit($id)
    {
        $this->isEditing = true;
        $this->player_id = $id;
        $player = Player::findOrFail($id);
        
        $this->name = $player->name;
        $this->dob = $player->dob;
        $this->height = $player->height;
        $this->weight = $player->weight;
        $this->position = $player->position;
        $this->preferred_foot = $player->preferred_foot;
        $this->club_id = $player->club_id;
    }

    public function update()
    {
        $this->validate();
    
        $player = Player::findOrFail($this->player_id);
        
        $data = [
            'name' => $this->name,
            'dob' => $this->dob,
            'height' => $this->height,
            'weight' => $this->weight,
            'position' => $this->position,
            'preferred_foot' => $this->preferred_foot,
            'club_id' => $this->club_id,
        ];
    
        if ($this->image) {
            if ($player->image) {
                Storage::delete($player->image);
            }
            // Store the image in the public disk
            $data['image'] = $this->image->store('players', 'public');
        }
    
        $player->update($data);
        $this->resetFields();
        $this->dispatch('close-modal');
        session()->flash('message', 'Player updated successfully.');
    }
    

    public function confirmDelete($id)
    {
        $this->confirmingDelete = true;
        $this->player_id = $id;
    }

    public function delete()
    {
        $player = Player::findOrFail($this->player_id);
        if ($player->image) {
            Storage::delete($player->image);
        }
        $player->delete();
        $this->confirmingDelete = false;
        $this->dispatch('close-modal');
        session()->flash('message', 'Player deleted successfully.');
    }

    public function importPlayers()
    {
        $this->validate([
            'importFile' => 'required|mimes:xlsx,xls',
        ]);

        try {
            Excel::import(new PlayersImport, $this->importFile->getRealPath());
            $this->importFile = null;
            session()->flash('message', 'Players imported successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'Error importing players: ' . $e->getMessage());
        }
    }

    public function exportPlayers()
    {
        return Excel::download(new PlayersExport, 'players.xlsx');
    }

    public function resetFields()
    {
        $this->name = '';
        $this->dob = '';
        $this->height = '';
        $this->weight = '';
        $this->position = '';
        $this->preferred_foot = '';
        $this->club_id = '';
        $this->image = null;
        $this->player_id = null;
        $this->isEditing = false;
        $this->confirmingDelete = false;
    }

}