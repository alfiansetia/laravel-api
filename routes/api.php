<?php

use App\Http\Controllers\Api\Wilayah\KabupatenController;
use App\Http\Controllers\Api\Wilayah\KecamatanController;
use App\Http\Controllers\Api\Wilayah\KelurahanController;
use App\Http\Controllers\Api\Wilayah\ProvinsiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('wilayah')->group(function () {
    Route::get('/provinsi', [ProvinsiController::class, 'index']);
    Route::get('/provinsi/{id}', [ProvinsiController::class, 'show']);
    Route::get('/kabupaten', [KabupatenController::class, 'index']);
    Route::get('/kabupaten/{id}', [KabupatenController::class, 'show']);
    Route::get('/kecamatan', [KecamatanController::class, 'index']);
    Route::get('/kecamatan/{id}', [KecamatanController::class, 'show']);
    Route::get('/kelurahan', [KelurahanController::class, 'index']);
    Route::get('/kelurahan/{id}', [KelurahanController::class, 'show']);
});
