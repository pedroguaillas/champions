<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <div class="card-header">
        <div class="card-title">Jugadores</div>
        <div class="card-tools">
            <div class="dt-buttons btn-group btn-group-sm flex-wrap">
                <x-adminlte-button wire:click="create" icon="fas fa-plus" theme="success" />
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
                                <button title="Editar" wire:click="edit({{ $player->id }})" class="btn btn-primary ml-1">
                                    <i class="far fa-edit"></i>
                                </button>

                                <button title="Eliminar" class="btn btn-danger ml-1" onClick='userDelete("{{ $player->id }}")'>
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

    <x-adminlte-modal id="modal" wire:ignore.self role="dialog" theme="green" icon="fas fa-users-medical" title="Registro de jugador">
        <form wire:submit.prevent="store">
            <div class="modal-body">

                <div class="form-group input-group-sm">
                    <label class="control-label mb-0 col-sm-4" for="cedula">Cedula</label>
                    <div class="col-sm">
                        <input type="text" wire:model.defer="player.cedula" class="form-control form-control-sm" maxlength="10" required>
                    </div>
                </div>

                <div class="form-group input-group-sm">
                    <label class="control-label mb-0 col-sm-4" for="first_name">Nombre</label>
                    <div class="col-sm">
                        <input type="text" wire:model.defer="player.first_name" class="form-control form-control-sm" required>
                    </div>
                </div>

                <div class="form-group input-group-sm">
                    <label class="control-label mb-0 col-sm-4" for="last_name">Apellido</label>
                    <div class="col-sm">
                        <input type="text" wire:model.defer="player.last_name" class="form-control form-control-sm" required>
                    </div>
                </div>

            </div>

            <x-slot name="footerSlot">
                <x-adminlte-button style="height: 3em;" wire:click="update" theme="success" icon="fas fa-lg fa-save" />
            </x-slot>
        </form>
    </x-adminlte-modal>
</div>