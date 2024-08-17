<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('permissions', \App\Http\Controllers\PermissionController::class);
Route::resource('roles', \App\Http\Controllers\RoleController::class);
Route::resource('users', \App\Http\Controllers\UserController::class);
Route::get('roles/{id}/give-permissions', [\App\Http\Controllers\RoleController::class, 'givePermissionsToRole']);
Route::put('roles/{id}/give-permissions', [\App\Http\Controllers\RoleController::class, 'updatePermissionsToRole']);
