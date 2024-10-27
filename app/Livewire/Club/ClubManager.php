<?php

namespace App\Livewire\Club;

use App\Models\Club;
use Livewire\Component;
use Livewire\WithPagination;

class ClubManager extends Component
{
    use WithPagination;

    public $name, $country, $city, $stadium_name, $founded_year, $manager;
    public $club_id;
    public $isEditing = false;
    public $confirmingDelete = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'stadium_name' => 'nullable|string|max:255',
        'founded_year' => 'nullable|integer|min:1800|max:' . PHP_INT_MAX,
        'manager' => 'nullable|string|max:255',
    ];

    public function render()
    {
        return view('livewire.club.club-manager', [
            'clubs' => Club::paginate(10)
        ])->layout('components.layouts.app');
    }

    public function create()
    {
        $this->validate();

        Club::create([
            'name' => $this->name,
            'country' => $this->country,
            'city' => $this->city,
            'stadium_name' => $this->stadium_name,
            'founded_year' => $this->founded_year,
            'manager' => $this->manager,
        ]);

        $this->resetFields();
        $this->dispatch('close-modal');
        session()->flash('message', 'Club created successfully.');
    }

    public function edit($id)
    {
        $this->isEditing = true;
        $this->club_id = $id;
        $club = Club::findOrFail($id);
        $this->name = $club->name;
        $this->country = $club->country;
        $this->city = $club->city;
        $this->stadium_name = $club->stadium_name;
        $this->founded_year = $club->founded_year;
        $this->manager = $club->manager;
    }

    public function update()
    {
        $this->validate();

        $club = Club::findOrFail($this->club_id);
        $club->update([
            'name' => $this->name,
            'country' => $this->country,
            'city' => $this->city,
            'stadium_name' => $this->stadium_name,
            'founded_year' => $this->founded_year,
            'manager' => $this->manager,
        ]);

        $this->resetFields();
        $this->dispatch('close-modal');
        session()->flash('message', 'Club updated successfully.');
    }

    public function confirmDelete($id)
    {
        $this->confirmingDelete = true;
        $this->club_id = $id;
    }

    public function delete()
    {
        Club::findOrFail($this->club_id)->delete();
        $this->confirmingDelete = false;
        $this->dispatch('close-modal');
        session()->flash('message', 'Club deleted successfully.');
    }

    private function resetFields()
    {
        $this->name = '';
        $this->country = '';
        $this->city = '';
        $this->stadium_name = '';
        $this->founded_year = null;
        $this->manager = '';
        $this->club_id = null;
        $this->isEditing = false;
        $this->confirmingDelete = false;
    }
}