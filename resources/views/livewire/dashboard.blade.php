<div>
    {{-- Do your work, then step back. --}}

    <div class="row">
        <div class="col-md-6 col-lg-3">
            <x-adminlte-small-box title="{{ $teams }}" text="Clubes registrados" icon="fas fa-medal text-white" theme="teal" url="{{ url('clubes') }}" url-text="Ver todos los clubes" />
        </div>
        <div class="col-md-6 col-lg-3">
            <x-adminlte-small-box title="{{ $games }}" text="Partidos creados" icon="fas fa-star text-white" theme="warning" url="{{ url('partidos') }}" url-text="Ver todos los partidos" />
        </div>
        <div class="col-md-6 col-lg-3">
            <x-adminlte-small-box title="{{ $players }}" text="Jugadores inscritos" icon="fas fa-users text-white" theme="lightblue" url="#" url-text="." />
        </div>
        <div class="col-md-6 col-lg-3">
            <x-adminlte-small-box title="{{ $sanctions }}" text="Sanciones" icon="fas fa-exclamation-circle text-white" theme="danger" url="#" url-text="." />
        </div>
    </div>
</div>