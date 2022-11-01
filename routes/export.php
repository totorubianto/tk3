<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Export\AdministratorController;
use App\Http\Controllers\Export\StudentController;
use App\Http\Controllers\Export\CashTransactionController;
use App\Http\Controllers\Export\CashTransactionReportController;

Route::get('/administrators/export', AdministratorController::class)->name('administrators.export');
