<?php

namespace App\Http\Controllers;

use App\Models\booking_view;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB; 
use Illuminate\Validation\Factory; 
use App\Models\users;
use App\Models\booking_addons;
use Validator;
use Input;
use Session;
use Carbon;


class BookingController extends Controller
{
    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
   
    public function booking_view()
    {   
        $booking_id=0;
        if(Session::has('booking_id')){
            $booking_id=Session::get('booking_id');
        }
        $check_booking=booking_view::where("booking_by_cid","=",session('consumer_id'))
        ->where("booking_id","=",$booking_id)->count();
        if($check_booking=='0'){
            $booking = new booking_view;          
            $booking->booking_by_cid=session('consumer_id');        
            $booking->booking_con_name = "";
            $booking->booking_con_mobile ="";
            $booking->booking_category =session("ambu_type");
            $booking->booking_schedule_time =Session::get('users.schedule-time');
            $booking->booking_pickup =Session::get('users.pick');
            $booking->booking_drop =Session::get('users.drop');
            $booking->booking_pick_lat =Session::get('users.pick_lat');
            $booking->booking_pick_long =Session::get('users.pick_lng');
            $booking->booking_drop_lat =Session::get('users.drop_lat');
            $booking->booking_drop_long =Session::get('users.drop_lng');
            $booking->booking_amount =session("ambu_price");
            $booking->booking_adv_amount=" ";
            $booking->booking_payment_type =" ";
            $booking->booking_payment_method ="online";
            $booking->booking_distance =Session::get('users.distance')."KM";
            $booking->booking_total_amount ="";
            $booking->booking_status ="Enquiry";
            $booking->booking_payment_status ="Pending";
            $booking->booking_polyline =" ";
            $booking->booking_acpt_driver_id =" ";
            $booking->booking_acpt_vehicle_id=" ";
            $result=$booking->save();
            if(!empty($result)){
                $lastId=$booking->id;
                $booking_addons=booking_addons::where('booking_id','=',$lastId)->get();
                Session::put(['booking_id'=>$lastId,'booking_addons'=>$booking_addons]);
                echo "<script>alert('new booking');</script>";
                // exit();
                return view('booking')->with('booking_status', 'Booking successfully.');
            }
            else{
                echo "<script>alert('new booking failed');</script>";
                exit();
                return view('booking')->with("booking_status","Booking failed!");
            }
        
        }
        else{
            $booking_addons=booking_addons::where('booking_id','=',$booking_id)->get();
            Session::put('booking_addons',$booking_addons);
            echo "<script>alert('already booking');</script>".$booking_id;
            return view('booking')->with("status","Already Booked your Ride! Please Do payment for complete your booking. ");
        }
        
    }

