@extends("layouts.app")
@section("title","Usuários")
@section("content")
    <form class="form-group"
        action="{{empty($user)? route ('users.store') : route ('users.update',$user) }}"
        method="POST"
    >
    @csrf()
    @if(!empty($user))
        @method("PUT")
    @endif
    <div class="row">
        <div class="input-field col s6">
            <input type="text" name="name" class="@error('name') invalid @enderror" id="name" value="{{old('name',$user->name ?? '')}}"/>
            <label for="name">Nome</label>
            @error('name')
                <span class="red-text text-darken-1">
                    <strong>{{ $message}}</strong>
                </span>
            @enderror
        </div>
        <div class="input-field col s6">
            <input type="email" name="email" id="email" class="@error('email') invalid @enderror" value="{{old('email',$user->email ?? '')}}"/>
            <label for="email">E-mail</label>
            @error('email')
                <span class="red-text text-darken-1">
                    <strong>{{ $message}}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="input-field col s6">
            <input type="text" name="phone" id="phone" class="@error('phone') invalid @enderror" value="{{old ('phone',$user->contact->phone ?? '')}}"/>
            <label>Telefone</label>
            @error('phone')
                <span class="red-text text-darken-1">
                    <strong>{{ $message}}</strong>
                </span>
            @enderror
        </div>
        <div class="input-field col s6">
            <label>Celular</label>
            <input type="text" name="cell_phone" class="form form-control" value="{{old ('cell_phone',$user->contact->cell_phone ?? '')}}"/>
        </div>
    </div>
    

    <div class="row">
        <div class="input-field col s6">
            <label>Senha</label>
            <input type="password" name="password" class="form form-control" value=""/>

        </div>
        <div class="input-field col s6">
            <label>Confirmar Senha</label>
            <input type="password" name="password_confirmation" class="form form-control" value=""/>
        </div>
    </div>
    <div class="row">
        <button type="submit" class="btn" style="width:100%;">
        {{empty($user)? 'Cadastrar': 'Atualizar'}}
        </button>
    </div>

</form>
    @section("footerScripts")
        @parent
        <script type="text/javascript">
            $(document).ready(function(){
                $("select").material_select();
            });
        </script>
    @endsection

@stop
