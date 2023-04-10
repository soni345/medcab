<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\team;
use App\Models\vehicle;
use Input;
use Session;


// class VehiclesController extends Controller
// {
//     //
// }


class teamController extends Controller
{

    public function insert_data(Request $request){
        $team = DB::table('teams');
        $team->name = $request->name;        
        $team->designation = $request->designation;
        $team->save();
        if($team->save()){
            return ["Status"=>"Data inserted successfully!"];
        }
        else{
            return ["Status"=>"Data insertion failed!"];
        }
    

    }

 
    public function ambu_search(Request $req){
       
        $team=$req->all();
        if(!empty($team)){ 
                return Redirect::route('search_get')->with(['team'=>$team,"status"=>'All data is fetched.',]); 
        }
        else{
            return view("searchAmbu",["action"=>'Please select pickup and drop location !']);
        }
        
    }

    
    public function ambu_price_detail(Request $req){
             $team=$req->all();
            // $teams=session()->get('team');
            session::put('team',$team);
            // dd($team);
         
            if(!empty($team)){
                $ambu_cat= DB::table('ambulance_category')->get();
                $distance=$req->input('distance');
                // dd($distance);
                $catagory=DB::table('ambulance_facilities')->get();
            // if($distance<10){
                // $price=DB::table('ambulance_category')->join('ambulance_base_rate','ambulance_category.ambulance_category_type','=','ambulance_base_rate.ambulance_base_rate_cat_type')->select('ambulance_rate.*')->get();
                

            //     $price=DB::select('select * from ambulance_category join ambulance_base_rate on ambulance_category.ambulance_category_type=ambulance_base_rate.ambulance_base_rate_cat_type ');
            // }
            // else{
                // $price=DB::table('ambulance_category')->join('ambulance_base_rate','ambulance_category.ambulance_category_type','=','ambulance_base_rate.ambulance_base_rate_cat_type')->join('ambulance_rate','ambulance_rate.ambulance_rate_category_type','=','ambulance_category.ambulance_category_type')->where('ambulance_rate.ambulance_rate_starting_km',"<=",$distance)->where('ambulance_rate.ambulance_rate_end_km','>',$distance)
                // ->get();

                $price=DB::select('select * from ambulance_category join ambulance_base_rate on ambulance_category.ambulance_category_type=ambulance_base_rate.ambulance_base_rate_cat_type join ambulance_rate on ambulance_rate.ambulance_rate_category_type=ambulance_category.ambulance_category_type where '.$distance.' between ambulance_rate_starting_km AND ambulance_rate_end_km');   
              
            // }
          
            return view('searchAmbu')-> with(compact('ambu_cat','price','catagory','team'));
            }
            else{
                return Redirect::route('/');
            }
           
          
         
       

    }
    
}
