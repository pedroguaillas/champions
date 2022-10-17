<?php

namespace App\Http\Livewire;

use App\Models\Player;
use App\Models\Team;
use Livewire\Component;

class ListPlayers extends Component
{
    public $team, $player;

    protected $rules = [
        'player.cedula' => 'nullable',
        'player.first_name' => 'required',
        'player.last_name' => 'required',
        'player.t_shirt' => 'nullable',
        'player.phone' => 'nullable',
        'player.date_of_birth' => 'nullable'
    ];


    public function mount($team_id)
    {
        $this->team = Team::find($team_id);
    }

    protected $listeners = ['delete'];

    public function render()
    {
        $players = Player::where('team_id', $this->team->id)->get();

        return view('livewire.list-players', compact('players'))
            ->layout('layouts.adminlte')
            ->layoutData(['title' => 'Partidos']);
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
                $this->team->players()->create([
                    'cedula' => $this->player->cedula,
                    'first_name' => $this->player->first_name,
                    'last_name' => $this->player->last_name,
                    'date_of_birth' => $this->player->date_of_birth,
                    'champion_id' => $this->team->category->champion_id
                ]);
            }
            $this->emit('closeModal');
        }
    }

    public function delete(Player $player)
    {
        $player->delete();
    }
}
