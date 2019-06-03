@extends("layouts.app")
@section("title","Livros")

@section("content")

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
        <th>Lido</th>
        <th>Desejado</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      @forelse($books as $book)
        <tr>
          <td>{{$book->author}}</td>
          <td>{{$book->title}}</td>
          <td>{{$book->isbn}}</td>
            <td>

                <input name="readed"  id="{{'readed'.$book->id}}" type="checkbox" disabled  {{ ($book->pivot->readed?'checked':'')}} class="filled-in" />
                <label for="{{'readed'.$book->id}}" class="form-check-label">Lido</label>

            </td>
            <td>
                <input name="desired" id="{{'deserided'.$book->id}}" disabled type="checkbox" {{ ($book->pivot->desired?'checked':'')}} class="filled-in" />
                <label for="{{'deserided'.$book->id}}" class="form-check-label">Desejado</label>

            </td>

          <td>

            <a href="{{route('books.destroy',$book->id)}}">
              <i class="material-icons" onclick="submitMethodDelete();">delete</i>
            </a>
            <form id="form-books" method="POST"
            action="{{ route ('books.mybooks.destroy',$book->id)}}">
                @method("DELETE")
                @csrf()
            </form>
          </td>
        </tr>
      @empty
          <div class="card-panel">
              <span class="red-text text-darken-4">Nenhum livro Lido ou desejado!</span>
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

    @section("footerScripts")
        @parent
          <script type="text/javascript">
              function submitMethodDelete(){
                //Cancela o evento padrão(get)
                event.preventDefault();
                document.getElementById("form-books").submit();
              }
          </script>
      @endsection
@stop
