@extends("layouts.app")
@section("title","Livros")

@section("content")
    <!--Book Modal Structure-->
    <div class="modal" id="modal-book-show">
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
                <li><span class="red-text text-darken-4">{{ __($error)}}</span></li>
            @endforeach
        </ul>
    </div>
  @endif
  @if(!empty(session('message')))
    <div class="card-panel">
        <span class="green-text text-green-4">{{session('message')}}</span>
    </div>
  @endif
  <table class="responsive-table bordered  highlight">
    <thead>
      <tr>
        <th>Autor</th>
        <th>Título</th>
        <th>ISBN</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
        @php
            $i=0;
        @endphp
      @forelse($books as $book)
        <tr>
          <td>{{$book->author}}</td>
          <td>{{$book->title}}</td>
          <td>{{$book->isbn}}</td>
          <td>
              <div class="row">
                  <form
                        id="setBookReadedOrDesired-form"
                        method="POST"
                        action="{{ route('books.mybooks.create',$book) }}"
                        >
                      @csrf()

                      <input name="desired" id="{{'deserided'.$book->id}}" type="checkbox" class="filled-in" />
                      <label for="{{'deserided'.$book->id}}" class="form-check-label">Desejado</label>

                      <input name="readed"  id="{{'readed'.$book->id}}" type="checkbox"  class="filled-in" />
                      <label for="{{'readed'.$book->id}}" class="form-check-label">Lido</label>
                      <button type="submit" class="btn" style="width:70%;">Marcar</button>




                 </form>
            </div>
            <a class="waves-effect waves-light  modal-trigger" id="a-book-show" href="#modal-book-show"
            onclick="showModalBook({{$book}});">
              <i  class="small material-icons">search</i>
            </a>&nbsp;&nbsp;&nbsp;
            <a href="{{ route ('books.edit',$book) }}">
              <i class="small material-icons">edit</i>
            </a>&nbsp;&nbsp;&nbsp;
            <a href="{{route('books.destroy',$book->id)}}">
              <i class="small material-icons" onclick="submitMethodDelete();">delete</i>
            </a>
            <form id="form-books" method="POST"
            action="{{ route ('books.destroy',$book->id)}}">
                @method("DELETE")
                @csrf()
            </form>

          </td>
        </tr>
      @empty
        <div class="card-panel">
            <span class="red-text text-darken-4">Nenhum livro cadastrado!</span>
        </div>
      @endforelse
    </tbody>
    <tfoot>
      <tr>
        <th>Autor</th>
        <th>Título</th>
        <th>ISBN</th>
        <th>Ações</th>
      </tr>
    </tfoot>
  </table>
@section("footerScripts")
    @parent
    <script type="text/javascript">

        $(document).ready(function(){
            $(".modal").modal();
        });
        function showModalBook(book){
            $(document).ready(function(){
                $.ajax({
                    type:"get",
                    url:"http://library.com.br/books/"+book.id,
                    success:function(result){
                        $(".modal-content").html(result);
                    }
                });

            });
        }
        function submitMethodDelete(){
          //Cancela o evento padrão(get)
          event.preventDefault();
          document.getElementById("form-books").submit();
        }
        function submitSetBookReadedDesired(){
            event.preventDefault();
            document.getElementById("setBookReadedOrDesired-form").submit();
        }
    </script>
@endsection
@stop
