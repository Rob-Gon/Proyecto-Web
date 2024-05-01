<?php

use Illuminate\Support\Facades\Route;
use App\Models\ApiUser;
use App\Http\Controllers\UserController;

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

Route::get('register' , function () {
    $credentials = [
        'api_user' => 'ApiUser',
        'email' => 'apiuser@email.com',
        'password' => '1234'
    ];

    $apiUser = ApiUser::where('email', $credentials['email'])->first();

    if(!$apiUser) {
        $apiUser = new ApiUser();
        $apiUser->api_user = $credentials['api_user'];
        $apiUser->email = $credentials['email'];
        $apiUser->password = Hash::make($credentials['password']);
        $apiUser->save();
        return [
            'Authentication' => "Api user created successfully!",
        ];
    } else {
        $adminToken = $apiUser->createToken('admin-token', ['create', 'update', 'delete']);
        return [
            'admin-token' => $adminToken->plainTextToken,
        ];
    }
});

Route::group(['prefix' => 'index', 'middleware' => 'auth:sanctum'], function() {
    Route::apiResource('users', UserController::class);
});