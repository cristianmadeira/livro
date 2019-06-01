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
</div>
