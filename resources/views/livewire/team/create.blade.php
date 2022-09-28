<div>

    <x-adminlte-button label="+" theme="success" data-toggle="modal" data-target="#modal" />

    <x-adminlte-modal id="modal" wire:ignore.self theme="green" icon="fas fa-users-medical" title="Registro de club">

        <div class="row">
            <x-adminlte-input name="name" wire:model.defer="name" label="Nombre del club" placeholder="Claudio" fgroup-class="col-md" disable-feedback />
        </div>
        <x-jet-input-error for="name" />

        <div class="row">
            <x-adminlte-input name="address" wire:model.defer="address" label="Comunidad" placeholder="Langa" fgroup-class="col-md" disable-feedback />
        </div>
        <x-jet-input-error for="address" />

        <div class="row">
            <div class="form-group col-md">
                <label for="category_id">Categoría</label>
                <div class="input-group">
                    <select class="form-control" wire:model.defer="category_id" required>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <x-adminlte-input name="paid" wire:model.defer="paid" label="Pagado" fgroup-class="col-md" disable-feedback />
        </div>
        <x-jet-input-error for="paid" />

        <x-slot name="footerSlot">
            <x-adminlte-button style="height: 3em;" wire:click="store" theme="success" icon="fas fa-lg fa-save" />
        </x-slot>
    </x-adminlte-modal>

</div>