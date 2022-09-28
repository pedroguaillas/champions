<?php

namespace App\Http\Livewire;

use App\Models\Player;
use Livewire\Component;

class ListPlayers extends Component
{
    public $team_id;

    public function mount($team_id)
    {
        $this->team_id = $team_id;
    }

    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $players = Player::where('team_id', $this->team_id)->get();
        return view('livewire.list-players', compact('players'));
    }
}
