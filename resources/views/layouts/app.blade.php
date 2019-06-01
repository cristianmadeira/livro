<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--Include Page styles -->
@include("layouts.header")
<body>
    @include("layouts.navbar")
    <main>
        <div class="container">
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
    @section("footerScripts")
        <!--JavaScript at end of body for optimized loading-->
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    @show
    <script type="text/javascript">
        $(document).ready(function(){
            $(".dropdown-button").dropdown({hover:false});
            $("#logout").on("click",function(){
                event.preventDefault();
                $("#logout-form").submit();
            });
        });
    </script>
</body>
</html>
