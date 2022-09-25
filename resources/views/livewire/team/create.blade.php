<div>

    <button class="btn btn-success" data-toggle="modal" data-target="#modalwindow">+</button>

    <x-adminlte-modal id="modalwindow" wire:ignore role="dialog" theme="green" icon="fas fa-users-medical" title="Registro de club">
        <form wire:submit.prevent="store">
            <div class="modal-body">

                <div class="form-group row">
                    <label class="control-label col-sm-4" for="name">Nombre</label>
                    <div class="col-sm-8">
                        <input type="text" wire:model="name" class="form-control form-control-sm" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-4" for="address">Comunidad</label>
                    <div class="col-sm-8">
                        <input type="text" wire:model="address" class="form-control form-control-sm" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-4" for="category_id">Categoria</label>
                    <div class="col-sm-8">
                        <select class="custom-select form-control form-control-sm" wire:model="category_id" required>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-4" for="paid">Pagado</label>
                    <div class="col-sm-8">
                        <input type="text" wire:model="paid" class="form-control form-control-sm" required>
                    </div>
                </div>

            </div>

            <x-slot name="footerSlot">
                <x-adminlte-button style="height: 3em;" wire:click="store" theme="success" icon="fas fa-lg fa-save" />
            </x-slot>
        </form>
    </x-adminlte-modal>

</div>