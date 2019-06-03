@extends("layouts.app")
@section("title","Usuários")
@section("content")

    <!--Book Modal Structure-->
    <div class="modal" id="users-modal">
        <div class="modal-content">

        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">
                <i class="small material-icons">check</i>OK
            </a>
        </div>
    </div>

    @if($errors->any())
    <div class="card-panel">
        <ul>
            @foreach($errors->all() as $error)
                <li><span class="red-text text-darken-4">{{ __($error)}}</span></li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(!empty(session('message')))
    <div class="card-panel">
        <span class="green-text text-green-4">{{session('message')}}</span>
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
            <div class="row">
                <a class="waves-effect waves-light  modal-trigger" href="#users-modal" onclick="showModal({{$user}});">
                    <i  class="small material-icons">search</i>
                </a>
                <a href="{{ route ('users.edit',$user) }}">
                    <i  class="small material-icons">edit</i>
                </a>
                <a href="#" onclick="submitMethodDelete()">
                    <i  class="small material-icons">delete</i>
                </a>
                <form id="users-form" action="{{ route ('users.destroy',$user) }} " method="post" >
                    @csrf()
                    @method("DELETE")
                </form>
            </div>
        </td>
      </tr>

    @empty
        <div class="card-panel">
            <span class="red-text text-darken-4">Nenhum Usuário cadastrado!</span>
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
  @section("footerScripts")
    @parent
    <script type="text/javascript">
        $(document).ready(function(){
            $(".modal").modal();
        });
        function showModal(user){
            $(document).ready(function(){
                $.ajax({
                    type:"get",
                    url:"http://library.com.br/users/"+user.id,
                    success:function(result){
                        $(".modal-content").html(result);
                    }
                });

            });
        }
      function submitMethodDelete(){
        event.preventDefault();
        document.getElementById("users-form").submit();
      }
    </script>
  @endsection
@stop
