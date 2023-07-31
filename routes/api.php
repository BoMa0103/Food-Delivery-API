<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Categories\DeleteCategoryController;
use App\Http\Controllers\Categories\IndexCategoryController;
use App\Http\Controllers\Categories\ShowCategoryController;
use App\Http\Controllers\Categories\StoreCategoryController;
use App\Http\Controllers\Categories\UpdateCategoryController;
use App\Http\Controllers\Companies\DeleteCompanyController;
use App\Http\Controllers\Companies\IndexCompanyController;
use App\Http\Controllers\Companies\ShowCompanyController;
use App\Http\Controllers\Companies\StoreCompanyController;
use App\Http\Controllers\Companies\UpdateCompanyController;
use App\Http\Controllers\Dishes\DeleteDishController;
use App\Http\Controllers\Dishes\IndexDishController;
use App\Http\Controllers\Dishes\ShowDishController;
use App\Http\Controllers\Dishes\StoreDishController;
use App\Http\Controllers\Dishes\UpdateDishController;
use App\Http\Controllers\Orders\DeleteOrderController;
use App\Http\Controllers\Orders\IndexOrderController;
use App\Http\Controllers\Orders\ShowOrderController;
use App\Http\Controllers\Orders\StoreOrderController;
use App\Http\Controllers\Orders\UpdateOrderController;
use App\Http\Controllers\Packages\DeletePackageController;
use App\Http\Controllers\Packages\IndexPackageController;
use App\Http\Controllers\Packages\ShowPackageController;
use App\Http\Controllers\Packages\StorePackageController;
use App\Http\Controllers\Packages\UpdatePackageController;
use App\Http\Controllers\Users\DeleteUserController;
use App\Http\Controllers\Users\IndexUserController;
use App\Http\Controllers\Users\ShowUserController;
use App\Http\Controllers\Users\StoreUserController;
use App\Http\Controllers\Users\UpdateUserController;
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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login', [AuthController::class, 'login'])
        ->name('auth.login');
    Route::post('logout', [AuthController::class, 'logout'])
        ->name('auth.logout');
    Route::post('refresh', [AuthController::class, 'refresh'])
        ->name('auth.refresh');
    Route::post('me', [AuthController::class, 'me'])
        ->name('auth.me');

});

Route::group([
    'middleware' => 'jwt.auth'
], function () {

    Route::get('/companies', IndexCompanyController::class)
        ->name('companies.index');
    Route::get('/companies/{company}', ShowCompanyController::class)
        ->name('companies.show')
        ->whereNumber('company');
    Route::delete('/companies/{company}', DeleteCompanyController::class)
        ->name('companies.delete')
        ->whereNumber('company');
    Route::put('/companies/{company}', UpdateCompanyController::class)
        ->name('companies.update')
        ->whereNumber('company');
    Route::post('/companies', StoreCompanyController::class)
        ->name('companies.store');


    Route::get('/categories', IndexCategoryController::class)
        ->name('categories.index');
    Route::get('/categories/{category}', ShowCategoryController::class)
        ->name('categories.show')
        ->whereNumber('category');
    Route::delete('/categories/{category}', DeleteCategoryController::class)
        ->name('categories.delete')
        ->whereNumber('category');
    Route::put('/categories/{category}', UpdateCategoryController::class)
        ->name('categories.update')
        ->whereNumber('category');
    Route::post('/categories', StoreCategoryController::class)
        ->name('categories.store');


    Route::get('/dishes', IndexDishController::class)
        ->name('dishes.index');
    Route::get('/dishes/{dish}', ShowDishController::class)
        ->name('dishes.show')
        ->whereNumber('dish');
    Route::delete('/dishes/{dish}', DeleteDishController::class)
        ->name('dishes.delete')
        ->whereNumber('dish');
    Route::put('/dishes/{dish}', UpdateDishController::class)
        ->name('dishes.update')
        ->whereNumber('dish');
    Route::post('/dishes', StoreDishController::class)
        ->name('dishes.store');


    Route::get('/orders', IndexOrderController::class)
        ->name('orders.index');
    Route::get('/orders/{order}', ShowOrderController::class)
        ->name('orders.show')
        ->whereNumber('order');
    Route::delete('/orders/{order}', DeleteOrderController::class)
        ->name('orders.delete')
        ->whereNumber('order');
    Route::put('/orders/{order}', UpdateOrderController::class)
        ->name('orders.update')
        ->whereNumber('order');
    Route::post('/orders', StoreOrderController::class)
        ->name('orders.store');


    Route::get('/packages', IndexPackageController::class)
        ->name('packages.index');
    Route::get('/packages/{package}', ShowPackageController::class)
        ->name('packages.show')
        ->whereNumber('package');
    Route::delete('/packages/{package}', DeletePackageController::class)
        ->name('packages.delete')
        ->whereNumber('package');
    Route::put('/packages/{package}', UpdatePackageController::class)
        ->name('packages.update')
        ->whereNumber('package');
    Route::post('/packages', StorePackageController::class)
        ->name('packages.store');


    Route::get('/users', IndexUserController::class)
        ->name('users.index');
    Route::get('/users/{user}', ShowUserController::class)
        ->name('users.show')
        ->whereNumber('user');
    Route::delete('/users/{user}', DeleteUserController::class)
        ->name('users.delete')
        ->whereNumber('user');
    Route::put('/users/{user}', UpdateUserController::class)
        ->name('users.update')
        ->whereNumber('user');

});


Route::post('/users', StoreUserController::class)
    ->name('users.store');
