<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Game;
use App\Models\Player;
use App\Models\Progress;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ListGames extends Component
{
    public $groups, $group_id;
    public $teams, $category_id;
    public $game;
    public $category;
    public $filter_groups;

    public $game_select;
    public $join_players;
    public $team1_players;
    public $team2_players;
    public $error_play;

    protected $rules = [
        'game.team1_id' => 'required|different:game.team2_id',
        'game.team2_id' => 'required',
        'game.date' => 'required',
        'game.time' => 'required',
        'game.state' => 'nullable'
    ];

    public function mount($category_id)
    {
        $this->category = Category::find($category_id);
        $this->groups = $this->category->groups;
        $this->teams = $this->category->teams;
        $carbon = Carbon::now();
        $this->game = new Game();
        $this->game->date = $carbon->toDateString();
        $this->game->time = $carbon->toTimeString();

        $this->filter_groups = $this->groups->map(function ($group) {
            return $group->id;
        });

        $this->game_select = new Game();
        $this->join_players = [];
        $this->team1_players = [];
        $this->team2_players = [];
        $this->error_play = '';
    }

    protected $listeners = ['delete'];

    public function updatingGroupId($value)
    {
        if ($value === '') {
            $this->filter_groups = $this->groups->map(function ($group) {
                return $group->id;
            });
        } else {
            $this->filter_groups = [$value];
        }
    }

    public function render()
    {
        $games = Game::select('games.id', 't1.name AS t1name', 't2.name AS t2name', 'games.state')
            ->join('teams AS t1', 'games.team1_id', 't1.id')
            ->join('teams AS t2', 'games.team2_id', 't2.id')
            ->where('t1.category_id', $this->category->id)
            ->where(function ($query) {
                $query->whereIn('t1.group_id', $this->filter_groups)
                    ->orWhereIn('t2.group_id', $this->filter_groups);
            })
            ->orderBy('t1name', 'DESC')
            ->get();

        return view('livewire.list-games', compact('games'))
            ->layout('layouts.adminlte')
            ->layoutData(['title' => 'Partidos']);
    }

    public function selectPlayers($game_id)
    {
        $this->game_select = json_decode(json_encode(DB::table('games AS g')
            ->select('g.*', 't1.name AS t1_name', 't2.name AS t2_name')
            ->join('teams AS t1', 'team1_id', 't1.id')
            ->join('teams AS t2', 'team2_id', 't2.id')
            ->where('g.id', $game_id)
            ->get()[0]), true);

        $team1_players = Player::where('team_id', $this->game_select['team1_id'])->get();
        $team2_players = Player::where('team_id', $this->game_select['team2_id'])->get();

        $this->join_players = [];

        $i = 0;

        while ($i < count($team1_players) || $i < count($team2_players)) {
            array_push($this->join_players, [
                'player1_id' => $i < count($team1_players) ? $team1_players[$i]->id : '',
                'player2_id' => $i < count($team2_players) ? $team2_players[$i]->id : '',
                'player1_name' => $i < count($team1_players) ? $team1_players[$i]->first_name . ' ' . $team1_players[$i]->last_name : '',
                'player2_name' => $i < count($team2_players) ? $team2_players[$i]->first_name . ' ' . $team2_players[$i]->last_name : '',
            ]);
            $i++;
        }

        $this->emit('showModalSelectPlay');
    }

    public function play()
    {
        $this->error_play = '';

        if (count($this->team1_players) > 5) {
            $this->error_play = 'Debe seleccionar máximo 5 jugadores de ' . $this->game_select['t1_name'];
        }

        if (count($this->team2_players) > 5) {
            $this->error_play .= ' debe seleccionar máximo 5 jugadores de ' . $this->game_select['t2_name'];
        }

        if (count($this->team1_players) < 6 && count($this->team2_players) < 6) {

            $game = Game::find($this->game_select['id']);
            $game_items = [];

            foreach ($this->team1_players as $key => $value) {
                array_push($game_items, [
                    'player_id' => $value,
                    'entered_in' => 'inicio'
                ]);
            }

            foreach ($this->team2_players as $key => $value) {
                array_push($game_items, [
                    'player_id' => $value,
                    'entered_in' => 'inicio'
                ]);
            }

            $game->gameitems()->createMany($game_items);
            $game->state = 'jugando';
            $game->save();

            return redirect()->route('partido', $this->game_select['id']);
        }
    }

    public function create()
    {
        $carbon = Carbon::now();
        $this->game = new Game();
        $this->game->date = $carbon->toDateString();
        $this->game->time = $carbon->toTimeString();

        $this->emit('openModal');
    }

    public function update()
    {
        if ($this->validate()) {
            if (isset($this->game->id)) {
                $this->game->save();
            } else {
                Game::create([
                    'team1_id' => $this->game->team1_id,
                    'team2_id' => $this->game->team2_id,
                    'progress_id' => Progress::first()->id,
                    'date' => $this->game->date,
                    'time' => $this->game->time,
                    'state' => 'creado'
                ]);
            }
            $this->emit('closeModal');
        }
    }

    public function edit(Game $game)
    {
        $this->game = $game;
        $this->category_id = Team::find($this->game->team1_id)->category_id;
        $this->teams = Team::where('category_id', $this->category_id)->get();

        $this->emit('openModal');
    }

    public function delete(Game $game)
    {
        $game->delete();
    }
}
