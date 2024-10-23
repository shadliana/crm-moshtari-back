<?php

use Illuminate\Support\Facades\Route;
Route::get("/22", function (){
    dd("2121212121");
});
Route::get('/', function () {
    return view('welcome');
});
