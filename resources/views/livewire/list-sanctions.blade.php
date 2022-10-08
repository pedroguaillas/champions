<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="cad">
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
                            <th style="width: 4em;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sanctions as $sanction)
                        <tr>
                            <td>{{ $sanction->first_name .' '. $sanction->last_name }}</td>
                            <td>{{ $sanction->t1name . ' ' . $sanction->t2name }}</td>
                            <td>{{ $sanction->category_name }}</td>
                            <td>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Formulario registro y editar sanciones -->
    <x-adminlte-modal id="modal" wire:ignore.self theme="green" icon="fas fa-users-medical" title="{{ isset($this->game->id) ? 'Editar' : 'Registro de' }} sanción">

        <div class="row">
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
        </div>

        <div class="row">
            <div class="form-group col-md">
                <label for="game.team1_id">Partidos</label>
                <div class="input-group input-group-sm">
                    <select class="form-control" wire:model="sanction.game_id" required>
                        <option value="">Seleccione</option>
                        @foreach($games as $game)
                        <option value="{{ $game->id }}">
                            {{ $game->t1name . ' VS ' . $game->t2name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <x-jet-input-error for="sanction.game_id" />

        <div class="row">
            <div class="form-group col-md">
                <label for="game.team1_id">Equipos</label>
                <div class="input-group input-group-sm">
                    <select class="form-control" wire:model="team_id" required>
                        <option value="">Seleccione</option>
                        @foreach($teams as $team)
                        <option value="{{ $team->id }}">
                            {{ $team->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md">
                <label for="game.team1_id">Jugadores</label>
                <div class="input-group input-group-sm">
                    <select class="form-control" wire:model.defer="sanction.player_id" required>
                        <option value="">Seleccione</option>
                        @foreach($players as $player)
                        <option value="{{ $player->id }}">
                            {{ $player->first_name . ' ' . $player->last_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <x-jet-input-error for="sanction.player_id" />

        <div class="row">
            <div class="form-group col-md">
                <label for="game.team1_id">Tipo</label>
                <div class="input-group input-group-sm">
                    <select class="form-control" wire:model.defer="sanction.type" required>
                        <option value="">Seleccione</option>
                        <option value="roja">Roja</option>
                        <option value="amarilla">Amarilla</option>
                    </select>
                </div>
            </div>
        </div>
        <x-jet-input-error for="sanction.type" />

        <x-slot name="footerSlot">
            <x-adminlte-button style="height: 3em;" wire:click="update" theme="success" icon="fas fa-lg fa-save" />
        </x-slot>
    </x-adminlte-modal>
</div>