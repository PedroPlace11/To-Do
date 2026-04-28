<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/todo', function () {
    return view('todo');
});

require __DIR__.'/tasks.php';
