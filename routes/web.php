<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyValueController;
use Illuminate\Support\Facades\Route;
Route::prefix('api')->group(function() {
    Route::prefix('products')->group(function() {
        Route::get('/',[ProductController::class,'index']);
        Route::post('/',[ProductController::class,'store']);
        Route::get('{property}',[ProductController::class,'show']);
        Route::put('{property}',[ProductController::class,'update']);
        Route::delete('{property}',[ProductController::class,'destroy']);
    });
});
//CRUD для значений св-в
Route::prefix('property-values')->group(function(){
    Route::get('/',[PropertyValueController::class,'index']);
    Route::post('/',[PropertyValueController::class,'store']);
    Route::get('{property_value}',[PropertyValueController::class,'show']);
    Route::put('{property_value}',[PropertyValueController::class,'update']);
    Route::delete('{property_value}',[PropertyValueController::class,'destroy']);


});
Route::prefix('users')->group(function() {
    Route::get('user/{name}{surname}',[ProductController::class,'getInfoUser']);
    Route::post('user/{name}{surname}{values}',[ProductController::class,'setInfoUser']);
    Route::put('user/{name}{surname}{values}',[ProductController::class,'updateUser']);
    Route::delete('user/{name}{surname}{values}',[ProductController::class,'deleteUser']);
})->name('userinfo');
