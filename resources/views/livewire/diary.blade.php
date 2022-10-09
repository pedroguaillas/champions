<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="card-title col-lg-4">Diario</div>
                <div class="col-lg-2">
                    <div class="input-group input-group-sm">
                        <input type="date" class="form-control" wire:model="date" max="{{ date('Y-m-d') }}"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Club</th>
                            <th>Nota</th>
                            <th>Monto</th>
                        </tr>
                    </thead>
                    @php
                    $sum=0;
                    @endphp
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <td>{{ $payment->name }}</td>
                            <td>{{ $payment->note }}</td>
                            <td>{{ $payment->amount }}</td>
                        </tr>
                        @php
                        $sum+=$payment->amount;
                        @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">Total</th>
                            <th>{{ number_format($sum, 2) }}</th>
                        </tr>

                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>