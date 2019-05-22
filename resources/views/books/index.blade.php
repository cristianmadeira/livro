@extends("layouts.app")
@section("title","Livros")

@section("content")

  @if($errors->any())
    <div class="">
        <ul>
            @foreach($errors->all() as $error)
                <li><span>{{ __($error)}}</span></li>
            @endforeach
        </ul>
    </div>
  @endif
  @if(!empty(session('message')))
    <div class="{{session('error')? 'alert alert-danger' : 'alert alert-success'}}">
        {{session('message')}}
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
      @forelse($books as $book)
        <tr class="{{$book->readed ? 'success' :''}}">
          <td>{{$book->author}}</td>
          <td>{{$book->title}}</td>
          <td>{{$book->isbn}}</td>
          <td>
              <form id="setBookReadedOrDesired-form" method="POST" action="{{ route('books.mybooks.create',$book) }}">
                  @csrf()
                  <label>Lido</label>
                  <input name="readed" type="hidden" value="0">
                  <input name="readed" type="checkbox"  value="1">
                  <label>Desejado</label>
                  <input name="desired" type="hidden"  value="0">
                  <input name="desired" type="checkbox" value="1">
                  <button type="submit" class="btn btn-primary">Marcar</button>
             </form>

            <a href="{{ route('books.show',$book->id) }}">
              <span class="glyphicon glyphicon-search"></span>
            </a>&nbsp;&nbsp;&nbsp;
            <a href="{{ route ('books.edit',$book) }}">
              <span class="glyphicon glyphicon-edit"></span>
            </a>&nbsp;&nbsp;&nbsp;
            <a href="{{route('books.destroy',$book->id)}}">
              <span class="glyphicon glyphicon-trash" onclick="submitMethodDelete();"></span>
            </a>
            <form id="form-books" method="POST"
            action="{{ route ('books.destroy',$book->id)}}">
                @method("DELETE")
                @csrf()
            </form>

          </td>
        </tr>
      @empty
        <div class="alert alert-danger">
            <span>Nenhum livro cadastrado!</span>
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
