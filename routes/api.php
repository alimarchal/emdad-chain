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
    # driver rating
    Route::post('DriverRating', [\App\Http\Controllers\Api\v1\DriverRatingController::class,'store']);
    Route::get('DriverRating/{id}', [\App\Http\Controllers\Api\v1\DriverRatingController::class,'show']);
    Route::get('DriverRating/driver_id/{id}', [\App\Http\Controllers\Api\v1\DriverRatingController::class,'driver_id']);
    Route::get('DriverRating/buyer_business_id/{id}', [\App\Http\Controllers\Api\v1\DriverRatingController::class,'buyer_business_id']);
    Route::get('DriverRating/{id}/average', [\App\Http\Controllers\Api\v1\DriverRatingController::class,'buyer_business_id_average']);
    # buyer rating
    Route::post('BuyerRating', [\App\Http\Controllers\Api\v1\BuyerRatingController::class,'store']);
    Route::get('BuyerRating/buyer_user_id/{id}', [\App\Http\Controllers\Api\v1\BuyerRatingController::class,'buyer_user_id']);
    Route::get('BuyerRating/buyer_business_id/{id}', [\App\Http\Controllers\Api\v1\BuyerRatingController::class,'buyer_business_id']);
    Route::get('BuyerRating/rating_business_id/{id}', [\App\Http\Controllers\Api\v1\BuyerRatingController::class,'rating_business_id']);
    Route::get('BuyerRating/rating_business_id/{id}/average', [\App\Http\Controllers\Api\v1\BuyerRatingController::class,'rating_business_id_average']);
    Route::get('BuyerRating/buyer_rating_type/{id}/driver', [\App\Http\Controllers\Api\v1\BuyerRatingController::class,'buyer_rating_type_driver']);
    Route::get('BuyerRating/buyer_rating_type/{id}/supplier', [\App\Http\Controllers\Api\v1\BuyerRatingController::class,'buyer_rating_type_supplier']);
    Route::get('BuyerRating/buyer_rating_type/{id}/emdad', [\App\Http\Controllers\Api\v1\BuyerRatingController::class,'buyer_rating_type_emdad']);
    # change password
    Route::post('User/changePassword', [\App\Http\Controllers\Api\v1\UserController::class,'change_password']);
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
