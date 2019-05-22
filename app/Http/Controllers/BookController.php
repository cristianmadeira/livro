<?php

namespace Laravel\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Book;
use Laravel\User;
use Laravel\Http\Requests\BooksRequest;
use Illuminate\Support\Facades\Auth;
class BookController extends Controller
{
  /*
      Funções:
      index=lista os books
      create=retorna o formulário de books
      show=lista apenas um Book
      update=atualiza um Book
      destroy=exclui um Book
  */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("books.index")->with("books",Book::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("books.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BooksRequest $request)
    {
        //
        Book::create($request->except(array("readed","desired")));
        $error=false;
        $message="O Livro $request->title foi adicionado com sucesso!";
        return redirect("books")
        ->with(
            array("error"=>$error,"message"=>$message)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        return view("books.show")->with("book",Book::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view("books.create")->with("book",Book::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BooksRequest $request, Book $book)
    {
          $book->update($request->all());
          $error=false;
          $message="O Livro $request->title atualizado com sucesso!!!";

        return redirect("books")
        ->with(
          array("error"=>$error,"message"=>$message)
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $book=Book::findOrFail($id);
        if(empty($book)){
          $error=true;
          $message="Error ao excluir o Livro:Livro inexistente";
        }
        else{
          $book->delete();
          $error=false;
          $message="Livro excluído com sucesso!";
        }
        return redirect("books")
        ->with(
            array("error"=>$error,"message"=>$message)

        );
    }

    public function myBooks(){
      //$userId=Auth::user()->id;
      /*$books=Book::whereHas("users",function($query) use($userId){
        $query->where("user_id",$userId);
      } )->get();*/
      //$books=User::with("books")->get();
      //$books=Book::with("users")->get();
      //return response()->json($books);
      $user=Auth::user();
      $books=$user->books()->wherePivot("user_id","=",$user->id)->get();

      return view("books.mybooks")->with("books",$books);
  }
    public function setBookReadedOrDesired(Request $request, Book $book){
        $user=Auth::user();
        $books=$user->books()->wherePivot("user_id","=",$user->id)->wherePivot("book_id","=",$book->id)->get();
        $data=[];
        $message="";
        //return response()->json(["readed"=>$books[0]->pivot->readed == $request->get("readed")]);
        if($books[0]->pivot->readed  && $books[0]->pivot->desired){
            return redirect("books")->withErrors("Livro já lido e desejado!");
        }else{
            if($request->get("desired") != 0){
                $message="Livro marcado como desejável com sucesso!";
                $data=array("desired"=>$request->get("desired"));
            }


            if($request->get("readed") != 0 ){
                $message="Livro marcado como lido com sucesso!";
                $data=array("readed"=>$request->get("readed"));
            }

            $user->books()->sync([$book->id =>$data]);
            return redirect("books")->with(["error"=>false,"message"=>$message]);
        }
    }
}
