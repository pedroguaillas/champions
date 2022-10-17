<?php

namespace App\Http\Livewire;

use App\Models\Game as ModelsGame;
use App\Models\GameItem;
use App\Models\Player;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Game extends Component
{
    public $game;
    public $game_items;
    public $gamed;

    protected $rules = [
        'gamed' => 'nullable'
    ];

    public function mount($game_id)
    {
        $this->game = json_decode(json_encode(DB::table('games AS g')
            ->select('g.*', 't1.name AS t1_name', 't2.name AS t2_name')
            ->join('teams AS t1', 'team1_id', 't1.id')
            ->join('teams AS t2', 'team2_id', 't2.id')
            ->where('g.id', $game_id)
            ->get()[0]), true);
    }

    public function updatingGamed()
    {
        $game = ModelsGame::find($this->game['id']);
        $game->state = 'finalizado';
        $game->save();
    }

    public function render()
    {
        $t1_players = Player::select('players.*', 'gi.id AS gi_id', 'gi.goals')
            ->join('game_items AS gi', 'players.id', 'player_id')
            ->where([
                'game_id' => $this->game['id'],
                'team_id' => $this->game['team1_id']
            ])->get();

        $t2_players = Player::select('players.*', 'gi.id AS gi_id', 'gi.goals')
            ->join('game_items AS gi', 'players.id', 'player_id')
            ->where([
                'game_id' => $this->game['id'],
                'team_id' => $this->game['team2_id']
            ])->get();

        $i = 0;
        $this->game_items = [];

        while ($i < count($t1_players) || $i < count($t2_players)) {
            array_push($this->game_items, [
                'p1_id' => $i < count($t1_players) ? $t1_players[$i]->gi_id : '',
                'p2_id' => $i < count($t2_players) ? $t2_players[$i]->gi_id : '',
                'p1_goals' => $i < count($t1_players) ? $t1_players[$i]->goals : '',
                'p2_goals' => $i < count($t2_players) ? $t2_players[$i]->goals : '',
                'p1_name' => $i < count($t1_players) ? $t1_players[$i]->first_name . ' ' . $t1_players[$i]->last_name : '',
                'p2_name' => $i < count($t2_players) ? $t2_players[$i]->first_name . ' ' . $t2_players[$i]->last_name : ''
            ]);
            $i++;
        }

        return view('livewire.game')
            ->layout('layouts.adminlte')
            ->layoutData(['title' => 'Partido']);
    }

    public function goal(GameItem $gameItem)
    {
        $gameItem->goals++;
        $gameItem->save();
    }
}
