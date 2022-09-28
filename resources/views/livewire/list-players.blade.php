<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <div class="card-header">
        <div class="card-title">Jugadores</div>
        <div class="card-tools">
            <div class="dt-buttons btn-group flex-wrap">
                @livewire('create-player', ['team_id' => $team_id])
            </div>
        </div>
    </div>
    <div class="card-body">
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

                            <a title="Editar" wire:click="edit({{ $player->id }})" class="btn btn-primary ml-1">
                                <i class="far fa-edit"></i>
                            </a>

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

    <script>
        Livewire.on('closeModal', function() {
            $('#modalwindow').modal('hide')
        })
    </script>

</div>