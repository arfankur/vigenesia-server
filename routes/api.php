<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\MotivationController;
use App\Models\Motivation;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/coba',function(){
    // return response()->json(Motivation::find(2));
});
Route::get('/cobaa',function(){

   $motivations =   Motivation::query()
   ->select([
       // 'users.id',
       'users.name',
       'users.job',
       'users.email',
       'roles.role',
       'motivations.*',
       ])
   ->join('users', 'users.id', '=', 'motivations.user_id')
   ->join('roles', 'roles.id', '=', 'users.role_id')
   ->get();
   return response()->json($motivations);
   // dd(
        // $motivations

        // return response()->json($motivations);
        // )
        ;
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return auth()->user();
});

Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

// Route::middleware('auth:sanctum')->group( function () {
//     Route::get('motivations', MotivationController::class);
// });
Route::controller(MotivationController::class)->middleware('auth:sanctum')->group(function(){
    // Route::get('show-motivation-by-user', 'showMotivationByUser');
    Route::post('motivation', 'store');
    Route::get('motivations', 'index');
    Route::get('motivations-by-auth', 'indexByAuth');
    // Route::get('edit-motivation', 'editMotivationByUser');
    Route::get('motivation/{id}', 'show');
    Route::delete('motivation/{motivation}', 'destroy');
    Route::put('motivation/{motivation}', 'update');
});
