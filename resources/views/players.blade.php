@extends('adminlte::page')

@section('title', 'Jugadores')

@section('css')
@livewireStyles
@endsection

@section('content')
<br />
<div class="card">
    @livewire('list-players', ['team_id' => $team_id])
</div>
@endsection

@section('js')
@livewireScripts
<script>
    Livewire.on('closeModal', function() {
        $('#modalwindow').modal('hide')
    })
</script>
@endsection