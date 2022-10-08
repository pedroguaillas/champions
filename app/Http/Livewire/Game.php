<?php

namespace App\Http\Livewire;

use App\Models\Game as ModelsGame;
use Livewire\Component;

class Game extends Component
{
    public $game;

    public function mount($game_id)
    {
        $this->game = ModelsGame::select('games.id', 't1.name AS t1name', 't2.name AS t2name')
            ->join('teams AS t1', 'games.team1_id', 't1.id')
            ->join('teams AS t2', 'games.team2_id', 't2.id')
            ->where('games.id', $game_id)
            ->first();
    }

    public function render()
    {
        return view('livewire.game')
            ->layout('layouts.adminlte')
            ->layoutData(['title' => 'Partido']);
    }
}
