
@extends('layouts.adminlayout')
@section('title',"Home")
@section('main')




<div class="ambulance-search ">
    <div class="alert alert-primary" role="alert" >
        <h2 id="welcome-user">Welcome!<?php 
        if(Session::has('consumer_name')){
            echo Session()->get('consumer_name');
        }
        
        ?> </h2>
    </div>
    <div class="ambulace-search-body">
        <div class="container">
        <a href="" class="move-page-btn"><i class="fa-solid fa-arrow-left-long"></i>Ambulance Search </a>
       
            <div class="ambulance-search-body">
            <!-- <div class="row"> -->
                
                    <div class=" ambu-detail-col ambu-search-left">

                            <div class="search-form">
                               
                                <form  id="forms">
                                @csrf
                                    <div class="form-group p-relative">
                                        <label for="exampleDropdownFormPassword1">Drop Location</label>
                                        <input type="text" class="form-control" id="drop" value="{{$users['pick']}}" name="drop" placeholder="Enter Pickup location here" readonly >
                                    </div>
                                    <div class="form-group p-relative">
                                        <label for="exampleDropdownFormPassword1">Drop Location</label>
                                        <input type="text" class="form-control" id="drop" value="{{$users['drop']}}" name="drop" placeholder="Enter Desination location here" readonly >
                                    </div>
                                    <div class="form-group p-relative book-here">
                                    <!-- <i class="fa-regular fa-clock"></i> -->
                                        <span class="book-detail">
                                                {{$users['distance']}} km
                                        </span>
                                    </div>
                                    
                                </form>
                                <div class="map-container">
                                    <div id="map" style="height:100%;width:100%;">

                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class=" ambu-detail-col ambu-search-right">
                            <div class="ambu-types">
                               <div class="ambu-types-body">
                                <h5 class="type-heading">  Select Ambulance Type</h5>
                                    <div class="ambu-types-list">
                                        @foreach($price as $cat)
                                            <div class="ambu-type-box p-relative">
                                                <div class="ambu-types-img">
                                                    <img src="assets/catagory_icon/amb_icon.png" class="h-100 w-100" alt="">
                                                </div>
                                                <div class="ambu-types-detail">
                                                    <h4 class="ambu-type-heading">{{$cat->ambulance_category_name}}</h4>
                                                    <p class="ambu-type-desc">
                                                    Lorem ipsum dolor sit amet. Nam natus omnis quo vtatem 
                                                    Lorem ipsum dolor sit amet. Nam natus omnis quo vtatem 
                                                    Lorem ipsum dolor sit amet. 
                                                    </p>
                                                    <a  class="type-read-more-btn" data-bs-toggle="modal" data-bs-target="#{{ str_replace(' ', '-', $cat->ambulance_category_name)}}"> Read more</a>

                                                </div>
                                                <div class="ambu-type-price-detail">
                                                    <span class="ambu-price"><i class="fa-solid fa-indian-rupee-sign ml-2"></i>
                                                    
                                                    <?php
    
                                                    if( $users['distance'] <=$cat->ambulance_base_rate_till_km){
                                                        $fare=$cat->ambulance_base_rate_amount ;
                                                        $service_charge=($fare*$cat->ambulance_rate_service_charge)/100;
                                                        $total=$fare+$service_charge;
                                                        echo intval($total);
                                                        
                                                    }
                                                    else{
                                                        $fare=$cat->ambulance_base_rate_amount + ($users['distance']-$cat->ambulance_base_rate_till_km)*$cat->ambulance_rate_amount;
                                                        $service_charge=($fare*$cat->ambulance_rate_service_charge)/100;
                                                        $total=$fare+$service_charge;
                                                        echo  sprintf('%0.2f', intval($total));
                                                    }


                                                    ?>
                                                  
                                                    </span>
                                                    <span class="ambu-dis-time">10 min away</span>

                                                </div>
                                            </div>


                                        <!-- Read MOre model start -->
                                    <div class="modal p-3" id="{{ str_replace(' ', '-',   $cat->ambulance_category_name)}}" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header border-0">
                                                <h6 class="modal-title text-secondary" id="exampleModalCenterTitle" >{{$cat->ambulance_category_name}}</h6>
                                                <button type="button" class="modal-close close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        
                                            <div class="modal-body ">
                                                <div class="epuipment">
                                                    <span class="equip-sub-heading">Facilities</span>
                                                    <div class="equipment-type-list">
                                                        @foreach($catagory as $facility)

                                                        <div class="equipment-type">
                                                            <div class="equipment-img">
                                                                <img src="{{$facility->ambulance_facilities_image}}" alt="">
                                                            </div>
                                                            <span class="equipment-name" style="font-size:10px;">
                                                            
                                                                {{$facility->ambulance_facilities_name}}

                                                            </span>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    
                                                </div>
                                                <div class="case-list mt-4">
                                                    <span class="equip-sub-heading">For case like:</span>
                                                    <div class="case-list-items">
                                                        <ul>
                                                            <li>Lorem ipsum dolor sit amet. Nam natus omnis quo vtatem 
                                                                Lorem ipsum dolor sit</li>
                                                                
                                                            <li>Lorem ipsum dolor sit amet. Nam natus omnis quo vtatem 
                                                                Lorem ipsum dolor sit</li>
                                                                
                                                            <li>Lorem ipsum dolor sit amet. Nam natus omnis quo vtatem 
                                                                Lorem ipsum dolor sit</li>
                                                                
                                                            <li>Lorem ipsum dolor sit amet. Nam natus omnis quo vtatem 
                                                                Lorem ipsum dolor sit</li>
                                                                
                                                            <li>Lorem ipsum dolor sit amet. Nam natus omnis quo vtatem 
                                                                Lorem ipsum dolor sit</li>
                                                                
                                                            <li>Lorem ipsum dolor sit amet. Nam natus omnis quo vtatem 
                                                                Lorem ipsum dolor sit</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="modal-footer flex-nowrap border-0 justify-content-center">
                                                    <button type="button" class="m-btn" style="color: white;width: fit-content;height: 28px;background-color: #c5354f;" data-bs-dismiss="modal">Back</button>
                                                    
                                                </div>
                                            </div>
                                        
                                            </div>
                                        </div>
                                    </div>   
                                    <!-- read more model end -->
                                             
                                  @endforeach 
                                    <!-- ambu-type end -->
                                </div>
                               </div>
                            <div class="next-btn">
                                 <button  id="loginBtn" class="sub-btn" data-bs-toggle="modal" data-bs-target="#login" disabled  >Next</button>
                            </div>
                            </div>
                    </div>
                <!-- </div> -->
            </div>
        </div>

    </div>
    
