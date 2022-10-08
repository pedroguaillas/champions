<div>
    {{-- In work, do what you enjoy. --}}
    <!-- <x-adminlte-small-box title="{{ $game->t1name . ' VS ' . $game->t2name }}" icon="fas fa-futbol text-white" theme="teal">
    </x-adminlte-small-box> -->

<x-adminlte-profile-widget name="{{ $game->t1name . ' VS ' . $game->t2name }}" desc="Commercial Manager" theme="primary"
    img="https://picsum.photos/id/1011/100">
    <x-adminlte-profile-col-item class="text-primary border-right" icon="fas fa-lg fa-gift"
        title="Sales" text="25" size=6 badge="primary"/>
    <x-adminlte-profile-col-item class="text-danger" icon="fas fa-lg fa-users" title="Dependents"
        text="10" size=6 badge="danger"/>
</x-adminlte-profile-widget>
</div>