<?php

namespace App\Http\Livewire;

use App\Models\Game;
use App\Models\Player;
use App\Models\Sanction;
use App\Models\Team;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $teams = Team::all()->count();
        $games = Game::all()->count();
        $players = Player::all()->count();
        $sanctions = Sanction::all()->count();

        return view('livewire.dashboard', compact('teams', 'games', 'players', 'sanctions'))
            ->layout('layouts.adminlte')
            ->layoutData(['title' => 'Copa Wikis']);
    }
}
