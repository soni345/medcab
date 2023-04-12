<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\http\view;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB; 
use Illuminate\Validation\Factory; 
use App\Models\booking_addons;

class DriverController extends Controller
{
    //
    public function driver_assigned(){
        return view('driver_assigned');
    }

    public function userInvoice(){
        $booking_addons=DB::table('booking_addons')->get();
        return view('user_invoice')->with(compact('booking_addons'));;
    }
}
