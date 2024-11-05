<?php

use App\Http\Controllers\AsesorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\PredictController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/registrar-ingreso', [IncomeController::class, 'index'])->name('registrar-ingreso');
Route::post('/save-ingreso', [IncomeController::class, 'save_ingreso'])->name('save-ingreso');
Route::get('/registrar-egreso', [ExpenseController::class, 'index'])->name('registrar-egreso');
Route::post('/save-egreso', [ExpenseController::class, 'save_egreso'])->name('save-egreso');

Route::get('/historico-ingreso', [IncomeController::class, 'history'])->name('historico-ingreso');
Route::get('/historico-egreso', [ExpenseController::class, 'history'])->name('historico-egreso');

Route::get('/user', function () {
    var_dump(auth()->id());
})->name('user');

Route::get('auto-login', [AuthController::class, 'autoLogin']);

Route::prefix('expense')->group(function () {
    Route::post('save', [ExpenseController::class, 'save']);
    Route::get('/', [ExpenseController::class, 'get']);
});

Route::prefix('predict')->group(function () {
    Route::get('sub_category', [PredictController::class, 'predictSubcategory']);
    Route::get('expense', [PredictController::class, 'predictExpense']);
    Route::get('year_expenses', [PredictController::class, 'predictYearExpenses']);
});

Route::get('percentages', [AsesorController::class, 'percentages']);

Route::post('expense_sub_categories', [ExpenseController::class, 'expense_sub_categories']);

Route::get('delete-egreso/{id}', [ExpenseController::class, 'delete_egreso']);
Route::get('edit-egreso/{id}', [ExpenseController::class, 'edit_egreso']);
Route::post('update-egreso', [ExpenseController::class, 'update_egreso']);

Route::get('delete-ingreso/{id}', [IncomeController::class, 'delete_ingreso']);
Route::get('edit-ingreso/{id}', [IncomeController::class, 'edit_ingreso']);
Route::post('update-ingreso', [IncomeController::class, 'update_ingreso']);