
@extends('layouts.configLayout')
@section('title','Medcab:driver')
@section('main')
@extends('layouts.header')
<?php if(Session::has('users'))
{
    $users=Session::get('users');
   
}
else{
    echo "<script>alert('failed');</script>";
}
?>
<div class="booked-driver-container container h-100 d-flex justify-content-start flex-column align-items-start">
    <div class="back-move mb-3">
        <a href="{{route('Home')}}" class="move-page-btn mb-4"><i class="fa-solid fa-arrow-left"></i>Booking Detail</a>
    </div>
    <div class="booking-driver-detail w-100">
        <div class="row  gx-4">
            <div class="col-md-5 p-0 booking-detail-right">
                <div class="booked-detail">
                    <div class="top-header-1">
                        <p class="top-header-text">Start your order with PIN: 6549</p>
                        <button class="ride-cancel-btn btn-click-effect"  data-bs-toggle="modal" data-bs-target="#cancelRide">Cancel</button>
                    </div>
                    <div class="top-header-2">
                        <p class="driver-ambu-type">Basic Ambulance <i class="fas  fa-light fa-circle-exclamation"></i></p>
                        <span class="arriving-time-text">Arriving in 2 min</span>
                    </div>
                    <div class="driver-details">
                        <div class="driver-profile">
                            <img src="" alt="">
                        </div>
                        <div class="driver-info">
                            <p class="driver-ambu-no">Ambulance No.</p>
                            <p class="driver-name">Vaibhav Raj</p>
                            <p class="driver-mobile-no">93948 39449</p>
                        </div>
                    </div>
                    <div class="driver-contact-btn">
                        <a href="" class="driver-btn btn-click-effect" id="message-driver" data-bs-toggle="modal" data-bs-target="#driverChat">Message</a>
                        <a href="tel:5554280940" class="driver-btn btn-click-effect" id="call-driver">Call</a>
                    </div>
                    <div class="underline-divider"></div>
                    <div class="location-detail">
                        <div class="location-icon-left">
                            <div class="pickIcons">
                                <span class="d-pick-icon"><i class="fa-sharp fa-solid fa-circle-dot fa-beat"></i></span>
                                <span class="location-connector"></span>
                            </div>
                            <div class="pick-location">
                                <h4 class="location-type">Pickup Location</h4>
                                <p class=" pick-address">{{$users['pick']}}</p>
                            </div>
                        </div>
                       
                        <div class="location-name-detali">
                        <span class="d-dest-icon"><i class="fa-solid fa-location-dot fa-beat"></i></span>
                            
                            <div class="drop-location">
                                <div class="location-type">
                                    <h4>Drop Location</h4>
                                    <a href="" class="change-location"><i class="mr-2 fa-solid fa-pencil"></i>Change Location</a>
                                </div>
                                    <p class=" drop-address" title="Kota Heart Hospital, 10-A, Talwana...">{{$users['drop']}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="underline-divider"></div>
                    <div class="payment-detail">
                        <h4 class="pay-heading">Payment</h4>
                        <span class="price-detail">
                            <span>Total Charge</span>
                            <span class="total-payment"><i class="fa-solid fa-indian-rupee-sign"></i>{{session('consumer.full_amount')}}</span>
                        </span>
                    </div>
                    <div class="dashed-divider"></div>
                    <div class="payment-detail-type">
                        <p class="payment-type-name"><i class="fa-solid fa-circle-check"></i>
                        <?php 
                            if(session('total_amount')==session('consumer.full_amount')){
                                echo "Full Payment";
                                $paid_amount=session('consumer.full_amount');
                            }
                            
                            else{
                                echo "Advanced Payment"; 
                                $paid_amount=session('consumer.adv_amount');
                            }
                        ?>
                        </p>
                        <a href="" class="payment-status-btn" style="background: #42A646;">Done</a>
                        <p class="pay-price"><i class="fa-solid fa-indian-rupee-sign"></i>{{$paid_amount}}</p>
                    </div>
                    <div class="dashed-divider"></div>
                    @if(session('consumer.adv_amount')==session('payAmount'))
                    <div class="payment-detail-type">
                        <p class="payment-type-name"><i class="fas fa-thin fa-circle-exclamation"></i>Remaining Payment</p>
                        <a href="" class="payment-status-btn" style="background: #D8712A;">Pending</a>
                        <p class="pay-price"><i class="fa-solid fa-indian-rupee-sign"></i>{{session('consumer.full_amount')-session('consumer.adv_amount')}}</p>
                    </div>
                    <div class="dashed-divider"></div>
                    @endif
                    <div class="payment-methods">
                        <a href="" class="pay-in-case btn-click-effect" id="pay-case">
                            <span class="circle"></span>
                            <i class="fa-solid fa-circle-check pay-check"></i>Pay in case</a>
                        <a href="" class="pay-now btn-click-effect">Pay Now</a>
                    </div>
                </div>
            </div>
             <div class="col-md-7 booking-detail-map">
                <div class="show-map h-100 w-100" id="show-map">
                </div>
            </div>
        </div>
    </div>
    
</div>
<!-- message chat box -->
<div class="modal driver_chat p-3" id="driverChat" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content chatBox">
            <div class="modal-header border-0">
                <div class="chatBox-header">
                    <div class="chat-profile">
                        <img src="" alt="">
                    </div>
                    <div class="driver-name-status">
                        <h4 class="chat-driver-name">Cab No. Here</h4>
                        <p class="chat-driver-status">Active</p>
                    </div>
                </div>                     
            </div>
            <div class="modal-body ">
                <div class="chat-body-container">
                    <div class="chat-body">
                            <div class="driver-chat outgoing-message">
                            <span class="chat-message">Hello {{session('consumer.c_name')}}!</span>
                            <span class="chat-time">
                                    <?php 
                                        $dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata')); 
                                        echo $dateTime->format("H:i A"); 
                                    ?>
                            </span>
                            </div>  
                            <div class="driver-chat incoming-message">
                            <span class="chat-message">Hello {{session('consumer.c_name')}}!</span>
                            <span class="chat-time">
                                    <?php 
                                        $dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata')); 
                                        echo $dateTime->format("H:i A"); 
                                    ?>
                            </span>
                            </div>                                                   
                    </div>
                    <textarea name="" id="" cols="30" rows="10" class="chat-input-box" placeholder="Type a message"></textarea>    
                </div>
                <div class="modal-footer flex-nowrap border-0 justify-content-center">
                    <button type="button" class="chat-back-btn chat-btn"  data-bs-dismiss="driver_chat">Back</button>
                    <button type="button" class="chat-send-btn chat-btn" >Send</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- message chat box end -->
<?php 
print_r(Session::get('booking_addons'))?>
<!-- Cancel Ride Modal Start -->
<div class="modal p-3" id="cancelRide" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content cancel-box b-0">
            <div class="modal-body cancel-box-body ">
                <div class="sqr"></div>
                
                <h2>Are you sure you want to Cancel<br/> your Booking?</h2>
            </div>
             <div class="modal-footer flex-nowrap border-0 justify-content-center">
                <button type="button" class="cancel-back-btn btn-trans"  data-bs-dismiss="modal">Back</button>
                <button type="button" class="cancel-yes-btn btn-trans" data-bs-toggle="modal" data-bs-target="#reasonForCancelRide" >Yes</button>
            </div>
            
        </div>
    </div>
</div>
<!-- Cancel Ride Modal End -->

<!-- Cancelation reason modal start -->
<div class="modal p-5" id="reasonForCancelRide" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content cancel-reason b-0">
            <div class="modal-header cancel-reason-header">
                <h2 class="modalHeading text-center m-auto">Select Reason for Cancellation</h2>
            </div>
            <div class="modal-body cancel-reason-body ">
                    <div class="cancel-reason-list">
                        <div class="cancel-reason-item">
                            <input type="radio" name="cancel-reason" class="cancel-reason-radio-btn" id="">
                            <p class="cancel-text">Lorem ipsum dolor sit amet. Nam natus omnis</p>
                        </div>
                        <div class="cancel-reason-item">
                            <input type="radio" name="cancel-reason" class="cancel-reason-radio-btn" id="">
                            <p class="cancel-text">Lorem ipsum dolor sit amet. Nam natus omnis</p>
                        </div>
                        <div class="cancel-reason-item">
                            <input type="radio" name="cancel-reason" class="cancel-reason-radio-btn" id="">
                            <p class="cancel-text">Lorem ipsum dolor sit amet. Nam natus omnis</p>
                        </div>
                        <div class="cancel-reason-item">
                            <input type="radio" name="cancel-reason" class="cancel-reason-radio-btn" id="">
                            <p class="cancel-text">Lorem ipsum dolor sit amet. Nam natus omnis</p>
                        </div>
                        <div class="cancel-reason-item">
                            <input type="radio" name="cancel-reason" class="cancel-reason-radio-btn" id="">
                            <p class="cancel-text">Lorem ipsum dolor sit amet. Nam natus omnis</p>
                        </div>
                        <div class="cancel-reason-item">
                            <input type="radio" name="cancel-reason" class="cancel-reason-radio-btn" id="">
                            <p class="cancel-text" id="other-reason">Reason Not Listed</p>
                        </div>
                        <textarea name="" id="" cols="30" rows="10" class="chat-input-box" placeholder="Please specify cancellation reasoon"></textarea>    

                        
                </div>
            </div>
            <div class="modal-footer flex-nowrap border-0 justify-content-center">
                <button type="button" class=" btn-trans w-50"  data-bs-dismiss="modal">Back</button>
                <button type="button" class="btn-solid w-50"  data-bs-toggle="modal" data-bs-target="#cancelSuccessfull" >Cancel Ride</button>
            </div>
            
        </div>
    </div>
</div>
<!-- Cancelation reason modal end -->

<!-- Cancelation successfull modal start -->
<div class="modal p-3" id="cancelSuccessfull" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content cancel-box b-0">
            <div class="modal-body cancel-box-body ">
                <div class="sqr"></div>
                <h2>Ride Cancelled Successfully</h2>
            </div>
             <div class="modal-footer flex-nowrap border-0 justify-content-center">
                <button type="button" class="btn-trans w-100" data-bs-toggle="modal" data-bs-target="#rating-modal">OK</button>
            </div>
            
        </div>
    </div>
</div>

<!-- Cancelation successfull modal end -->

<!-- Rating Modal start -->

<div class="modal p-5" id="rating-modal" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog rating-container modal-dialog-centered" role="document">
        <div class="modal-content h-100 rating b-0">
            <div class="modal-header rating-header b-0">
                <h2 class=" text-center"><i class="fa-solid fa-circle-check"></i>Ride Completed Successfully</h2>
                <p class="pay-price"><i class="fa-solid fa-indian-rupee-sign"></i>{{session('payAmount')}}</p>
            </div>
            <div class="modal-body rating-body "> 
                <div class="rating-star">
                    <div class="rating-user-profile">
                        <img src="" alt="">
                    </div>    
                    <p>How was your ride with Vaibhav Raj?</p>     
                    <div class="rating-stars">
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div> 
                </div>  
                <div class="rating-option">
                    <p>What was Lorem Episum?</p>
                    <div class="rating-option-list">
                        <button class="rating-option-btn">Safe Driving</button>
                        <button class="rating-option-btn">Good Conversation</button>
                        <button class="rating-option-btn">No extra calls</button>
                        <button class="rating-option-btn">Great Attitude</button>
                        <button class="rating-option-btn">Budget Price</button>
                        <button class="rating-option-btn">On Time Pickup</button>
                        <button class="rating-option-btn">Good</button>
                    </div>
                </div> 
                <textarea name="" id="" cols="30" rows="1" class="rating-message" placeholder="Write here if you have anything in our mind"></textarea>  
            </div>
            <div class="modal-footer flex-nowrap border-0 justify-content-center">
                <button type="button" class="rating-submit-btn btn-trans w-70"  data-bs-dismiss="modal">Submit</button>
            </div>
            
        </div>
    </div>
</div>
<!-- Rating Modal end -->

<!-- invoice modal start -->

<!-- invoice modal end -->
<script>
    window.onload = function() {
        // draw the map
        polyline_display("{{$users['pick']}}","{{$users['drop']}}","show-map");
        
        //pay-in-case icon toggler
        $('#pay-case').click(function(){
            $('.circle').toggle();
            $('.pay-check').toggle();
        
        });

        // hide modal 
        $('.chat-back-btn').click(function(){
            $('#driverChat').modal('hide');
        });

        // button click effect
        // $('.btn-click-effect').click(function(e){
        //     e.preventDefault();
        //     var textColor=$(this).css('color');
        //     alert('Textcolor='+textColor);
        //     var bgColor=$(this).css('background-color');
        //     alert('BGcolor='+bgColor);
        //     $(this).css('color',bgColor);
        //     $(this).css('background-color',textColor);
            
        // });

        $('.rating-submit-btn').click(function(){
            window.location.replace("{{url('/user/invoice')}}");
        });
    }
</script>
