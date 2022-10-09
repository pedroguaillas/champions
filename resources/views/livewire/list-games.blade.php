<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}

    <div class="card">
        <div class="card-header">
            <div class="card-title">Partidos</div>
            <div class="card-tools">
                <div class="dt-buttons btn-group btn-group-sm flex-wrap">
                    <x-adminlte-button wire:click="create" icon="fas fa-plus" theme="success" class="py-2" />
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>Equipo 1</th>
                            <th>VS</th>
                            <th>Equipo 2</th>
                            <th style="width: 4em;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($games as $game)
                        <tr>
                            <td>{{ $game->t1name }}</td>
                            <td>VS</td>
                            <td>{{ $game->t2name }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <!-- <a title="Jugar" href="{{ route('partido', $game->id) }}" class="btn btn-success px-1">
                                        <i class="far fa-futbol"></i>
                                    </a> -->
                                    <x-adminlte-button wire:click="edit({{ $game->id }})" theme="primary" icon="far fa-edit" class="px-1" />
                                    <x-adminlte-button wire:click="$emit('deleteDialog', {{ $game->id }})" theme="danger" icon="far fa-trash-alt" class="ml-1 px-1" />
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <x-adminlte-modal id="modal" wire:ignore.self theme="green" icon="fas fa-users-medical" title="{{ isset($this->game->id) ? 'Editar' : 'Registro de' }} partido">

        <div class="form-group col-md">
            <label for="category_id">Categoría</label>
            <div class="input-group input-group-sm">
                <select class="form-control" wire:model="category_id" required>
                    <option value="">Seleccione</option>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group col-md">
            <label for="game.team1_id">Equipo 1</label>
            <div class="input-group input-group-sm">
                <select class="form-control" wire:model.defer="game.team1_id" required>
                    <option value="">Seleccione</option>
                    @foreach($teams as $eam)
                    <option value="{{$eam->id}}">{{$eam->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <x-jet-input-error for="game.team1_id" />

        <div class="text-center">
            <strong>VS</strong>
        </div>

        <div class="form-group col-md">
            <label for="game.team2_id">Equipo 2</label>
            <div class="input-group input-group-sm">
                <select class="form-control" wire:model.defer="game.team2_id" required>
                    <option value="">Seleccione</option>
                    @foreach($teams as $eam)
                    <option value="{{$eam->id}}">{{$eam->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <x-jet-input-error for="game.team2_id" />

        <x-adminlte-input name="date" id="midate" wire:model.defer="game.date" label="Fecha" igroup-size="sm" fgroup-class="col-md" disable-feedback />

        <x-adminlte-input name="time" id="mihora" wire:model.defer="game.time" label="Hora" igroup-size="sm" fgroup-class="col-md" disable-feedback />

        <x-adminlte-input name="team1_goal" type="text" wire:model.defer="game.team1_goal" label="Goles club 1" igroup-size="sm" fgroup-class="col-md" disable-feedback />

        <x-adminlte-input name="team2_goal" type="text" wire:model.defer="game.team2_goal" label="Goles club 2" igroup-size="sm" fgroup-class="col-md" disable-feedback />

        <div class="form-group col-md">
            <label for="game.played">
                <input wire:model.defer="game.played" type="checkbox">Jugado
            </label>
        </div>

        <x-slot name="footerSlot">
            <x-adminlte-button style="height: 3em;" wire:click="update" wire:loading.attr="disabled" theme="success" icon="fas fa-lg fa-save" />
        </x-slot>
    </x-adminlte-modal>

    @push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $('#mifecha').mask('0000-00-00')
        $('#mihora').mask('00:00')

        Livewire.on('deleteDialog', game_id => {
            Swal.fire({
                title: 'Advertencia',
                text: "¿Esta seguro que desea eliminar el partido?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('list-games', 'delete', game_id)
                    Swal.fire(
                        'Eliminado!',
                        'El partido ha sido eliminado.',
                        'success'
                    )
                }
            })
        })
    </script>
    @endpush

</div>