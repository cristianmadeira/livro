@extends("layouts.app")
@section("title","Usuários")
@section("content")
  <script type="text/javascript">
    function submitMethodDelete(){
      event.preventDefault();
      document.getElementById("users-form").submit();
    }
  </script>
  @if(session('message'))
    <div class="{{ session('error') ? 'alert alert-danger' : 'alert alert-success'}}">
      <span>{{session('message')}}</span>
    </div>
  @endif
  <table class="responsive-table bordered  highlight">

    <thead>
      <tr>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Telefone</th>
        <th>Celular</th>
        <th>Criação</th>
        <th>Alteração</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>

    @forelse($users as $user)
      <tr>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->contact["phone"]}}</td>
        <td>{{$user->contact["cell_phone"]}}</td>
        <td>{{$user->created_at}}</td>
        <td>{{$user->updated_at}}</td>
        <td>
          <a href="{{ route('users.show',$user)}}">
            <span class="glyphicon glyphicon-search"></span>
          </a>&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="{{ route ('users.edit',$user) }}">
            <span class="glyphicon glyphicon-edit"></span>
          </a>&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="#" onclick="submitMethodDelete()">
            <span class="glyphicon glyphicon-trash"></span>
          </a>&nbsp;&nbsp;&nbsp;&nbsp;
          <form id="users-form" action="{{ route ('users.destroy',$user) }} " method="post" >
              @csrf()
              @method("DELETE")

          </form>
        </td>
      </tr>

    @empty
      <div class="alert alert-danger">
        <span>Nenhum Usuário cadastrado</span>
      </div>
    @endforelse
    </tbody>
    <tfoot>
      <tr>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Telefone</th>
        <th>Celular</th>
        <th>Criação</th>
        <th>Alteração</th>
        <th>Ações</th>
      </tr>
    <tfoot>
  </table>
@stop
