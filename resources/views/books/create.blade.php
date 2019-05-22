@extends("layouts.app")
@section("headerStyles")
    @parent
@endsection
@section("content")
{{-- Variável errors vem da Classe books--}}
    <div class="row">
        <form class="col s12"
        action="{{ empty ($book) ? route('books.store') : route ('books.update',$book) }}"
        method="post">
        @if(!empty($book))
          @method("PUT")
        @endif
        @csrf()
        <div class="row">
            <div class="input-field col s6">
                <label>Autor</label>
                {{-- operador coalesia '??'/ retornar o próprio valor testado, caso for verdadeiro --}}
                <input type="text" class="@error('author') invalid @enderror" name="author"
                value="{{old('author',$book->author ?? '')}}"
                />
                @error("author")
                    <span class="red-text text-darken-1">
                        {{ __($message)}}
                    </span>
                @enderror
            </div>
            <div class="input-field col s6">
                <label>Título</label>
                <input type="text" class="@error('title') invalid @enderror" name="title"
                value="{{old('title',$book->title ?? '' )}}"
                />
                @error("title")
                    <span class="red-text text-darken-1">
                        {{ __($message)}}
                    </span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="input-field col s4">
                <label>ISBN</label>
                <input type="text" class="@error('isbn') invalid @enderror" name="isbn"
                value="{{old('isbn',$book->isbn ?? '')}}"
                />
                @error("isbn")
                    <span class="red-text text-darken-1">
                        {{ __($message)}}
                    </span>
                @enderror
            </div>
            <div class="col s8 m8">
                <button type="submit" class="btn waves-effect waves-light btn-large">
                    {{ empty($book) ? "Cadastrar":"Atualizar" }}
                </button>
            </div>

        </div>


      </form>
    </div>

@stop