</div>
</div>


<!-- Login Modal start -->

                <div class="modal varification-model p-4" id="login" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                         <div class="modal-dialog modal-dialog-top" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <div class="login-header">
                                            <img alt="Medcab" src="assets/image/logo.png" id="popup-header" style="height:30px; width:auto">
                                        <h6 class="modal-title text-secondary"  ></h6>
                                        </div>
                                        
                                        <button type="button" class="modal-close close" style="font-size:1.5rem;" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" style="color:white;font-size:1.rem!important;">&times;</span>
                                        </button>
                                    </div>
                                   
                                    <div class="modal-body ">
                                        <form  method="post" class="login-form" id="loginForm">
                              
                                         <input type="text" name="tokens" id="tokens" hidden content="{{csrf_token()}}">
                                        <div class="form-group p-relative w-100">
                                            <label for="exampleDropdownFormPassword1">Log in to Proceed</label>
                                            <input type="tel" id="phone" class="form-control "   onkeypress="return onlyNumberKey(event)" name="phoneNO" placeholder="Enter Your Mobile number" autofocus>
                                            <span class="text-danger error-message" id="login-message">
                                            @error('phone')
                                                {{ $message }}
                                            @enderror
                                            </span> 
                                        </div>
                                        <div class="modal-footer p-0 flex-nowrap border-0 w-100 justify-content-center">
                                      <input type="submit" class="sub-btn  nextBTn"  id="verify-btn" Value="Verify" >         
                                    </div>      
                                        
                                   
                                 
                                    </form>

                                    <form  method="post" class="login-form" id="registerForm">
                                        <input type="text" name="tokens" id="reg_tokens" hidden content="{{csrf_token()}}">
                                        <div class="form-group p-relative w-100">
                                            <label for="exampleDropdownFormPassword1">Log in to Proceed</label>
                                            <input type="text" id="name" class="form-control "   name="name" placeholder="Enter Your Name" autofocus>
                                            <span class="text-danger error-message" id="register-message" ></span> 
                                        </div>
                                        <div class="modal-footer p-0 flex-nowrap border-0 w-100 justify-content-center">
                                        <input type="submit" class="sub-btn  nextBTn"  id="proceed-btn" Value="Proceed" >         
                                    </div>      
                                        
                                    </form>
                                    <form  method="post" class="login-form" id="otpForm">
                                        <input type="text" name="tokens" id="otp_tokens" hidden content="{{csrf_token()}}">
                                        <div class="form-group p-relative w-100">
                                            <label for="exampleDropdownFormPassword1">Log in to Proceed</label>
                                            <input type="tel" id="otp" class="form-control "  onkeypress="return onlyNumberKey(event)" name="otp" placeholder="Enter 6 digit OTP" autofocus>
                                            <span class="text-danger error-message" id="otp-message"></span> 
                                        </div>
                                        <div class="modal-footer p-0 flex-nowrap border-0 w-100 justify-content-center">
                                        <input type="submit" class="sub-btn  nextBTn"  id="otp-btn" Value="Verify OTP" >         
                                    </div>      
                                        
                                    {{session()->get('consumer_name')}}
                                    </form>
                                    </div>
                                </div>    
                            </div>
                    </div>
                </div>   
                                