    public function booking_proccess(Request $req){
        $consumer=$req->all();
        $cid=session('consumer_id');
        $booking_id=session('booking_id');
        Session::put("consumer",$consumer);
        $validator = Validator::make($req->all(), [
            'c_name' => 'required|min:3|string',
            'c_mob' => 'required',
        ]);

        if(Session::get("consumer.pay_type")==1)
        {
            $pay_type="Full payment";
        }
        else{
            $pay_type="Advance payment";
        }
        
        if($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all(),
                        'data'=>$consumer,
                    ]);
        }
        $check_booking_for_update=booking_view::
                                    where("booking_by_cid","=",$cid)
                                    ->where("booking_id","=",$booking_id)->get()->count();
        if($check_booking_for_update==1){
            $booking =booking_view::where("booking_by_cid","=",$cid)
                                    ->where("booking_id","=",$booking_id)
                                    ->update([
                                        'booking_con_name'=>Session::get('consumer.c_name'),
                                        'booking_con_mobile'=>Session::get('consumer.c_mob'),
                                        'booking_adv_amount'=>Session::get('consumer.adv_amount'),
                                        'booking_payment_type'=>$pay_type,
                                        'booking_total_amount'=>Session::get('consumer.full_amount'),
                                        'booking_status'=>'Booking Done']);      
    
            if($booking)
            { 
                return response()->json([
                                'status' => 'Booking successfully.',
                                'consumer'=>session::get('consumer'),
                                'name'=>Session::get('consumer.c_name'),
                                'mob'=>Session::get('consumer.c_mob')
                            ]);
            }
            else{
                return response()->json(["status"=>"Booking failed!"]);
            }
        }
        else{
            return response()->json(["status"=>"Booking now existed from this booking id"]);
        }       
    }
    
    public function session_save(Request $req)
    {

        $add_time = date('Y-m-d H:i:s');
        $cid=session('consumer_id'); 
        if(Session::has('booking_id')){
            $booking_id=Session::get('booking_id');
        }
       $addons=new booking_addons;
       $supportName=$req->supportName;
       $supportPrice=$req->supportPrice;
       $booking_addons=booking_addons::where('booking_id','=',$booking_id)->get();
       Session::put('booking_addons',$booking_addons);
       $support_addons=DB::table('ambulance_support_specialists')->where("ambulance_support_specialists_name","=",$supportName)->get();
       $check_addons=booking_addons::where("booking_addons_name","=",$supportName)
                                    ->where("booking_id","=",Session::get('booking_id'))
                                    ->get();
                
       if($check_addons->count()===0)
       {
            $addons->booking_addons_by_cid=session('consumer_id');
            $addons->booking_id=session('booking_id');
            $addons->booking_ambu_support_specialist_id=$support_addons[0]->ambulance_support_specialists_id;
            $addons->booking_addons_name=$supportName;
            $addons->booking_addons_price=$supportPrice;
            $addons->booking_addons_status=0;
            $addons->booking_addons_remove_time=" ";
            $addons->booking_addons_added_time=Carbon\Carbon::now()->toDateTimeString();
            $addons->save();
            if($addons->save()){
            return response()->json(["status" => "Added Successfully","Booking_id" => session('booking_id')]);
            }
            else{
                return response()->json(["status" => "Failed to add Support Addons."]);
            }
        }

        else{  
            
            if($check_addons[0]->booking_addons_status>0)
            {
            $cid=session('consumer_id');
            try
            {
                $update_remove_addons=booking_addons::
                where("booking_addons_name","=",$supportName)
                ->where("booking_id","=",Session::get('booking_id'))
                ->where('booking_addons_status','=','1')
                ->update([
                    'booking_addons_status'=>'0', 'booking_addons_added_time'=>strtotime(date('Y-m-d H:i:s'))
                ]);
                if($update_remove_addons){
                    return response()->json(['status'=> 'Removed Addons Updated Successfully','booking_id'=>Session::get('booking_id')]);
                }
                else{
                    return response()->json(['status'=> DB::getQueryLog($update_remove_addons)]);
                }

            }
            catch(Exception $e)
            {
                return response()->json(['status'=>$ex->getMessage() ]);
            }
        }
        else{
            return response()->json(["status" => "Already Added",'booking_id'=>session('booking_id'),"Ambu_type"=>$supportName,"data"=>$check_addons]);
        }
    }
}

    public function show(booking $booking)
    {
        //
    }

    public function remove_addon(Request $req)
    {
        $supportName=$req->supportName;
        $supportPrice=$req->supportPrice;
        $booking_id=Session::get('booking_id');
        $booking_addons=booking_addons::where('booking_id','=',$booking_id)->get();
        Session::put('booking_addons',$booking_addons);
        $remove_addons=booking_addons::where("booking_addons_name","=",$supportName)
        ->where("booking_id","=",$booking_id)->where('booking_addons_status','=','0')->get();
                            
        if($remove_addons->count()>0){
            booking_addons::where("booking_addons_name","=",$supportName)
                            ->where("booking_id","=",$booking_id)
                            ->where('booking_addons_status','=','0')
                            ->update([
                                    'booking_addons_status'=>'1',
                                    'booking_addons_remove_time'=>strtotime(date('Y-m-d H:i:s'))
                                ]);
                                return response()->json(['addons_status'=>'Addons Removed',"status"=>'1']);
        }
        else{
            return response()->json([
                'addons_status'=>'Addons Already Removed',
                'booking_id'=>$booking_id,
                'error'=>$remove_addons->count()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(booking $booking)
    {
        //
    }
}
