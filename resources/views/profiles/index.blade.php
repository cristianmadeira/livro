@extends("layouts.app")
    @section("title","Perfis")
    <script type="text/javascript">
        function submitMethodDelete(){
            event.prevenDefault();
            document.getElementyById("profile-form").submit();
        }
    </script>
    @section("content")
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                            <li><span><strong>{{ __($error)}}</strong></span></li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session("message"))
            <div class="alert alert-success">
                <span><strong>{{ __session("message")}}</strong></span>
            </div>
        @endif
      <table class="responsive-table bordered  highlight">

            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Criação</th>
                    <th>Alteração</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($profiles as $profile)
                    <tr>
                        <td>{{ __($profile->type)}}</td>
                        <td>{{ ($profile->created_at)}}</td>
                        <td>{{ ($profile->updated_at)}}</td>
                        <td>
                            <a href="{{ route('profiles.edit',$profile)}}">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a  href="" onclick="submitMethodDelete()">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                            <form id="profile-form" method="POST" action="{{ route ('profiles.destroy',$profile->id)}}">
                                @csrf()
                                @method("DELETE")

                            </form>
                        </td>
                    </tr>
                @empty
                    <div class="alert alert-danger">
                        <span><strong>Não há perfis</strong></span>
                    </div>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th>Tipo</th>
                    <th>Criação</th>
                    <th>Alteração</th>
                    <th>Ações</th>
                </tr>
            </tfoot>
        </table>

    @endsection
