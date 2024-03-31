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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/register',[UserController::class, 'register']);
Route::get('/users',[UserController::class, 'index']);
Route::get('/users/{user_id}',[UserController::class, 'show']);
Route::match(['put', 'patch'],'/users/{user_id}',[UserController::class, 'update']);
Route::delete('/users/{user_id}',[UserController::class, 'destroy']);
Route::get('/users/{user_id}/budgets',[BudgetController::class, 'budgetsListUser']);
Route::post('/users/{user_id}/add_new_budget',[BudgetController::class, 'store']);
Route::match(['put', 'patch'],'/users/{user_id}/budgets/{budget_id}', [BudgetController::class, 'update']);
Route::get('/users/{user_id}/budgets/{budget_id}', [BudgetController::class, 'show']);
Route::get('/budgets',[BudgetController::class, 'index']);
Route::delete('/users/{user_id}/budgets/{budget_id}',[BudgetController::class, 'destroy']);
Route::get('/budgets/{budget_id}/users',[UserController::class, 'getUsersInBudget']);
Route::get('/budgets/{budget_id}/add_user',[UserController::class, 'addUsersInBudget']);
Route::get('/budgets/{budget_id}/transactions',[TransactionController::class, 'getTransactionsByBudget']);
Route::post('/budgets/{budget_id}/set-limit', [BudgetController::class, 'setLimitExpense']);
Route::get('/users/{user_id}/transactions',[TransactionController::class, 'getTransactionsByUser']);
Route::post('/transactions',[TransactionController::class, 'store']);
