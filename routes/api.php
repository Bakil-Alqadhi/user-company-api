
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CompanyController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\CommentController;

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


Route::prefix('v1')->group(function (){
    Route::apiResource('users', UserController::class);
    Route::prefix('companies')->group(function (){
        Route::get('', [CompanyController::class, 'index']);
        Route::post('', [CompanyController::class, 'store']);
        Route::get('top-rated', [CompanyController::class, 'top_rated_companies']);

        Route::prefix('{company}')->group(function (){
            Route::get('', [CompanyController::class, 'show']);
            Route::match(['put', 'patch'], '', [CompanyController::class, 'update']);
            Route::get('/comments', [CompanyController::class, 'getComments']);
            Route::get('/overall-rating', [CompanyController::class, 'getOverallRating']);
        });

    });

    Route::apiResource('comments', CommentController::class);


});

