<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="card">
        <div class="card-header">
            <div class="card-title">Sanciones</div>
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
                            <th>Jugador</th>
                            <th>Partido</th>
                            <th>Categoría</th>
                            <th>Tarjeta</th>
                            <th style="width: 4em;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sanctions as $sanction)
                        <tr>
                            <td>{{ $sanction->first_name .' '. $sanction->last_name }}</td>
                            <td>{{ $sanction->t1name . ' VS ' . $sanction->t2name }}</td>
                            <td>{{ $sanction->category_name }}</td>
                            <td>{{ $sanction->type }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <x-adminlte-button wire:click="edit({{ $sanction->id }})" theme="primary" icon="far fa-edit" class="px-1" />
                                    <x-adminlte-button wire:click="$emit('deleteDialog', {{ $sanction->id }})" theme="danger" icon="far fa-trash-alt" class="ml-1 px-1" />
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Formulario registro y editar sanciones -->
    <x-adminlte-modal id="modal" wire:ignore.self theme="green" icon="fas fa-users-medical" title="{{ isset($this->sanction->id) ? 'Editar' : 'Registro de' }} sanción">

        <div class="form-group col-md">
            <label for="category_id">Categoría</label>
            <div class="input-group input-group-sm">
                <select class="form-control" wire:model="category_id" required>
                    @if(!isset($this->sanction->id))
                    <option value="">Seleccione</option>
                    @endif
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group col-md">
            <label for="game.team1_id">Partidos</label>
            <div class="input-group input-group-sm">
                <select class="form-control" wire:model="sanction.game_id" required>
                    @if(!isset($this->sanction->id))
                    <option value="">Seleccione</option>
                    @endif
                    @foreach($games as $game)
                    <option value="{{ $game->id }}">
                        {{ $game->t1name . ' VS ' . $game->t2name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <x-jet-input-error for="sanction.game_id" />

        <div class="form-group col-md">
            <label for="game.team1_id">Equipos</label>
            <div class="input-group input-group-sm">
                <select class="form-control" wire:model="team_id" required>
                    @if(!isset($this->sanction->id))
                    <option value="">Seleccione</option>
                    @endif
                    @foreach($teams as $team)
                    <option value="{{ $team->id }}">
                        {{ $team->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group col-md">
            <label for="game.team1_id">Jugadores</label>
            <div class="input-group input-group-sm">
                <select class="form-control" wire:model.defer="sanction.player_id" required>
                    @if(!isset($this->sanction->id))
                    <option value="">Seleccione</option>
                    @endif
                    @foreach($players as $player)
                    <option value="{{ $player->id }}">
                        {{ $player->first_name . ' ' . $player->last_name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <x-jet-input-error for="sanction.player_id" />

        <div class="form-group col-md">
            <label for="game.team1_id">Tarjeta</label>
            <div class="input-group input-group-sm">
                <select class="form-control" wire:model.defer="sanction.type" required>
                    @if(!isset($this->sanction->id))
                    <option value="">Seleccione</option>
                    @endif
                    <option value="roja">Roja</option>
                    <option value="amarilla">Amarilla</option>
                </select>
            </div>
        </div>
        <x-jet-input-error for="sanction.type" />

        <x-slot name="footerSlot">
            <x-adminlte-button style="height: 3em;" wire:click="update" wire:loading.attr="disabled" theme="success" icon="fas fa-lg fa-save" />
        </x-slot>
    </x-adminlte-modal>

    @push('js')
    <script>
        Livewire.on('deleteDialog', sanction_id => {
            Swal.fire({
                title: 'Advertencia',
                text: "¿Esta seguro que desea eliminar la sanción?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('list-sanctions', 'delete', sanction_id)
                    Swal.fire(
                        'Eliminado!',
                        'La sanción ha sido eliminado.',
                        'success'
                    )
                }
            })
        })
    </script>
    @endpush
</div>