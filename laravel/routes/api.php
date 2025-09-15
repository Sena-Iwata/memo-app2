<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemoController;
Route::apiResource('memos', MemoController::class);
