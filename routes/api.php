<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');

Route::group(['middleware' => ['jwt.verify']], function ()
{
    Route::get('kelas', 'KelasController@show');
    Route::get('kelas/{id}', 'KelasController@detail');
    Route::post('kelas', 'KelasController@store');  
    Route::put('kelas/{id}', 'KelasController@update');
    Route::delete('kelas/{id}', 'KelasController@destroy');
    
    Route::get('siswa', 'SiswaController@show');
    Route::get('siswa/{id}', 'SiswaController@detail');
    Route::post('siswa', 'SiswaController@store');
    Route::put('siswa/{id}', 'SiswaController@update');
    Route::delete('siswa/{id}', 'SiswaController@destroy');

    Route::get('buku', 'BukuController@show');
    Route::get('buku/{id}', 'BukuController@detail');
    Route::post('buku', 'BukuController@store');
    Route::put('buku/{id}', 'BukuController@update');
    Route::delete('buku/{id}', 'BukuController@destroy');

    Route::post('pinjam', 'TransaksiController@pinjamBuku');
    Route::get('pinjam', 'TransaksiController@showPinjamBuku');

    Route::get('dpinjam/{id}', 'TransaksiController@detPinjamBuku');
    Route::post('dpinjam/{id}','TransaksiController@tambahItem');

    Route::post('kembali', 'TransaksiController@kembaliBuku');
    Route::get('kembali/{id}', 'TransaksiController@detKembaliBuku');
});

    // Route::get('bookall', 'BukuController@bookAuth')->middleware('jwt.verify');
    // Route::get('user', 'UserController@getAuthenticatedUser')->middleware('jwt.verify');

