@extends("layouts.app")
    @section("title","Novo Perfil")
    @section("content")
        <form class="form form-group"
        method="POST"
        action="{{ empty($profile) ? route('profiles.store') : route ('profiles.update',$profile) }}">
        @csrf()
        @if(!empty($profile))
            method("PUT")
        @endif
            <label>{{ __("Profile")}}</label>
            <select name="profile" class="">
                {{-- Ação de cadastrar um perfil novo--}}


                    <option value="admin"
                    {{
                         empty($profile)?:!strcasecmp($profile->type,'admin')?'selected':''
                    }}>admin</option>
                    <option value="usuario"
                    {{
                        empty($profile)?:!strcasecmp($profile->type,'usuario')?'selected':''
                    }}>usuário</option>

            </select>
            <br>
                <fieldset class="form-group">
                    <legend>Dados pessoais</legend>
                    <label>Nome:</label>
                    <input type="text" disabled name="name" class="form form-control" value="{{Auth::user()->name}}"/>
                    <label>Usuário:</label>
                    <input type="text" name="email"disabled class="form form-control" value="{{Auth::user()->email}}">
                </fieldset>
            <button type="submit" class="form form-control btn btn-primary">Criar Perfil</button>
        </form>
    @endsection
