<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use Carbon\Carbon;
use Livewire\Component;

class Diary extends Component
{
    public $date;

    public function mount()
    {
        $this->date = substr(Carbon::today()->toISOString(), 0, 10);
    }

    public function render()
    {
        $payments = Payment::join('teams AS t', 't.id', 'team_id')
            ->whereDate('payments.created_at', $this->date)
            ->get();

        return view('livewire.diary', compact('payments'))
            ->layout('layouts.adminlte')
            ->layoutData(['title' => 'Libro diario']);
    }
}
