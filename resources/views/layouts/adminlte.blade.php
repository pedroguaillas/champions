@extends('adminlte::page')

@section('title', $title)

@livewireStyles

@section('content')
<br />
{{ $slot }}
@endsection

@livewireScripts
@section('js')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@stop