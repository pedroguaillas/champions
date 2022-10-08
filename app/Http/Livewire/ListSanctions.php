<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Game;
use App\Models\Player;
use App\Models\Sanction;
use App\Models\Team;
use Livewire\Component;

class ListSanctions extends Component
{
    public $categories = [], $games = [], $teams = [], $players = [];
    public $sanction, $category_id, $team_id;

    protected $rules = [
        'sanction.game_id' => 'required',
        'sanction.player_id' => 'required',
        'sanction.type' => 'required'
    ];

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function updatingCategoryId($value)
    {
        $this->games = Game::select('games.id', 't1.name AS t1name', 't2.name AS t2name')
            ->join('teams AS t1', 't1.id', 'team1_id')
            ->join('teams AS t2', 't2.id', 'team2_id')
            ->where('t1.category_id', $value)
            ->orderBy('games.created_at', 'DESC')
            ->get();
    }

    public function updatingSanctionGameId($value)
    {
        $game = Game::find($value);
        $this->sanction->game_id = $value;
        $this->teams = Team::whereIn('id', [$game->team1_id, $game->team2_id])
            ->orderBy('teams.created_at', 'DESC')
            ->get();
    }

    public function updatingTeamId($value)
    {
        $this->players = Player::where('team_id', $value)
            ->orderBy('players.first_name', 'DESC')
            ->get();
    }

    public function render()
    {
        $sanctions = Sanction::select('sanctions.id', 't1.name AS t1name', 't2.name AS t2name', 'p.first_name', 'p.last_name', 'c.name AS category_name')
            ->join('players AS p', 'p.id', 'player_id')
            ->join('games AS g', 'g.id', 'game_id')
            ->join('teams AS t1', 't1.id', 'team1_id')
            ->join('teams AS t2', 't2.id', 'team2_id')
            ->join('categories AS c', 'c.id', 't1.category_id')
            ->orderBy('sanctions.created_at', 'DESC')
            ->get();

        return view('livewire.list-sanctions', compact('sanctions'))
            ->layout('layouts.adminlte')
            ->layoutData(['title' => 'Equipos']);
    }

    public function create()
    {
        $this->sanction = new Sanction();

        $this->emit('openModal');
    }

    public function update()
    {
        if ($this->validate()) {
            if (isset($this->sanction->id)) {
                $this->sanction->save();
            } else {
                Sanction::create([
                    'game_id' => $this->sanction->game_id,
                    'player_id' => $this->sanction->player_id,
                    'type' => $this->sanction->type
                ]);
            }
            $this->emit('closeModal');
        }
    }
}
