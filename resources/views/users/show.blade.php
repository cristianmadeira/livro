@extends("layouts.app")
@section("title",$user->name)
@section("content")
    <center><h4>Detalhes do Usuário:{{$user->name}}</h4></center>
    <h6>
        <ul>
          <li><b>Nome:</b>{{$user->name}}</li>
          <li><b>E-Mail:</b>{{$user->email}}</li>
          <li><b>Data da Criação:</b>{{$user->created_at}}</li>
          <li><b>Data da Última Alteração:</b>{{$user->updated_at}}</li>
        </ul>
    </h6>
@stop
