<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyValueController;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->group(function() {
Route::get('/',[ProductController::class,'index']);
Route::post('/',[ProductController::class,'store']);
Route::get('{property}',[ProductController::class,'show']);
Route::put('{property}',[ProductController::class,'update']);
Route::delete('{property}',[ProductController::class,'destroy']);
});

//CRUD для значений св-в
Route::prefix('property-values')->group(function(){
   Route::get('/',[PropertyValueController::class,'index']);
   Route::post('/',[PropertyValueController::class,'store']);
   Route::get('{property_value}',[PropertyValueController::class,'show']);
   Route::put('{property_value}',[PropertyValueController::class,'update']);
   Route::delete('{property_value}',[PropertyValueController::class,'destroy']);


});
