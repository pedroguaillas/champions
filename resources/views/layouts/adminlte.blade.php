@extends('adminlte::page')

@section('title', $title)

@livewireStyles

@section('content')
<br />
{{ $slot }}
@endsection

@livewireScripts
@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stop