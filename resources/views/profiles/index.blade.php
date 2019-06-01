@extends("layouts.app")
    @section("title","Perfis")
    @section("content")
    <!--Book Modal Structure-->
    <div class="modal" id="modal-profile">
        <div class="modal-content">

        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">
                <i class="small material-icons">check</i>OK
            </a>
        </div>
    </div>

    @if($errors->any())
    <div class="card-panel">
        <ul>
            @foreach($errors->all() as $error)
                <li><span class="red-text text-darken-1">{{ __($error)}}</span></li>
            @endforeach
        </ul>
    </div>
    @endif
    @if(!empty(session('message')))
    <div class="card-panel">
        <span class="green-text text-green-1">{{session('message')}}</span>
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
                                <i class="smal material-icons">edit</i>
                            </a>&nbsp;&nbsp;&nbsp;&nbsp;

                            <a href="#modal-profile" class="modal-trigger" onclick="showModal({{$profile}});">
                                <i class="small material-icons">search</i>
                            </a>
                            <a  href="" onclick="submitMethodDelete()">
                                <i class="small material-icons">delete</i>
                            </a>
                            <form id="profile-form" method="POST" action="{{ route ('profiles.destroy',$profile->id)}}">
                                @csrf()
                                @method("DELETE")

                            </form>
                        </td>
                    </tr>
                @empty
                    <div class="card-panel">
                        <span class="red-text text-darken-1"><strong>Não há perfis</strong></span>
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
    @section("footerScripts")
        @parent
        <script type="text/javascript">
            $(document).ready(function(){
                $(".modal").modal();
            });
            function submitMethodDelete(){
                event.prevenDefault();
                document.getElementyById("profile-form").submit();
            }
            function showModal(profile){
                $(document).ready(function(){

                    $.ajax({
                        method:"GET",
                        url:"http://library.com.br/profiles/"+profile.id,
                        success:function(response){
                            $(".modal-content").html(response);
                        }

                    });
                });
            }

        </script>
    @endsection
