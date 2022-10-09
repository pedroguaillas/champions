<?php

namespace App\Http\Livewire;

use App\Models\Payment;
use App\Models\Team;
use Livewire\Component;

class ListPayments extends Component
{
    public $team;
    public $payment;

    protected $rules = [
        'payment.amount' => 'required|numeric',
        'payment.note' => 'nullable'
    ];

    public function mount($team_id)
    {
        $this->team = Team::find($team_id);
    }

    protected $listeners = ['delete'];

    public function render()
    {
        $payments = Payment::where('team_id', $this->team->id)->get();

        return view('livewire.list-payments', compact('payments'))
            ->layout('layouts.adminlte')
            ->layoutData(['title' => 'Pagos']);
    }

    public function create()
    {
        $this->payment = new Payment();
        $this->emit('openModal');
    }

    public function edit(Payment $payment)
    {
        $this->payment = $payment;
        $this->emit('openModal');
    }

    public function update()
    {
        if ($this->validate()) {
            if (isset($this->payment->id)) {
                $this->payment->save();
            } else {
                $this->team->payments()->create([
                    'amount' => $this->payment->amount,
                    'note' => $this->payment->note
                ]);
            }
            $this->emit('closeModal');
        }
    }

    public function delete(Payment $payment)
    {
        $payment->delete();
    }
}
