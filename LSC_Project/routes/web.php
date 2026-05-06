<?php

use Illuminate\Support\Facades\Route;
use App\Models\Service;

Route::get('/', function () {
    $services = Service::all();
    return view('welcome', compact('services'));
});
