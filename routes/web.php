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

// Route::get('/', function () {
//     return view('welcome');
// });

//Auth
Route::get('login', 'Auth\LoginController@showlogin')->name('login');
Route::post('login', 'Auth\LoginController@login');

Route::middleware('auth')->group(function() {
    Route::view('/', 'home');
    Route::view('/protected', 'protected');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    //Dataset
    Route::get('/dataset', 'Dataset\DatasetController@index')->name('dataset');
    Route::post('/importdataset', 'Dataset\DatasetController@datasetimportexcel');
    Route::post('/tambahdataset', 'Dataset\DatasetController@store');
    Route::post('/ubahdataset/{id}', 'Dataset\DatasetController@update');
    Route::get('/hapusdata/{id}', 'Dataset\DatasetController@destroy');
    Route::get('/hapusdataset', 'Dataset\DatasetController@deleteall');

    //Perhitungan
    Route::get('/inisialisasi', 'Perhitungan\PerhitunganController@index')->name('inisialisasi');
    Route::get('/hasil', 'Perhitungan\PerhitunganController@hasil')->name('hasil');
    Route::post('/proses', 'Perhitungan\PerhitunganController@proses')->name('proses');
});
