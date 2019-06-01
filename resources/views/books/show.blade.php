@extends("layouts.app")
@section("content")
  <center><h4>Detalhes do Livro:{{$book->title ?? ''}}</h4></center>
  <h6>
    <ul>
      <li><b>Autor:</b>{{$book->author ?? ''}}</li>
      <li><b>Título:</b>{{$book->title ?? ''}}</li>
      <li><b>ISBN:</b>{{$book->isbn ?? ''}}</li>
    </ul>
</h6>
@stop
