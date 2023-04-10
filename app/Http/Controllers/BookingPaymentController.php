<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking_Payment;
use App\Models\booking_view;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB; 
use Illuminate\Validation\Factory; 
use Validator;
use Input;
use Session;

class BookingPaymentController extends Controller
{
    //
       //use this on top in the controller
       
    public function viewPayment(){
        return view('payment');
    }

    public function orderIdGenerate(Request $request){
        $api = new Api(config('app.razorpay_api_key'), config('app.seceret_key'));
        $order = $api->order->create(array('receipt' => 'order_rcptid_11', 'amount' => $request->input('price') * 100, 'currency' => 'INR')); // Creates order
        return response()->json(['order_id' => $order['id']]);
    }

    
    public function storePayment($razorpay_payment_id,$razorpay_order_id,$razorpay_payment_signature)
    {
        $api = new Api(config('app.razorpay_api_key'), config('app.seceret_key'));
        //Fetch payment information by razorpay_payment_id
        $payment = $api->payment->fetch($razorpay_payment_id);
        if(!empty($payment) && $payment['status'] == 'captured') {
            $paymentId = $payment['id'];
            $amount = $payment['amount'];
            $currency = $payment['currency'];
            $status = $payment['status'];
            $entity = $payment['entity'];
            $orderId = $payment['order_id'];
            $invoiceId = $payment['invoice_id'];
            $method = $payment['method'];
            $bank = $payment['bank'];
            $wallet = $payment['wallet'];
            $bankTranstionId = isset($payment['acquirer_data']['bank_transaction_id']) ? $payment['acquirer_data']['bank_transaction_id'] : '';
    }
    else{
        return redirect()->back()->with('error', 'Something went wrong, Please try again later!');
    }

    $check_transaction=Booking_Payment::where('booking_id','=',session('booking_id'))->get();
    if($check_transaction->count()==1){
        return redirect()->route('PaymentDone')->with(['success'=>'Payment Detail store successfully!',"payment_details"=>$check_transaction]);
    }
    else{
        try {
            // Payment detail save in database
            session::put('payAmount',$amount / 100);
            $payment = new Booking_Payment;
            $payment->consumer_id = session('consumer_id');
            $payment->booking_id = session('booking_id');
            $payment->transaction_id = $paymentId;
            $payment->amount = $amount / 100;
            $payment->currency = $currency;
            $payment->entity = $entity;
            $payment->status = $status;
            $payment->order_id = $orderId;
            $payment->method = $method;
            $payment->bank = $bank;
            $payment->wallet = $wallet;
            $payment->bank_transaction_id = $bankTranstionId;
            $payment->booking_transaction_time=time();
            $saved = $payment->save();
            }
            catch (Exception $e) {
                $saved = false;
            }
            if($saved)
            {
                session::put('pay_id',$payment->id);
                //update payment status in booking table
                if(session('consumer.full_amount')==session::get('payAmount')){
                    $update_payment_status=DB::table('booking_view')->where('booking_id','=',session('booking_id'))->update(['booking_payment_status' =>'3']);
                    if($update_payment_status)
                    {
                        $success='Full Payment!';
                        echo "<script>alert('".$success."');</script>";
                        exit();
                    }
                    else{
                        $success='Not Updated Full Payment';
                        echo "<script>alert('".$success."');</script>";
                        exit();
                        return redirect()->route('PaymentDone')->with(compact('success'));
                    }
                    return redirect()->route('PaymentDone')->with(compact('success'));
                }
                elseif(session('consumer.adv_amount')==($amount/100))
                {
                    $update_payment_status=DB::table('booking_view')->where('booking_id','=',Session::get('booking_id'))->update(['booking_payment_status' =>'2']);                  
                    if($update_payment_status){
                        $success='Advance Payment!';
                        echo "<script>alert('".$success."');</script>";
                        exit();
                    }
                    else{
                        $success='Not Updated advance Payment'.session('consumer.adv_amount')."==".($amount/100);
                        echo "<script>alert('".$success."');</script>";
                        exit();
                        return redirect()->route('PaymentDone')->with(compact('success'));
                    }
                    return redirect()->route('PaymentDone')->with(compact('success'));
                    
                }
                else{
                    $success='Payment status not updated!'.session('consumer.adv_amount')."==".($amount/100);
                    echo "<script>alert('".$success."');</script>";
                    echo session('booking_id');
                    $update_payment_status=DB::table('booking_view')->where('booking_id','=',session('booking_id'))->update(['booking_payment_status' =>'3']);
                        exit();
                    return redirect()->route('PaymentDone')->with(compact('success'));
                }
                
            } else {
                echo "<script>alert('".session('consumer.adv_amount')."==".($amount/100)."');</script>";
                echo "<script>alert('".session('booking_id')."');</script>";
                // echo session('booking_id');
                exit();
                return redirect()->
                    route('PaymentDone')
                    ->with(['status'=>'Something went wrong, Please try again later!']);
            }
        

    }
    
    
    }
}
