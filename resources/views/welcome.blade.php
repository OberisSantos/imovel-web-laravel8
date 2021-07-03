@extends('layouts.main')

@section('titulo', 'Tela incial')

@section('conteudo')
    
    @if(10 > 5)
        <p>ola</p>

    @else
        <p>Não</p>
    @endif

    <p>Olá {{$nome}}</p>
    
        
@endsection
    
