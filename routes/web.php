<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\teamController;
use App\Http\Controllers\RegistraionController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\logoutController;
use App\Http\Controllers\BookingPaymentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('Home');

Route::get('/about', function () {
    return view('about');
});

Route::get('/search',function () {
    return view("home");
})->name("home_page");

route::get('/no-access',function(){
    return view('auth_error_pages/noAccess');

});
route::get('/logout_page',[logoutController::class,'logout'])->name('logout_page');
Route::post('/search', [teamController::class,'ambu_price_detail'])->name('search_get');

Route::post('/login_varification',[RegistraionController::class,"login_varification"])->name("login_varification");
Route::post('/otp_match',[RegistraionController::class,"otp_match"])->name("otp_match");
Route::post('/consumer/register_user',[RegistraionController::class,"register_consumer"])->name("register_consumer");
Route::get('/consumer/ambu_detail/{ambu_type}/{ambu_price}',[RegistraionController::class,"save_ambu_detail"])->name("ambu_detail_save");
Route::post('session_save',[BookingController::class,"session_save"])->name("Addons_Session_Save");
Route::post('remove_addon',[BookingController::class,"remove_addon"])->name("Remove_Addon");

Route::get('/booking', [BookingController::class,'booking_view'])->name('booking_page')->middleware('check_auth');
Route::get('/check_login', [BookingController::class,'booking_view'])->name('check_login')->middleware('check_auth');

//booking process
Route::post('/bookingProcess',[BookingController::class,'booking_proccess'])->name('Booking_Process')->middleware('check_auth');
// Razorpay payment gateway
Route::get('razorpay', [RazorpayController::class, 'razorpay'])->name('razorpay');
Route::post('razorpaypayment', [RazorpayController::class, 'payment'])->name('payment');

//Payment Routes
Route::get('/payment_done', function(){
    return view('payment_done');
})->name('PaymentDone');
	
Route::post('/orderid-generate', [App\Http\Controllers\BookingPaymentController::class, 'orderIdGenerate']);

Route::get('/payment/{razorpay_payment_id}/{razorpay_order_id}/{razorpay_signature}', [App\Http\Controllers\BookingPaymentController::class, 'storePayment']);