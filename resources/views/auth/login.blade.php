@extends('layouts.app')
@section("title","Login")
@section('content')
    <div class="row">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="row">
                <div class="input-field col s6">
                    <input id="email" type="email" class="@error('email') invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    @error('email')
                        <span class="red-text text-darken-1">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-field col s6">

                    <input id="password" type="password" class="@error('password') invalid @enderror" name="password" required autocomplete="current-password">
                    <label for="password" class="">{{ __('Password') }}</label>
                    @error('password')
                        <span class="red-text text-darken-1">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <select name="profile" class="@error('profile')invalid @enderror">
                        <option value="" disabled selected>{{ __("Choose  your option")}}</option>
                        <option value="admin">Admin</option>
                        <option value="usuario">Usuário</option>
                    </select>
                    <label for="type">{{ __('Profile')}}</label>
                    @error('profile')
                        <span class="red-text text-darken-1">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row">

            </div>

            <div class="row">
                <input class="filled-in" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>


            <div class="row">
                <button type="submit" class="btn" style="width:100%;">
                    {{ __('Login') }}
                </button>
            </div>
            <div class="row" >
                @if (Route::has('password.request'))
                    <a class="btn"style="width:100%;" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </form>
    </div>
@section("footerScripts")
    @parent
    <script type="text/javascript">
        $(document).ready(function(){
            $('select').material_select();
        });
    </script>
@endsection
@endsection
