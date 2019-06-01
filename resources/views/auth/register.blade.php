@extends('layouts.app')
    @section("title","Novo Login")
    @section('content')


    <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <input id="name" type="text" class="@error('name') invalid @enderror" name="name"
                    value="{{ old('name') }}"  autocomplete="name" autofocus>
                    <label for="name">{{ __('Name') }}</label>
                    @error('name')
                        <span class="red-text text-darken-1">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
            </div>

        <div class="row">
            <div class="input-field col s6">
                <label for="email">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="@error('email') invalid @enderror" name="email" value="{{ old('email') }}"   autocomplete="email">

                @error('email')
                    <span class="red-text text-darken-1">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col s6">
                <label for="profile">
                    {{ _('Profile')}}
                </label>
                <select class="@error('profile') invalid @enderror"  name="profile">
                    <option value="" disabled selected>{{ __("Choose  your option")}}</option>
                    <option value="admin">admin</option>
                    <option value="usuario">usuário</option>
                </select>

                @error('profile')
                    <span class="red-text text-darken-1">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="input-field col s6">
                <input type="text" class="form-control @error('phone')invalid @enderror"
                name="phone" value="{{old('phone')}}"/>
                <label for="phone">
                    {{ __('Phone')}}
                </label>
                @error('phone')
                    <span class="red-text text-darken-1">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="input-field col s6">
                <input type="text" class="form-control" name="cell_phone" value="{{old('cell_phone')}}"/>
                <label for="cell_phone">
                    {{ __('Cell Phone')}}
                </label>

                @error('cell_phone')
                    <span class="red-text text-darken-1">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input id="password" type="password" class="@error('password')invalid @enderror" name="password"   autocomplete="new-password">
                <label for="password">{{ __('Password') }}</label>

                @error('password')
                    <span class="red-text text-darken-1">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>


            <div class="input-field col s6">
                <input id="password-confirm" type="password"  name="password_confirmation"   autocomplete="new-password">
                <label for="password-confirm">{{ __('Confirm Password') }}</label>
            </div>
        </div>

        <div class="row">

            <button type="submit" class="btn" style="width:100%;">
                {{ __('Register') }}
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

@endsection
