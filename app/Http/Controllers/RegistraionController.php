<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB; 
use Illuminate\Validation\Factory; 
use App\Models\team;
use Validator;
use Input;
use Session;

class RegistraionController extends Controller
{
    public function login_varification(Request $req){
        $mob= $req->phone;
        $ambu_type=$req->ambu_type;
        $ambu_price=$req->ambu_price;
        $rule  =  array(
            'phone'       => 'required|min:10|max:10',
            ) ;
            $validator = Validator::make($req->all(),$rule);
            if ($validator->fails())
            {
                $messages = $validator->messages();
                return response()->json($messages);
            }
            else
            {
                $otp=random_int(100000,999999);
                session::put(["ambu_type"=>$ambu_type,
                "ambu_price"=>$ambu_price,
                "consumer_mob"=>$mob]);
                $consumer = DB::table('consumer')->where("consumer_mobile_no",$mob)->get();
                if($consumer->count())
                {
                    $value=Session::put(["consumer_mob"=>$mob,
                    "consumer_id"=>$consumer[0]->consumer_id,
                    "consumer_name"=>$consumer[0]->consumer_name]);
                    $data = [
                        'success' => true,
                        'message'=> 'logged In',
                        'code'=>'0',
                        'otp'=>$otp,
                        'name'=>$consumer[0]->consumer_name,
                        'number'=>$consumer->count(),
                        'data'=>$consumer[0]
                    ]; 
                        return response()->json($data);    
                    }
                else{
                    $data = [
                        'success' => false,
                        'message'=> 'You are not registered with this number.Please Register First!',
                        'code'=>'1'
                    ];
                    return response()->json($data);    
                }
            }
    }

    public function otp_match(Request $req){
        $mob=session()->get('consumer_mob');
        $consumer = DB::table('consumer')->where("consumer_mobile_no",$mob)->get();
        return response()->json(
            ["message"=>"Your have logged in.", 
            "consumer_name"=>$consumer[0]->consumer_name,
        ]);
    }

    public function register_consumer(Request $request){
        $rules = [
			'name' => 'required|string|min:3|max:255',	
		];
		$validator = Validator::make($request->all(),$rules);
		if($validator->fails())
        {
			$json=[
                'status'=>'200',
                'message'=>"Invalid Input data"
            ];
            return response()->json($json);
		}
		else{
            $data = $request->input();
            $name=$request->input('name');
            $ambu_type=$request->ambu_type;
            $ambu_price=$request->ambu_price;
            session()->put("consumer_name",$name);
            session()->put("ambu_type",$ambu_type);
            Session::put('ambu_price',$ambu_price);
			try{
                $date = date('Y-m-d H:i:s');
                DB::table('consumer')->insert([
                    'consumer_name' => $name,
                    'consumer_mobile_no' => session('consumer_mob'),
                    'consumer_auth_key'=>$request->ip(),
                    'consumer_email_id'=>strtolower( str_replace(' ', '', $name))."@gmail.com",
                    'consumer_registered_date'=>time(),
                ]);
                $lastid= DB::table('consumer')->orderBy('consumer_id', 'desc')->take(1)->first();
                session::put('consumer_id', $lastid->consumer_id);
                $response=[
                    'success'=>"Inserted Successfully",
                    'status'=>0,
                    'otp'=>random_int(100000,999999),
                    'message'=>"You have register successfully",
                    'consumer_name'=>$name,
                    'consumer_auth_key'=>$request->ip(),    
                ];
                return Response()->json($response);
            }
			catch(Exception $e){
                return Response()->json(['failed'=>"operation failed",'status'=>1]);
			}
		}
    }


    public function save_ambu_detail($ambu_type,$ambu_price){
        
        session::put(['ambu_type'=>$ambu_type,'ambu_price'=>$ambu_price]);
        // return response()->json(['status'=>'Saved Successfully']);
        return Redirect()->route("booking_page");
    }
}

