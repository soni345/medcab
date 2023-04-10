<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\vehicle;
use Input;
use Session;

class teamController extends Controller
{
    public function ambu_price_detail(Request $req){
        session::forget('booking_id');
        $users=$req->all();
        $support_list=DB::table('ambulance_support_specialists')->get();
        session::put('support_list',$support_list);
        session::put('users',$users);
        if(!empty($users)){
                $ambu_cat= DB::table('ambulance_category')->get();
                $distance=$req->input('distance');
                $catagory=DB::table('ambulance_facilities')->get();
                $price=DB::select('select * from ambulance_category join ambulance_base_rate on ambulance_category.ambulance_category_type=ambulance_base_rate.ambulance_base_rate_cat_type join ambulance_rate on ambulance_rate.ambulance_rate_category_type=ambulance_category.ambulance_category_type where '.$distance.' between ambulance_rate_starting_km AND ambulance_rate_end_km');          
                return view('searchAmbu')-> with(compact('ambu_cat','price','catagory','users'));
            }
            else{
                return Redirect::route('/');
            }
        }
    }
