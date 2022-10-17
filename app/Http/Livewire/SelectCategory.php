<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SelectCategory extends Component
{
    public $type;

    public function mount($type)
    {
        $this->type = $type;
    }

    public function render()
    {
        $categories = DB::table('categories AS c')
            ->select(DB::raw('c.id,c.name,COUNT(t.id) AS count'))
            ->leftJoin('teams AS t', 'c.id', 'category_id')
            ->groupBy('id', 'name')
            ->get();

        return view('livewire.select-category', compact('categories'))
            ->layout('layouts.adminlte')
            ->layoutData(['title' => 'Seleccionar Categoría']);
    }
}
