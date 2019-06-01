@extends("layouts.app")
    @section("title","Novo Perfil")
    @section("content")
        <div class="row">
            <form class="col s12"
            method="POST"
            action="{{ empty($profile) ? route('profiles.store') : route ('profiles.update',$profile) }}">
            @csrf()
            @if(!empty($profile))
                @method("PUT")
            @endif
            <div class="row">
                <div class="col s12">
                    <label for="profile">{{ __("Profile")}}</label>
                    <select name="profile" id="profile" required class="@error('profile') invalid @enderror">
                        <option value="" disabled selected>Escolha uma opção</option>
                        {{-- Ação de cadastrar um perfil novo--}}
                        <option value="admin">Admin</option>
                        <option value="usuario">Usuário</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <fieldset class="form-group">
                    <legend>Dados pessoais</legend>
                    <div class="input-field col s12">
                        <input type="text" disabled name="name" id="name" class="form form-control" value="{{Auth::user()->name}}"/>
                        <label for="name">Nome:</label>
                    </div>

                    <div class="input-field col s12">
                        <input type="text" name="email"disabled id="email" class="form form-control" value="{{Auth::user()->email}}">
                        <label for="email">E-Mail:</label>
                    </div>

                </fieldset>
            </div>
            <div class="row">
                <button type="submit" class="btn" style="width:100%;">{{ empty($profile)?'Criar':'Atualizar'}} Perfil</button>
            </div>
            </form>
        </div>
    @endsection
    @section("footerScripts")
        @parent
        <script type="text/javascript">
            $(document).ready(function(){
                $("select").material_select();
            });
        </script>
    @endsection
