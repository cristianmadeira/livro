@extends("layouts.app")
@section("content")
  <center><h4>Detalhes do Perfil:{{$profile->user->name ?? ''}}</h4></center>
  <h6>
    <ul>
      <li><b>Name:</b>{{$profile->user->name ?? ''}}</li>
      <li><b>E-Mail:</b>{{$profile->user->email ?? ''}}</li>
      <li><b>Tipo:</b>{{$profile->type ?? ''}}</li>
    </ul>
</h6>
@stop
