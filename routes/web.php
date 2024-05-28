<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VisitorController;
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

Route::get('/', [VisitorController::class, 'index'])->name('VPage');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//عملناها من نوع get هيك تغيير جو لانو فينا نساويها post وناخد id بشكل عادي بس عملت انبوت من نوع هيدين
Route::get('/order/status', [App\Http\Controllers\HomeController::class, 'updateStatus'])->name('order.status');

Route::controller(CategoryController::class)->group(function () {

    Route::get('/category', 'show')->name('cat.show');
    Route::post('/add-category', 'store')->name('cat.store');
    Route::get('/delete-category/{id}', 'delete')->name('cat.delete');
    Route::post('/update-category', 'update')->name('cat.update');// مافي داعي لاخد معي الid لل controller باخد بس الريكويست لجاي من حقل الid المخفي
});

Route::controller(MealController::class)->group(function (){

    Route::get('/meal/create', 'create')->name('meal.create');
    Route::post('/meal/store', 'store')->name('meal.store');
    Route::get('/show/meals', 'index')->name('meal.show');
    Route::get('/edit/meal/{id}', 'edit')->name('meal.edit');
    Route::post('/meal/update/{id}', 'update')->name('meal.update');
    Route::get('/meal/{id}/delete', 'mealDelete')->name('meal.delete');
});

Route::controller(OrderController::class)->group(function (){

    Route::get('/meal/detail/{id}', 'mealDetails')->name('meal.details');
    Route::post('/order/store', 'storeOrder')->name('order.store');
    Route::get('/order/show', 'showOrder')->name('order.show');
});