<!-- Login Modal end -->
<script>
$(document).ready(function(){
    var consumer_name="<?php echo  session('consumer_name');?>";
    var consumer_mob="<?php echo  session('consumer_mob');?>";
    $('#loginBtn').prop('disabled', true);
    $('#loginBtn').click(function(){
        if(consumer_name=="" && consumer_mob==""){
            $('.varification-model').modal({
                backdrop: 'static',
                keyboard: false
            },'show');


        }
        else{
            alert("already logged in"+consumer_name+consumer_mob);
            $('.varification-model').modal('hide');
          
                    var ambu_type=$('#selected-ambu-type-box').children('.ambu-types-detail').children('.ambu-type-heading').text();
                    var ambu_price=parseInt($('#selected-ambu-type-box').children('.ambu-type-price-detail').children('.ambu-price').text()); 
                    window.location.replace(
                    '{{url("/consumer/ambu_detail")}}'+"/"+ambu_type+"/"+ambu_price
                    );
                   

        }
        if($(this).data('clicked')) {
            alert('Please select ambulance type!');
        }
    });
    $('.ambu-type-box').click(function(){
        $('.ambu-type-box').attr('id','');
        $(this).attr('id', 'selected-ambu-type-box');
            $('#loginBtn').prop('disabled', false);
            $('.sub-btn').css('opacity','1');
    });
});


    //login submit
    $('#loginForm').on('submit',function(e){
    e.preventDefault();
    let phone = $('#phone').val();
    var ambu_type=$('#selected-ambu-type-box').children('.ambu-types-detail').children('.ambu-type-heading').text();
    var ambu_price=parseInt($('#selected-ambu-type-box').children('.ambu-type-price-detail').children('.ambu-price').text());  
    token=$('#tokens').attr('content');
    if(phone!=""){
            
            $.ajax({
            url: "/login_varification",
            type:"POST",
            data:{_token:token,phone:phone,ambu_type:ambu_type,ambu_price:ambu_price},
            beforeSend: function() { 
                $("#verify-btn").prop('disabled', true); // disable button
                },
            success:function(response){ 
                console.log(response);
                // $('#login-message').html(response.phone[0]);
                $("#phone").focus();
                if(response.code==0){
                    $('#loginForm').css('display','none');
                    $('#otpForm').css('display','flex');
                    $("#otp-message").html(response.otp);
                }
                else if(response.code==1){
                    $('#loginForm').css('display','none');
                    $('#registerForm').css('display','flex');
                    $("#register-message").html(response.message);
                }
                else{
                $(".error-message").html(response.message);
                }
                console.log(response);
                $("#verify-btn").prop('disabled', false); // enable button
                $("#loginForm")[0].reset();
                
            },
                error: function(response) {
                $(".error-message").html(response.message);
                console.log(response);
                },
        });
        }
        else{
            alert("Please enter your mobile number");
            $('#phone').focus();
            $(".error-message").html("Please enter your mobile number to proceed");
            }

    });
   //login submit
