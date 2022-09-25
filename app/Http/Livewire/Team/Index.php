<?php

namespace App\Http\Livewire\Team;

use App\Models\Team;
use Livewire\Component;

class Index extends Component
{

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $teams = Team::select('teams.*', 'c.name AS category_name')
            ->join('categories AS c', 'category_id', 'c.id')
            ->orderBy('teams.created_at', 'DESC')->get();
        return view(
            'livewire.team.index',
            compact('teams')
        )
            ->layout('layouts.adminlte')
            ->layoutData(['title' => 'Equipos']);
    }
}
