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
    public $groups, $group_id;
    public $teams, $category_id;
    public $game;
    public $category;
    public $filter_groups;

    protected $rules = [
        'game.team1_id' => 'required|different:game.team2_id',
        'game.team2_id' => 'required',
        'game.date' => 'required',
        'game.time' => 'required',
        'game.team1_goal' => 'nullable|integer',
        'game.team2_goal' => 'nullable|integer',
        'game.played' => 'nullable'
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
        $games = Game::select('games.id', 't1.name AS t1name', 't2.name AS t2name')
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
                    'team1_goal' => $this->game->team1_goal === null ? 0 : $this->game->team1_goal,
                    'team2_goal' => $this->game->team2_goal === null ? 0 : $this->game->team2_goal,
                    'played' => $this->game->played === null ? false : true
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

    //Genera el horario del grupo seleccionado
    public function generarHorario()
    {
        if ($this->group_id !== '') {
            $equipos = Team::select('teams.id', 'teams.group_id AS grupo')
                ->where('group_id', $this->group_id)
                ->orderBy('grupo')->get();
            $fechaJornada = Carbon::now();

            $array = array();
            $grupo = array();

            for ($k = 0; $k < count($equipos); $k++) {

                array_push($grupo, $equipos[$k]);

                if ($k === count($equipos) - 1 || ($equipos[$k]->grupo !== $equipos[$k + 1]->grupo)) {
                    if (count($grupo) % 2 !== 0) {
                        $auxEquipo = [
                            'id' => 0,
                            'gruop_id' => $grupo[count($grupo) - 1]->grupo
                        ];
                        $auxEquipo = json_encode($auxEquipo);
                        $auxEquipo = json_decode($auxEquipo);
                        array_push($grupo, $auxEquipo);
                    }

                    for ($i = 0; $i < count($grupo) - 1; $i++) {
                        for ($j = 0; $j < count($grupo) / 2; $j++) {
                            $objeto = [
                                'team1_id' => $grupo[$j]->id,
                                'team2_id' => $grupo[count($grupo) - 1 - $j]->id,
                                'date' => $fechaJornada->toDateString(),
                                'time' => $fechaJornada->toTimeString(),
                                'team1_goal' => 0,
                                'team2_goal' => 0,
                                'played' => false
                            ];
                            array_push($array, $objeto);
                        }
                        $grupo = $this->girar($grupo);
                        $fechaJornada->addDays(7);
                    }
                    $grupo = array();
                }
            }
            $auxArray = array();
            for ($i = 0; $i < count($array); $i++) {
                if ($array[$i]['team2_id'] !== 0) {
                    array_push($auxArray, $array[$i]);
                }
            }

            Progress::first()->games()->createMany($auxArray);
        }
    }

    private function girar($array)
    {
        $auxArray = array();
        $aux = $array[0];

        for ($i = 0; $i < count($array) - 2; $i++) {
            // $auxArray[$i] = $array[$i + 1];
            array_push($auxArray, $array[$i + 1]);
        }
        array_push($auxArray, $aux);

        array_push($auxArray, $array[count($array) - 1]);

        return $auxArray;
    }
}
