<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Team;
use Livewire\Component;

class ListTeams extends Component
{
    public $team;
    public $categories = [];

    protected $rules = [
        'team.name' => 'required',
        'team.address' => 'required',
        'team.category_id' => 'required|numeric',
        'team.paid' => 'nullable|numeric'
    ];

    public function mount()
    {
        $this->categories = Category::all();
    }

    protected $listeners = ['delete'];

    public function render()
    {
        $teams = Team::select('teams.*', 'c.name AS category_name')
            ->join('categories AS c', 'category_id', 'c.id')
            ->orderBy('teams.created_at', 'DESC')->get();

        return view(
            'livewire.list-teams',
            compact('teams')
        )
            ->layout('layouts.adminlte')
            ->layoutData(['title' => 'Equipos']);
    }

    public function create()
    {
        $this->team = new Team();
        $this->emit('openModal');
    }

    public function edit(Team $team)
    {
        $this->team = $team;
        $this->emit('openModal');
    }

    public function update()
    {
        if ($this->validate()) {
            if (isset($this->team->id)) {
                $this->team->save();
            } else {
                Team::create([
                    'name' => $this->team->name,
                    'address' => $this->team->address,
                    'category_id' => $this->team->category_id,
                    'paid' => $this->team->paid === '' || $this->team->paid === null ? 0 : $this->team->paid
                ]);
            }
            $this->emit('closeModal');
        }
    }

    public function delete(Team $team)
    {
        $team->delete();
    }
}
