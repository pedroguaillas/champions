<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <div class="card">
        <div class="card-header">
            <div class="card-title">{{ $category->name }}</div>
            <div class="card-tools">
                <div class="input-group input-group-sm">
                    <select class="form-control" wire:model="group_id_filter" required>
                        <option value="">Filtre por serie</option>
                        @foreach($groups as $group)
                        <option value="{{$group->id}}">{{$group->description}}</option>
                        @endforeach
                    </select>
                    <x-adminlte-button wire:click="create" icon="fas fa-plus" theme="success" class="ml-2 btn-sm" />
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombre</th>
                            <th>Serie</th>
                            <th style="width: 4em;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach($teams as $team)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $team->name }}</td>
                            <td>{{ $team->description }}</td>
                            <td>
                                <div class="btn-group btn-group">
                                    <!-- <a title="Pagos" href="{{ route('pagos', $team->id) }}" class="btn btn-success px-1">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </a> -->
                                    <a title="Jugadores" href="{{ route('jugadores', $team->id) }}" class="btn btn-success px-1">
                                        <i class="fas fa-users"></i>
                                    </a>
                                    <x-adminlte-button wire:click="edit({{ $team->id }})" theme="primary" icon="far fa-edit" class="ml-1 px-1" />
                                    <x-adminlte-button wire:click="$emit('deleteDialog', {{ $team->id }})" theme="danger" icon="far fa-trash-alt" class="ml-1 px-1" />
                                </div>
                            </td>
                        </tr>
                        @php
                        $i ++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Formulario registro y editar club -->
    <x-adminlte-modal id="modal" wire:ignore.self theme="green" icon="fas fa-users-medical" title="{{ isset($this->team->id) ? 'Editar' : 'Registro de' }} club">

        <x-adminlte-input name="name" wire:model.defer="team.name" label="Nombre del club" placeholder="Club sporting" igroup-size="sm" fgroup-class="col-md" disable-feedback />
        <x-jet-input-error for="team.name" />

        <x-adminlte-input name="address" wire:model.defer="team.address" label="Comunidad" placeholder="Langa" igroup-size="sm" fgroup-class="col-md" disable-feedback />
        <x-jet-input-error for="team.address" />

        <div class="form-group col-md">
            <label for="category_id">Grupo</label>
            <div class="input-group input-group-sm">
                <select class="form-control" wire:model.defer="team.group_id" required>
                    <option value="">Seleccione</option>
                    @foreach($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->description }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <x-jet-input-error for="team.group_id" />

        @if(!isset($this->team->id))
        <x-adminlte-input name="paid" wire:model.defer="team.paid" label="Pagado" placeholder="35" igroup-size="sm" fgroup-class="col-md" disable-feedback />
        <x-jet-input-error for="team.paid" />
        @endif

        <x-slot name="footerSlot">
            <x-adminlte-button style="height: 3em;" wire:click="update" wire:loading.attr="disabled" theme="success" icon="fas fa-lg fa-save" />
        </x-slot>

    </x-adminlte-modal>

    @push("js")
    <script>
        Livewire.on('deleteDialog', team_id => {
            Swal.fire({
                title: 'Advertencia',
                text: "¿Esta seguro que desea eliminar el club?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emitTo('list-teams', 'delete', team_id)
                    Swal.fire(
                        'Eliminado!',
                        'El club ha sido eliminado.',
                        'success'
                    )
                }
            })
        })
    </script>
    @endpush
</div>