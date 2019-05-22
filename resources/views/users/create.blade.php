@extends("layouts.app")
@section("title","Usuários")
@section("content")
  @if(count($errors)>0)
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
          <li>
            {{$error}}
          </li>
        @endforeach
      </ul>
    </div>
  @endif
  <form class="form form-group"
  action="{{empty($user)? route ('users.store') : route ('users.update',$user) }}"
  method="POST"
  >
    @csrf()
    @if(!empty($user))
      @method("PUT")
    @endif
    <label>Nome</label>
    <input type="text" name="name" class="form form-control" value="{{old('name',$user->name ?? '')}}"/>
    <label>E-mail</label>
    <input type="email" name="email" class="form form-control" value="{{old('email',$user->email ?? '')}}"/>
    <label>Telefone</label>
    <input type="text" name="phone" class="form form-control" value="{{old ('phone',$user->contact->phone ?? '')}}"/>
    <label>Celular</label>
    <input type="text" name="cell_phone" class="form form-control" value="{{old ('cell_phone',$user->contact->cell_phone ?? '')}}"/>
    <label for="profile" class="col-form-label">
          {{ _('Profile')}}
    </label>

    <select class="form-control"  name="profile">
        <option value="admin"
          @if(!empty($user))
           {{ strcasecmp($user->profiles()->find($user->id)->type,'admin')==0 ?'selected':'' }}
          @endif
         >admin</option>
        <option value="usuario"
          @if(!empty($user))
            {{ strcasecmp($user->profiles()->find($user->id)->type,"usuario")==0 ?'selected':'' }}
          @endif
        >usuário</option>
    </select>


    <label>Senha</label>
    <input type="password" name="password" class="form form-control" value=""/>
    <label>Confirmar Senha</label>
    <input type="password" name="password_confirmation" class="form form-control" value=""/>
    <br>
    <button type="submit" class="form form-control btn btn-primary">
      {{empty($user)? 'Cadastrar': 'Atualizar'}}
    </button>

  </form>

@stop
