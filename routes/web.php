<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Models\Categoria;
use App\Models\Juncao;
use App\Models\User;



    Route::get('/{str}', function ($str) {
    // return view('welcome');
    // return User::where('USUA_id', '>', 6000)->where('USUA_id', '<', 10000)->searchable();

    return User::search($str)->get();//->paginate(15);//whereHas('filho')->with('filho')->find(1);

    // return Categoria::with('filho')->find(1);//whereHas('filho')->with('filho')->find(1);
    // return Juncao::with('pai','mae', 'filhos')->find(1);
    // --
    // ----

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
