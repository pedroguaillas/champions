<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <div class="card">
        <div class="card-header">
            <div class="card-title">Pagos de {{ $team->name }}</div>
            <div class="card-tools">
                <div class="dt-buttons btn-group btn-group-sm flex-wrap">
                    <x-adminlte-button wire:click="create" icon="fas fa-plus" theme="success" class="py-2" />
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Monto</th>
                            <th>Nota</th>
                            <th style="width: 4em;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr>
                            <td>{{ date_format($payment->created_at, 'd-m-Y') }}</td>
                            <td>{{ $payment->amount }}</td>
                            <td>{{ $payment->note }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <x-adminlte-button wire:click="edit({{ $payment->id }})" theme="primary" icon="far fa-edit" class="px-1" />
                                    <x-adminlte-button wire:click="$emit('deleteDialog', {{ $payment->id }})" theme="danger" icon="far fa-trash-alt" class="ml-1 px-1" />
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-adminlte-modal id="modal" wire:ignore.self role="dialog" theme="green" icon="fas fa-users-medical" title="{{ isset($this->payment->id) ? 'Editar' : 'Registro de' }} pago">

        <x-adminlte-input name="payment.amount" wire:model.defer="payment.amount" label="Monto" placeholder="35" igroup-size="sm" fgroup-class="col-md" disable-feedback />
        <x-jet-input-error for="payment.amount" />

        <x-adminlte-input name="payment.note" wire:model.defer="payment.note" label="Nota" placeholder="..." igroup-size="sm" fgroup-class="col-md" disable-feedback />

        <x-slot name="footerSlot">
            <x-adminlte-button style="height: 3em;" wire:click="update" wire:loading.attr="disabled" theme="success" icon="fas fa-lg fa-save" />
        </x-slot>
    </x-adminlte-modal>

    @push('js')
    <script>
        Livewire.on('deleteDialog', player_id => {
            Swal.fire({
                title: 'Advertencia',
                text: "¿Esta seguro que desea eliminar el pago?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('list-payments', 'delete', player_id)
                    Swal.fire(
                        'Eliminado!',
                        'El pago ha sido eliminado.',
                        'success'
                    )
                }
            })
        })
    </script>
    @endpush
</div>