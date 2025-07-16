<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;


Route::apiResource('tareas', TaskController::class);
