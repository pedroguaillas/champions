<div>

    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalwindow">+</button>

    <x-adminlte-modal id="modalwindow" wire:ignore role="dialog" theme="green" icon="fas fa-users-medical" title="Registro de jugador">
        <form wire:submit.prevent="store">
            <div class="modal-body">

                <div class="form-group row">
                    <label class="control-label col-sm-4" for="cedula">Cedula</label>
                    <div class="col-sm-8">
                        <input type="text" wire:model="cedula" class="form-control form-control-sm" maxlength="10" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-4" for="first_name">Nombre</label>
                    <div class="col-sm-8">
                        <input type="text" wire:model="first_name" class="form-control form-control-sm" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-4" for="last_name">Apellido</label>
                    <div class="col-sm-8">
                        <input type="text" wire:model="last_name" class="form-control form-control-sm" required>
                    </div>
                </div>

            </div>

            <x-slot name="footerSlot">
                <x-adminlte-button style="height: 3em;" wire:click="store" theme="success" icon="fas fa-lg fa-save" />
            </x-slot>
        </form>
    </x-adminlte-modal>

</div>