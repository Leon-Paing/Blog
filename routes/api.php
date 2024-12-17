<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryApiController;
use App\Models\User;

Route::apiResource('/categories', CategoryApiController::class);

// Route::get('/categories', [CategoryApiController::class, 'index']);
// Route::post('/categories', [CategoryApiController::class, 'store']);
// Route::get('/categories/{id}', [CategoryApiController::class, 'show']);
// Route::put('/categories/{id}', [CategoryApiController::class, 'update']);
// Route::delete('/categories/{id}', [CategoryApiController::class, 'destroy']);

Route::post("/login", function (Request $request) {
    $email = $request->email;
    $password = $request->password;

    if (!$email or !$password) {
        return response(['msg' => 'email and password required!'], 400);
    }

    $user = User::where("email", $email)->first();
    if ($user) {
        if (password_verify($password, $user->password)) {
            return $user->createToken('api')->plainTextToken;
        }
    }

    return response(['msg' => 'email or password incorrect!'], 401);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
