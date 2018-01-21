@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    {{array_get($homeData, 'home_1.titulo')}}
@endsection
