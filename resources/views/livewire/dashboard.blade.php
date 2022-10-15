<div>
    {{-- Do your work, then step back. --}}

    <div class="row">
        <div class="col-md-6 col-lg-3">
            <x-adminlte-small-box title="${{ $sum_inscriptions }}" text="Inscripciones" icon="fas fa-money-bill-wave text-white" theme="success" url="{{ url('clubes') }}" url-text="Ver todos los clubes" />
        </div>
        <div class="col-md-6 col-lg-3">
            <x-adminlte-small-box title="{{ $teams }}" text="Clubes registrados" icon="fas fa-medal text-white" theme="teal" url="{{ url('seleccionar_categoria/clubes') }}" url-text="Ver todos los clubes" />
        </div>
        <div class="col-md-6 col-lg-3">
            <x-adminlte-small-box title="{{ $games }}" text="Partidos creados" icon="fas fa-star text-white" theme="warning" url="{{ url('seleccionar_categoria/partidos') }}" url-text="Ver todos los partidos" />
        </div>
        <div class="col-md-6 col-lg-3">
            <x-adminlte-small-box title="{{ $players }}" text="Jugadores inscritos" icon="fas fa-users text-white" theme="lightblue" url="#" url-text="." />
        </div>
        <div class="col-md-6 col-lg-3">
            <x-adminlte-small-box title="{{ $sanctions }}" text="Sanciones" icon="fas fa-exclamation-circle text-white" theme="danger" url="sanciones" url-text="Ver todas las sanciones" />
        </div>
    </div>
</div>