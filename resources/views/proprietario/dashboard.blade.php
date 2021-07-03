@extends('layouts.main')

@section('titulo', 'dashboard')

@section('conteudo')
@isset($user)
    <span>{{$user->name}}</span>
    @isset($user->dono->nome)
        {{$user->dono->nome}}
    @endisset
@endisset


@endsection



