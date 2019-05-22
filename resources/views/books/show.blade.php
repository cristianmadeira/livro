@extends("layouts.app")
@section("content")
  <center><h1>Detalhes do Livro:{{$book->title}}</h1></center>
  <h3>
    <ul>
      <li><b>Autor:</b>{{$book->author}}</li>
      <li><b>Título:</b>{{$book->title}}</li>
      <li><b>ISBN:</b>{{$book->isbn}}</li>
      <li><b>Lido:</b>{{Form::checkbox("readed",1,$book->readed,array("disabled"))}}</li>
      <li><b>Desejado:</b>{{Form::checkbox("desired",1,$book->desired,array("disabled"))}}</li>
    </ul>
  </h3>
@stop
