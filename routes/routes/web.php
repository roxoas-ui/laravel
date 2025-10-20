<?php

use Illuminate\Support\Facades\Route;
use App\Models\License;

Route::get('/', function () { return redirect('/licenses'); });

Route::get('/licenses', function () {
    $licenses = License::limit(50)->get();
    return view('licenses.index', ['licenses' => $licenses]);
});

Route::get('/licenses/upload', function () {
    return view('licenses.upload');
});
