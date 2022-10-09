<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Game;
use App\Models\Progress;
use App\Models\Team;
use Carbon\Carbon;
use Livewire\Component;

class ListGames extends Component
{
    public $categories, $teams, $category_id;
    public $game;

    protected $rules = [
        'game.team1_id' => 'required|different:game.team2_id',
        'game.team2_id' => 'required',
        'game.date' => 'required',
        'game.time' => 'required',
        'game.team1_goal' => 'nullable|integer',
        'game.team2_goal' => 'nullable|integer',
        'game.played' => 'nullable'
    ];

    public function mount()
    {
        $this->categories = Category::all();
        $this->teams = [];
        $carbon = Carbon::now();
        $this->game = new Game();
        $this->game->date = $carbon->toDateString();
        $this->game->time = $carbon->toTimeString();
    }

    protected $listeners = ['delete'];

    public function updatingCategoryId($value)
    {
        $this->teams = Team::where('category_id', $value)->get();
    }

    public function render()
    {
        $games = Game::select('games.id', 't1.name AS t1name', 't2.name AS t2name')
            ->join('teams AS t1', 'games.team1_id', 't1.id')
            ->join('teams AS t2', 'games.team2_id', 't2.id')
            ->orderBy('games.created_at', 'DESC')
            ->get();

        return view('livewire.list-games', compact('games'))
            ->layout('layouts.adminlte')
            ->layoutData(['title' => 'Partidos']);
    }

    public function create()
    {
        $this->category_id = '';
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
                    'team1_goal' => $this->game->team1_goal === null ? 0 : $this->game->team1_goal,
                    'team2_goal' => $this->game->team2_goal === null ? 0 : $this->game->team2_goal,
                    'played' => $this->game->played
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
