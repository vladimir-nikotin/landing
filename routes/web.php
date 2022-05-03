<?php

use Illuminate\Support\Facades\Route;
use Vladi\Landing\Http\Controllers\ShowActivityController;

Route::get('/admin/activity', [ShowActivityController::class, 'handle']);
