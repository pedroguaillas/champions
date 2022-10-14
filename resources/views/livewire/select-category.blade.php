<div>
    {{-- Care about people's approval and you will be their prisoner. --}}

    <div class="row">
        <div class="col-sm-6 col-md-4">
            <x-adminlte-small-box title="{{ $categories[0]->name }}" text="Categoría" icon="fas fa-medal" theme="secondary" url="{{ route('partidos', $categories[0]->id) }}" theme="success" url-text="Ver partidos" />
        </div>
        <div class="col-sm-6 col-md-4">
            <x-adminlte-small-box title="{{ $categories[1]->name }}" text="Categoría" icon="fas fa-medal" theme="secondary" url="{{ route('partidos', $categories[1]->id) }}" theme="teal" url-text="Ver partidos" />
        </div>
        <div class="col-sm-6 col-md-4">
            <x-adminlte-small-box title="{{ $categories[2]->name }}" text="Categoría" icon="fas fa-medal" theme="secondary" url="{{ route('partidos', $categories[2]->id) }}" theme="lightblue" url-text="Ver partidos" />
        </div>
    </div>

</div>