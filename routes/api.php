<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckClientHasApiToken;
use App\Http\Middleware\Localization;
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

Route::post('/register',[RegisterController::class, 'register']);
Route::post('/register/confirm',[RegisterController::class, 'confirm']);
Route::post('/login',[AuthController::class, 'login']);
Route::post('/logout',[AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', Localization::class])->group(function () {

Route::get('/users',[UserController::class, 'index']);
Route::get('/users/{user_id}',[UserController::class, 'show']);
Route::match(['put', 'patch'],'/users/{user_id}',[UserController::class, 'update']);
Route::delete('/users/{user_id}',[UserController::class, 'destroy']);

Route::get('/users/{user_id}/budgets',[BudgetController::class, 'budgetsListUser']);
Route::post('/users/{user_id}/add_new_budget',[BudgetController::class, 'store']);
Route::match(['put', 'patch'],'/users/{user_id}/budgets/{budget_id}', [BudgetController::class, 'update']);
Route::get('/users/{user_id}/budgets/{budget_id}', [BudgetController::class, 'show']);
Route::delete('/users/{user_id}/budgets/{budget_id}',[BudgetController::class, 'destroy']);

Route::get('/budgets/{budget_id}/users',[UserController::class, 'getUsersInBudget']);
Route::get('/budgets/{budget_id}/add_user',[UserController::class, 'addUsersInBudget']);
Route::get('/confirm-email', [UserController::class, 'confirmUserForAddBudget']);

Route::get('/budgets/{budget_id}/transactions',[TransactionController::class, 'getTransactionsByBudget']);
Route::post('/budgets/{budget_id}/set-limit', [BudgetController::class, 'setLimitExpense']);

Route::get('/users/{user_id}/transactions',[TransactionController::class, 'getTransactionsByUser']);
Route::post('/transactions',[TransactionController::class, 'store']);

Route::post('/statistics',[StatisticController::class, 'generateBudgetChart']);

});

