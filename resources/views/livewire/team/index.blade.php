<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <div class="card">
        <div class="card-header">
            <div class="card-title">Clubs</div>
            <div class="card-tools">
                <div class="dt-buttons btn-group flex-wrap">
                    @livewire('team.create')
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Comunidad</th>
                        <th>Categoría</th>
                        <th>Pagado</th>
                        <th style="width: 4em;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teams as $team)
                    <tr>
                        <td>{{ $team->name }}</td>
                        <td>{{ $team->address }}</td>
                        <td>{{ $team->category_name }}</td>
                        <td>{{ $team->paid }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a title="Jugadores" href="{{ route('jugadores', $team->id) }}" class="btn btn-success">
                                    <i class="far fa-list-alt"></i>
                                </a>

                                <a title="Editar" wire:click="edit({{ $team->id }})" class="btn btn-primary ml-1">
                                    <i class="far fa-edit"></i>
                                </a>

                                <button title="Eliminar" class="btn btn-danger ml-1" onClick='userDelete("{{ $team->id }}")'>
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