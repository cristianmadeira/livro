@extends("layouts.app")
@section("title","Livros")

@section("content")
  <script type="text/javascript">
      function submitMethodDelete(){
        //Cancela o evento padrão(get)
        event.preventDefault();
        document.getElementById("form-books").submit();
      }
  </script>
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
        <th>Lido</th>
        <th>Desejado</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @forelse($books as $book)
        <tr class="{{$book->pivot->readed ? 'success' :''}}">
          <td>{{$book->author}}</td>
          <td>{{$book->title}}</td>
          <td>{{$book->isbn}}</td>
          <td>{{ Form::checkbox("readed",1,$book->pivot->readed,array("disabled")) }}</td>
          <td >{{ Form::checkbox("desired",1,$book->pivot->desired,array("disabled")) }}</td>
          <td>
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
            <span>Nenhum livro lido ou desejado!</span>
        </div>
      @endforelse
    </tbody>
    <tfoot>
      <tr>
        <th>Autor</th>
        <th>Título</th>
        <th>ISBN</th>
        <th>Lido</th>
        <th>Desejado</th>
        <th>Ações</th>
      </tr>
    </tfoot>
  </table>

@stop
