<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield("title","Home Page")</title>

    @section("headerStyles")
            <!--Import Google Icon Font-->
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <!--Import materialize.css-->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    @show

</head>
<body>

    <div>
        <!-- Book Dropdown Structure -->
        <ul id="dropdown-book" class="dropdown-content">
            <li>
                <a href="{{ route('books.index') }}">
                    <span>{{ __("Books")}}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('books.create') }}">
                    <span>{{ __('Insert') }}</span>
                </a>
            </li>
        </ul>
        <!-- User Dropdown Structure -->
        <ul id="dropdown-user" class="dropdown-content">
            <li>
                <a  href="{{ route('users.index') }}">
                    <span>{{ __("Users")}}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('users.create') }}">
                    <span>{{ __("Insert")}}</span>
                </a>
            </li>
        </ul>
        <!-- User Login Dropdown Structure -->
        <ul id="dropdown-user-login" class="dropdown-content">
            <li>
                <a  id="logout" href="#">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            <li>
                <a  href="{{route('books.mybooks.index')}}">
                    {{ __("My Books")}}
                </a>
            </li>
            <li>
                <a  href="{{ route('profiles.index')}}">
                    {{ __("My Profiles")}}
                </a>
            </li>
            <li>
                <a  href="{{ route('profiles.create') }}">
                    {{ __("Create Profile")}}
                </a>
            </li>
        </ul>
        <nav>
            <div class="nav-wrapper">
                <a class="brand-logo" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <ul class="right hide-on-med-and-down">
                    <!-- Authentication Links -->
                    @guest
                        <li >
                            <a  href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @if (Route::has('register'))
                        <li >
                            <a  href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                    @else

                        <li>
                            <a  class="dropdown-button" href="#" data-activates="dropdown-book">
                                <span>{{ __("Books")}}</span>
                            </a>

                        </li>

                        <li>
                            <a class="dropdown-button" href="#"  data-activates="dropdown-user">
                                <span>{{ __('Users')}}</span>
                            </a>

                        </li>

                        <li>
                            <a class="dropdown-button" href="#"  data-activates="dropdown-user-login">
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                        </li>
                @endguest
            </ul>

        </div>
    </nav>

    <main >
        <div class="container-fluid">
            @if(!empty(Auth::user()))
                @if(!strcasecmp(session("profile")->type,"admin"))
                    <div class="card-panel">
                        <span class="red-text text-darken-4"><strong><center>{{ __("Running as administrator!")}}</center></strong></span>
                    </div>
                @endif
            @endif
            @yield('content')
        </div>
    </main>
</div>
    @section("footerScripts")
        <!--JavaScript at end of body for optimized loading-->
        <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){

            $(".dropdown-button").dropdown({hover:false});
            $("#logout").on("click",function(){
                event.preventDefault();
                $("#logout-form").submit();
            });
        });
        </script>
    @show
</body>
</html>
