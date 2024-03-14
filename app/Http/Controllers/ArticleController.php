<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreArticlesRequest;

class ArticleController extends Controller
{


    public function articoli(){
        $articoli = Article::latest()->paginate(6);
        return view('articoli',compact('articoli'));
    }

    public function articolo($id){
        //$articolo = Article::where('id','=',$id)->first();
        $articolo = Article::findOrFail($id);
        return view('articolo',compact('articolo'));
    }

    public function articoliPerCategoria(Category $category){
        $articoli = $category->articles()->paginate(6);
        $name=$category->name;
        //$articoli = Article::where('category_id','=',$category_id);
        return view('articoli',compact('articoli','name'));
    }

    public function articoliPerUtente(User $user){
        $articoli = $user->articles()->paginate(6);
        $name=$user>name;
        return view('articoli',compact('articoli','name'));
    }

    public function create(){
        return view('articoli.create');
    }

    public function store(StoreArticlesRequest $request){

        if($request->hasFile('image')){

            if($request->file('image')->isValid()){

                $article = Article::create([
                    'title'=>$request->input('title'),
                    'content'=>$request->input('content'),
                    'category_id'=>$request->input('category_id'),
                    'user_id'=>Auth::user()->id
                ]);

                $article->image = $request->file('image')->storeAs('public/articles' .$article->id, 'cover.jpg');
                $article->save();


            }else{
                return 'Immagine non valida';
            }
        }else{
            Article::create([
                'title'=>$request->input('title'),
                'content'=>$request->input('content'),
                'category_id'=>$request->input('category_id'),
                'user_id'=>Auth::user()->id
            ]);
        }

        return redirect()->back()->with(['success'=>'Articolo salvato con successo']);

        //$validator = Validator::make($request->all(),
        //[
        //    'title'=>'required|max:50',
        //    'content'=> 'required|max:500'
        //],
        //[
        //    'title.required'=>'il titolo non è corretto',,
        //    'title.max'=>'il titolo non è corretto',
        //    'content.required'=>'il contenuto è richiesto',
        //    'content.max'=>'il contenuto è troppo lungo'
        //]
        //);

        //if($validator->fails()){
        //    return redirect()->back()->withErrors($validator)->withInput;
        //}else{
        //    Article::create($request->all());
        //}

        //Article::create([
        //    'title'=>$request->input('title'),
        //    'content'=>$request->input('content')
        //]);

    }
}
