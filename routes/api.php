<?php

use App\Http\Controllers\BoloClienteController;
use App\Http\Controllers\BoloController;
use App\Http\Controllers\ClienteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::apiResources([
    'bolos' => BoloController::class,
    'clientes' => ClienteController::class,
    'bolo_clientes' => BoloClienteController::class
]);