$('#otpForm').on('submit',function(e){
    e.preventDefault();

    let input_otp = $('#otp').val();
    $('#otp').focus();
    let token=$('#otp_tokens').attr('content');
    let otp=$("#otp-message").html();
    if(input_otp!=""){
        if(input_otp==otp){
            
            $.ajax({
            url: "/otp_match",
            type:"POST",
            data:{_token:token,otp:input_otp},
                success:function(data){ 
                $(".otp-message").html(data.message);
                $("#otp-btn").prop('disabled', false); // enable button
                $("#otpForm").html(data.message);
                $('#welcome-user').append("<b>"+data.consumer_name+"</b>");
                alert(data.message);
                window.location.replace(
                    '{{route("booking_page")}}'
                    );
                console.log(data);
                },

                error: function(response) {
                alert(response.message);
                $(".otp-message").html(response.message);
                console.log(response);
                },
            });
        }
        else if(input_otp!=otp){
            alert("otp not matched!");
            $('#otp').focus();
            $("#otp-message").html("otp not matched!"); 

        }
        else{
            alert("please enter otp for proceed");
            $('#otp').focus();
            $("#otp-message").html("Please enter otp for proceed");
            }


    }
    else{
        alert("please enter otp for proceed");
            $('#otp').focus();

    }
   
    });


    //otp verification
    $('#registerForm').on('submit',function(e){
    e.preventDefault();
    let name = $('#name').val();
    var ambu_type=$('#selected-ambu-type-box').children('.ambu-types-detail').children('.ambu-type-heading').text();
    var ambu_price=parseInt($('#selected-ambu-type-box').children('.ambu-type-price-detail').children('.ambu-price').text());
    token=$('#reg_tokens').attr('content');
    alert(ambu_type+ambu_price);
    if(name!=""){
            
            $.ajax({
            url: "/consumer/register_user",
            type:"POST",
            data:{_token:token,name:name,ambu_type:ambu_type,ambu_price:ambu_price},
                beforeSend: function() { 
                $("#proceed-btn").prop('disabled', true); // disable button
                },
                success:function(regResponse){ 
                    $("#phone").focus();
                if(regResponse.status==0){
                    $('#registerForm').css('display','none');
                    $('#otpForm').css('display','flex');
                    $("#otp-message").html(regResponse.otp);
                }
                else if(regResponse.status==1){
                    $('#registerForm').css('display','flex');
                    $("#register-message").html(regResponse.message);
                }
                else{
                $(".error-message").html(regResponse.message);
                }    
                $("#welcome-user").html(regResponse.consumer_name);
                console.log(regResponse);
                $("#proceed-btn").prop('disabled', false); // enable button
                $("#registerForm").html(regResponse.message);
                
                },
                error: function(regResponse) {
                    alert("name not matched!");
                    $('#name').focus();
                    $(".register-message").append("<br>"+regResponse.message+"<br/>");
                    console.log(regResponse);
                },
        });

        }
        else{
            alert("Please enter your name");
            $('#name').focus();
            $(".register-message").html("Please enter your name to proceed");
            }

    });
function initMap() {
    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;
    var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 16,
    center: {lat: 41.85, lng: -87.65}
    });
    directionsDisplay.setMap(map);
    calculateAndDisplayRoute(directionsService, directionsDisplay);
}

function calculateAndDisplayRoute(directionsService, directionsDisplay) {
    directionsService.route({
    origin:"{{$users['pick']}}",
    destination: "{{$users['drop']}}",
    travelMode: 'DRIVING'
    }, function(response, status) {
    if (status === 'OK') {
        directionsDisplay.setDirections(response);
        console.log(directionsDisplay);

    } else {
        window.alert('Directions request failed due to ' + status);
    }
    });
}
</script>

@endsection

