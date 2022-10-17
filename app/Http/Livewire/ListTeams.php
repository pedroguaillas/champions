<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Group;
use App\Models\Team;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ListTeams extends Component
{
    public $team;
    public $category;
    public $groups;

    public $group_id_filter;
    public $filters_groups;

    protected $rules = [
        'team.name' => 'required',
        'team.address' => 'required',
        'team.group_id' => 'required|numeric',
        'team.extra_points' => 'nullable|integer'
    ];

    public function mount($category_id)
    {
        $this->category = Category::find($category_id);
        $this->groups = $this->category->groups;

        $this->filters_groups = $this->groups->map(function ($group) {
            return $group->id;
        });
    }

    public function updatingGroupIdFilter($value)
    {
        if ($value === '') {
            $this->filters_groups = Group::where('category_id', $this->category->id)
                ->get()->map(function ($group) {
                    return $group->id;
                });
        } else {
            $this->filters_groups = [$value];
        }
    }

    protected $listeners = ['delete'];

    public function render()
    {
        $teams = DB::table('teams AS t')
            ->select(DB::raw('t.id,t.name,g.description,SUM(p.amount) AS paid'))
            ->join('categories AS c', 'c.id', 'category_id')
            ->leftJoin('groups AS g', 'g.id', 'group_id')
            ->leftJoin('payments AS p', 'p.team_id', 't.id')
            ->where('c.id', $this->category->id)
            ->whereIn('g.id', $this->filters_groups)
            ->groupBy(['id', 'name', 'description'])
            ->orderBy('name')
            ->get();

        return view(
            'livewire.list-teams',
            compact('teams')
        )
            ->layout('layouts.adminlte')
            ->layoutData(['title' => 'Equipos']);
    }

    public function create()
    {
        $this->team = new Team();
        $this->emit('openModal');
    }

    public function edit(Team $team)
    {
        $this->team = $team;
        $this->groups = Group::where('category_id', $team->category_id)->get();
        $this->emit('openModal');
    }

    public function update()
    {
        if ($this->validate()) {
            if (isset($this->team->id)) {
                $this->team->save();
            } else {
                $team = $this->category->teams()->create([
                    'name' => $this->team->name,
                    'address' => $this->team->address,
                    'group_id' => $this->team->group_id,
                    'paid' => 0
                ]);
                if ($this->team->paid !== null && $this->team->paid !== '') {
                    $team->payments()->create([
                        'amount' => $this->team->paid
                    ]);
                }
            }
            $this->emit('closeModal');
        }
    }

    public function delete(Team $team)
    {
        $team->delete();
    }
}
