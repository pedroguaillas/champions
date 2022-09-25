<?php

namespace App\Http\Livewire\Team;

use App\Models\Category;
use App\Models\Team;
use Livewire\Component;

class Create extends Component
{
    public $name, $address, $category_id, $paid;

    protected $rule = [
        'name' => 'required',
        'address' => 'required',
        'category_id' => 'required',
        'paid' => 'required'
    ];

    // esto es mas o menos como el constructor del componente
    public function mount()
    {
        // si ves esto es como que inicia las variables
        $this->name = '';
        $this->address = '';
        $this->category_id = Category::first()->id;
    }

    public function updatingCategoryId($value)
    {
        $this->category_id = $value;
    }

    public function render()
    {
        $categories = Category::all();
        return view(
            'livewire.team.create',
            compact('categories')
        );
    }

    public function store()
    {
        $team = Team::create([
            'name' => $this->name,
            'address' => $this->address,
            'category_id' => $this->category_id,
            'paid' => $this->paid
        ]);

        if ($team) {
            $this->reset(['name', 'address', 'paid']);
            $this->emit('render');
            $this->emit('closeModal');
        }
    }
}
