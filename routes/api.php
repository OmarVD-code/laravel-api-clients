<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Router;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PaymentController;

Route::apiResource('clients', ClientController::class);
Route::apiResource('payments', PaymentController::class);
Route::post('custom', 'App\Http\Controllers\ClientController@customMethod');
Route::get('counter', 'App\Http\Controllers\CounterController@index');
Route::put('counter/{counter_id}', 'App\Http\Controllers\CounterController@update');