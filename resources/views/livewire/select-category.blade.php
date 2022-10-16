<div>
    {{-- Care about people's approval and you will be their prisoner. --}}

    <div class="row">
        <div class="col-sm-6 col-md-4">
            <x-adminlte-small-box title="{{ $categories[0]->count }}" text="{{ $categories[0]->name }}" icon="fas fa-medal" theme="secondary" url="{{ route($type, $categories[0]->id) }}" theme="success" url-text="Ver {{ $type }}" />
        </div>
        <div class="col-sm-6 col-md-4">
            <x-adminlte-small-box title="{{ $categories[1]->count }}" text="{{ $categories[1]->name }}" icon="fas fa-medal" theme="secondary" url="{{ route($type, $categories[1]->id) }}" theme="teal" url-text="Ver {{ $type }}" />
        </div>
        <div class="col-sm-6 col-md-4">
            <x-adminlte-small-box title="{{ $categories[2]->count }}" text="{{ $categories[2]->name }}" icon="fas fa-medal" theme="secondary" url="{{ route($type, $categories[2]->id) }}" theme="lightblue" url-text="Ver {{ $type }}" />
        </div>
    </div>

</div>