<?php

namespace App\Http\Livewire;

use App\Models\Player;
use App\Models\Team;
use Livewire\Component;

class ListPlayers extends Component
{
    public $team_id, $player;

    protected $rules = [
        'player.cedula' => 'required',
        'player.first_name' => 'required',
        'player.last_name' => 'required'
    ];

    public function mount($team_id)
    {
        $this->team_id = $team_id;
    }

    public function render()
    {
        $players = Player::where('team_id', $this->team_id)->get();
        return view('livewire.list-players', compact('players'));
    }

    public function create()
    {
        $this->player = new Player();
        $this->emit('openModal');
    }

    public function edit(Player $player)
    {
        $this->player = $player;
        $this->emit('openModal');
    }

    public function update()
    {
        if ($this->validate()) {
            if (isset($this->player->id)) {
                $this->player->save();
            } else {
                $team = Team::find($this->team_id);
                $team->players()->create([
                    'cedula' => $this->player->cedula,
                    'first_name' => $this->player->first_name,
                    'last_name' => $this->player->last_name,
                    'champion_id' => $team->category->champion_id
                ]);
            }
            $this->emit('closeModal');
        }
    }
}
