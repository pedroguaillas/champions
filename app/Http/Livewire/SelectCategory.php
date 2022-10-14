<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class SelectCategory extends Component
{
    public function render()
    {
        $categories = Category::all();

        return view('livewire.select-category', compact('categories'))
            ->layout('layouts.adminlte')
            ->layoutData(['title' => 'Seleccionar Categoría']);
    }
}
