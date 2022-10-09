<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <div class="card">
        <div class="card-header">
            <div class="card-title">Jugadores</div>
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
                            <th>Cedula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th style="width: 4em;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($players as $player)
                        <tr>
                            <td>{{ $player->cedula }}</td>
                            <td>{{ $player->first_name }}</td>
                            <td>{{ $player->last_name }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button title="Editar" wire:click="edit({{ $player->id }})" class="btn btn-primary">
                                        <i class="far fa-edit"></i>
                                    </button>

                                    <button title="Eliminar" class="btn btn-danger ml-1" wire:click="$emit('deleteDialog', {{ $player->id }})">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-adminlte-modal id="modal" wire:ignore.self role="dialog" theme="green" icon="fas fa-users-medical" title="Registro de jugador">

        <x-adminlte-input id="micedula" name="player.cedula" wire:model.defer="player.cedula" label="Cédula" placeholder="1105121254" igroup-size="sm" fgroup-class="col-md" disable-feedback />
        <x-jet-input-error for="player.cedula" />

        <x-adminlte-input name="player.first_name" wire:model.defer="player.first_name" label="Nombre" placeholder="Juan" igroup-size="sm" fgroup-class="col-md" disable-feedback />
        <x-jet-input-error for="player.first_name" />

        <x-adminlte-input name="player.last_name" wire:model.defer="player.last_name" label="Apellido" placeholder="Andrade" igroup-size="sm" fgroup-class="col-md" disable-feedback />
        <x-jet-input-error for="player.last_name" />

        <x-adminlte-input id="mifecha" name="player.date_of_birth" wire:model.defer="player.date_of_birth" label="Fecha de nacimiento" placeholder="1990-05-21" igroup-size="sm" fgroup-class="col-md" disable-feedback />

        <x-slot name="footerSlot">
            <x-adminlte-button style="height: 3em;" wire:click="update" wire:loading.attr="disabled" theme="success" icon="fas fa-lg fa-save" />
        </x-slot>
    </x-adminlte-modal>

    @push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $('#micedula').mask('0000000000')
        $('#mifecha').mask('0000-00-00')

        Livewire.on('deleteDialog', player_id => {
            Swal.fire({
                title: 'Advertencia',
                text: "¿Esta seguro que desea eliminar el jugador?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('list-players', 'delete', player_id)
                    Swal.fire(
                        'Eliminado!',
                        'El jugador ha sido eliminado.',
                        'success'
                    )
                }
            })
        })
    </script>
    @endpush
</div>