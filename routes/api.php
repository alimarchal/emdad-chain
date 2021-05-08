<?php

use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\v1\TrackingDeliveryController;
use App\Http\Controllers\Api\v1\DeliveryController;
use App\Http\Controllers\Api\v1\ShipmentItemController;
use App\Http\Controllers\Api\v1\ShipmentController;
use App\Models\Delivery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('v1')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::get('TrackingDelivery/DeliveryID/{id}', [TrackingDeliveryController::class, 'getAllDelivery']);
    Route::apiResource('TrackingDelivery', TrackingDeliveryController::class);
    Route::apiResource('Delivery', DeliveryController::class);
    Route::get('Delivery/Deliveries/{id}', [DeliveryController::class, 'getAllDeliveries']);
    Route::apiResource('ShipmentItems', ShipmentItemController::class);
    Route::apiResource('Shipment', ShipmentController::class);
    Route::apiResource('DeliveryNote', \App\Http\Controllers\Api\v1\DeliveryNoteController::class);
    Route::apiResource('User', \App\Http\Controllers\Api\v1\UserController::class);
    Route::apiResource('Vehicle', \App\Http\Controllers\Api\v1\VehicleController::class);
    Route::apiResource('RatingReview', \App\Http\Controllers\Api\v1\ReviewRatingController::class);
});


/* Token API
Route::post('/login', function (Request $request) {
    $data = $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    $user = User::whereEmail($request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response([
            'email' => ['The provided credentials are incorrect.'],
        ], 404);
    }

    return $user->createToken('my-token')->plainTextToken;
});
*/
