<?php

use App\Models\Article;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;


Route::get('/',[PageController::class,'home'])->name('home');

Route::get('/chi-siamo',[PageController::class,'chisiamo'])->name('chisiamo');


Route::get('/contacts',[PageController::class,'contatti'])->name('contacts');


Route::get('/contact/{id}',[PageController::class,'contatto'])->name('contact');

Route::get('/articoli',[ArticleController::class,'articoli'])->name('articoli');

Route::get('/articolo/{id}',[ArticleController::class,'articolo'])->name('articolo');

Route::get('/articoliPerCategoria/{category}',[ArticleController::class,'articoliPerCategoria'])->name('articoliPerCategoria');

Route::get('/articoliPerUtente/{user}',[ArticleController::class,'articoliPerUtente'])->name('articoliPerUtente');

Route::get('/seeder', function(){
    Article::create([
        'title'=>'Articolo 1',
        'content'=>'Testo 1'
    ]);
    Article::create([
        'title'=>'Articolo 2',
        'content'=>'Testo 2'
    ]);
});

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/articles/create',[ArticleController::class,'create'])->name('article.create');

    Route::post('/articles/store',[ArticleController::class,'store'])->name('article.store');
});


Route::resource('categories',CategoryController::class);

