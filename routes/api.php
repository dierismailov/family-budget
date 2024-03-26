<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/family_budgets',[BudgetController::class, 'store']);
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/register',[UserController::class, 'register']);
Route::get('/users',[UserController::class, 'index']);
Route::get('/users/{user_id}',[UserController::class, 'show']);
Route::get('/users/{user_id}/budgets',[BudgetController::class, 'budgetsListUser']);
Route::post('/users/{user_id}/add_new_budget',[BudgetController::class, 'store']);
Route::get('/budgets/{budget_id}/members',[UserController::class, 'getUsersInBudget']);
Route::get('/budgets/{budget_id}/transactions',[TransactionController::class, 'getTransactionsByBudget']);
Route::post('/budgets/{budget_id}/set-limit', [BudgetController::class, 'setLimitExpense']);
Route::get('/users/{user_id}/transactions',[TransactionController::class, 'getTransactionsByUser']);
Route::post('/transactions',[TransactionController::class, 'store']);
