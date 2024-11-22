@extends('adminlte::page')

@section('content')
    <div class="fondo general">
        <div style="width: 100%;margin-top: 10px;">
            <livewire:attendance />
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection
