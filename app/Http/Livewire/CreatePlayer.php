<?php

namespace App\Http\Livewire;

use App\Models\Team;
use Livewire\Component;

class CreatePlayer extends Component
{
    public $team_id;
    public $cedula, $first_name, $last_name;

    protected $rule = [
        'cedula' => 'required',
        'first_name' => 'required',
        'last_name' => 'required'
    ];

    // esto es mas o menos como el constructor del componente
    public function mount()
    {
        // si ves esto es como que inicia las variables
        $this->cedula = '';
        $this->first_name = '';
        $this->last_name = '';
    }

    public function render()
    {
        return view('livewire.create-player');
    }

    public function store()
    {
        $team = Team::find($this->team_id);

        // echo ($team);

        $player = $team->players()->create([
            'cedula' => $this->cedula,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'champion_id' => $team->category->champion_id
        ]);

        if ($player) {
            $this->reset(['cedula', 'first_name', 'last_name']);
            $this->emit('render');
            $this->emit('closeModal');
        }
    }
}
