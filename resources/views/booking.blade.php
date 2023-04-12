
@extends('layouts.adminlayout')
@section('title',"Ambuance-booking")
@section('main')


<?php

if(Session::has('users')){
    $users=session()->get('users');
   
}
?>
 <h2  style="margin-top:70px;">Your Booking ID:
@if(Session::has('booking_id'))
   {{Session::get('booking_id')}}</h2>
@endif

<div class="ambulance-search ">
    <div class="alert alert-primary" role="alert"  style="width:fit-content;float:right;">
        <h2 id="welcome-user">Welcome! @if(Session::has('consumer_name'))
        {{session('consumer_name')}}
        
        @endif        
    </h2>

    </div>
    <div class="ambulace-search-body">
        <div class="container">
        <div class="container-body" style="width:fit-content;">
        <a href="" class="move-page-btn"><i class="fa-solid fa-arrow-left-long"></i>Ambulance Search </a>
    <div class="ambulance-search-body">
    <!-- <div class="row"> -->
                <div class=" ambu-detail-col ambu-search-left">
                        <div class="search-form">
                            <form  id="forms">
                                @csrf
                                <div class="form-group p-relative">
                                    <label for="exampleDropdownFormPassword1">Drop Location</label>
                                    <input type="text" class="form-control" readonly id="drop" value="{{$users['pick']}}" name="drop" placeholder="Enter Desination location here">
                                </div>
                                <div class="form-group p-relative">
                                    <label for="exampleDropdownFormPassword1">Drop Location</label>
                                    <input type="text" class="form-control" readonly id="drop" value="{{$users['drop']}}" name="drop" placeholder="Enter Desination location here">
                                </div>
                                <div class="form-group p-relative book-here">
                            <!-- <i class="fa-regular fa-clock"></i> -->
                                    <span class="book-detail">
                                            {{$users['distance']}} km
                                    </span>
                                </div>
                            </form>
                            <div class="map-container">
                                <div id="map" style="height:100%;width:100%;"></div>
                            </div>
                        </div>
                </div>
                <div class=" ambu-detail-col ambu-search-right">
                            <div class="ambu-types">
                            <div class="ambu-types-body  h-100">
                                <h5 class="type-heading"> Booking For</h5>
                                    <div class="ambu-types-list h-100 d-flex flex-column">
                                           <div class="ambu-facilities-list">
                                           <div class="ambu-type-box p-relative p-0 border border-0">
                                                <div class="ambu-types-img" style="height:50px;width:50px;border:1px solid gray;">
                                                    <!-- <img src="assets/catagory_icon/amb_icon.png" alt="" style="height:100px;width:100px;"> -->
                                                </div>
                                                <div class="ambu-types-detail">
                                                    <h4 class="ambu-type-heading">@if(Session::has('ambu_type'))
                                                        {{Session::get('ambu_type')}}
                                                        @endif
                                                    </h4>
                                                    <a  class="type-read-more-btn" data-bs-toggle="modal" data-bs-target="#basic"> Read more</a>
                                                </div>
                                                <div class="ms-auto ambu-type-price-detail">
                                                    <span class="ambu-price"><i class="fa-solid fa-indian-rupee-sign mr-1"></i>
                                                    @if(Session::has('ambu_price'))
                                                        {{Session::get('ambu_price')}}
                                                        @endif
                                                    </span>
                                        
                                                </div>
                                            </div>  
                                           </div>
                                        <div class="total-amount">
                                            <span>Total Amount</span>
                                            <span class="t-amount"><i class="fa-solid fa-indian-rupee-sign ml-3"></i></span>
                                        </div>
                                        <div class="add-on">
                                            <div class="add-support-toggler">
                                                <div class="toggle-text">
                                                <i class=" fa fa-light fa-circle-plus"></i>
                                                &nbsp;&nbsp;<span>Add Support Specialists</span></div>

                                                <div class="toggle-icon">
                                                <i class="fa-solid fa-chevron-down"></i>
                                            </div>
                                            </div>

                                            <div class="add-support flex-wrap">
                                                @if(Session::has('support_list'))
                                                <?php $i=0;
                                                $supports=Session::get('support_list');
                                                
                                                ?>
                                                @foreach(Session::get('support_list') as $support_list)

                                               <?php $i++;?>
                                               @if($i<=3)
                                                <div class="add-support-item flex-basis-50">
                                                    <span class="support-header">
                                                        <span class="support-name">{{$support_list->ambulance_support_specialists_name}}</span>
                                                        <span class="support-price"><i class="fa-solid fa-indian-rupee-sign ml-3"></i>{{$support_list->ambulance_support_specialists_amount}}</span>
                                                    </span>
                                                    <p class="support-des">
                                                    Lorem ipsum dolor sit amet. Nam natus omnis quo vtatem similique et velit.
                                                    </p>
                                                    <div class="support-control-btn">
                                                        <button class="addon-btn add-btn">Add</button>
                                                        <button class="addon-btn added-btn"><i class="fa-solid fa-check"></i>Added</button>
                                                        <button class="addon-btn remove-btn">Remove</button>
                                                    </div>
                                                </div>
                                                @endif
                                                @endforeach
                                                @endif
                                                
                                            </div>
                                        
                                        </div>
                                        <div class="payment">
                                                <span class=" form-heading">
                                                    Select payment Type: </span>
                                                <div class="payment-type">
                                                            <div class="payment-type-item">
                                                                <input type="radio" name="pay_method" value="1" class="full_pay" id="pay_full_radio"><span class="payment-type-name" id="pay_full">Full payment<br/><i class="fa-solid fa-indian-rupee-sign"></i>&nbsp;<span>4000</span></span>
                                                            </div>
                                                            <div class="payment-type-item">
                                                                <input type="radio" name="pay_method" value="2" class="full_pay" id="pay_advance" ><span class="payment-type-name" >Pay Advance<br/><i class="fa-solid fa-indian-rupee-sign"></i>&nbsp;<span id="adv"></span></span>
                                                                
                                                            </div>
                                                           
                                                </div>  
                                        </div>
                                        <div class="alert alert-warning payment-alert gx-1 mt-2" role="alert" style="display:none;">
                                                            <i class="fa-solid f-2x fa-circle-exclamation m-1"></i>
                                                            <div class="payment-notice-mess w-100">
                                                                <div class="p-notice-header d-flex" style="justify-content:space-between;">
                                                                    <span class="notice-heading">
                                                                        Remaining Amount
                                                                    </span>
                                                                    <span class="notice-amount">
                                                                    <i class="fa-solid fa-indian-rupee-sign"></i>&nbsp;
                                                                    </span>
                                                                </div>
                                                                <p class="notice-des">
                                                                    You have to pay remaining amount after <br/> complitions of the ride.

                                                                </p>

                                                            </div>
                                                            
                                                            </div>
                                    <div class="consumer-form   flex-shrink-0">
                                            <span class="consumer-form-heading form-heading">
                                                                Add Customer Details </span>
                                        <div class="consumer-form  ">               
                                            <form  id="consumer-detail-form h-100" >
                                            @csrf
                                            <div class="form-field">
                                                    <div class="form-group p-relative">
                                                    @if($message = Session::get('consumer_name'))
                                                    <label >Customer Name</label>
                                                    <input type="text" class="form-control"  id="c_name" value="{{session('consumer_name')}}" name="c_name" placeholder="Enter Your Name">
                                                    @endif
                                            </div>
                                            <input type="hidden" name="pay_type" id="pay_type" value="">
                                         
                                            <div class="form-group p-relative">
                                                @if($message = Session::get('consumer_mob'))
                                                <label>Phone Number</label>
                                                <input type="text" class="form-control"  id="c_mob" value="{{session('consumer_mob')}}" name="c_mob" placeholder="Enter Mobile Number">
                                                @endif
                                            </div>
                                            </div>
                                            <button type="submit"  id="cust-btn" disabled>
                                                Proceed
                                            </button>
                                            </form>    
                                        </div>
                                    </div>
                                        <!-- Read MOre model start -->
                                    <div class="modal p-3" id="basic" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header border-0">
                                                <h6 class="modal-title text-secondary" id="exampleModalCenterTitle" >Basic Ambulance</h6>
                                                <button type="button" class="modal-close close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        
                                            <div class="modal-body ">
                                                <div class="epuipment">
                                                    <span class="equip-sub-heading">Facilities</span>
                                                    <div class="equipment-type-list">
                                                        ghfjdkkgj
                                                        <div class="equipment-type">
                                                            <div class="equipment-img">
                                                                <img src="" alt="">
                                                            </div>
                                                            <span class="equipment-name" style="font-size:10px;"> 
                                                            h,gfhj
                                                            </span>
                                                        </div>
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
                                    <!-- ambu-type end -->
                                    <div class="payment-method flex-column">
                                            <span class="form-heading">Select Payment Method</span>
                                            <div class="payment-group" id="pay">
                                                
                                                <div class="payment-group-left" >
                                                     <img src="assets/icons/card.png" alt="" class="payment-icon">
                                                     <span class="payment-method-name">Debit/Credit card</span>
                                                </div>
                                                <i class="fa-solid fa-chevron-right"></i>
                                            </div>
                                            <span class="pay-option text-gray">Pay Via UPI</span>

                                            <div class="payment-group">
                                                
                                                <div class="payment-group-left">
                                                     <img src="assets/icons/Gpay.png" alt="" class="payment-icon">
                                                     <span class="payment-method-name">Gpay</span>
                                                </div>
                                                <i class="fa-solid fa-chevron-right"></i>
                                            </div>
                                            <div class="payment-group">
                                                
                                                <div class="payment-group-left">
                                                     <img src="assets/icons/paytm.png" alt="" class="payment-icon">
                                                     <span class="payment-method-name">Paytm</span>
                                                </div>
                                                <i class="fa-solid fa-chevron-right"></i>
                                            </div>
                                            <div class="payment-group">
                                                
                                                <div class="payment-group-left">
                                                     <img src="assets/icons/upi.jpg" alt="" class="payment-icon">
                                                     <span class="payment-method-name">Bhim UPI</span>
                                                </div>
                                                <i class="fa-solid fa-chevron-right"></i>
                                            </div>

                                    </div>  
                                </div>
                            </div>
                            </div>
                    </div>
                
                </div>
        </div>
        </div>
    </div>
</div>

                                    <!-- Read MOre model start -->
<script>
   
    window.onload = function() {
        var tp=parseInt($('.ambu-price').text());
        $('.t-amount').html('<i class="fa-solid fa-indian-rupee-sign mr-1"></i>'+$('.ambu-price').text());
        $('#adv').html((tp*10)/100);
        polyline_display("{{$users['pick']}}","{{$users['drop']}}","map");
        $('.add-support-toggler').click(function(){
            $(".add-support").toggleClass('show');   
            $('.toggle-icon .fa-chevron-down').toggleClass('move'); 
        }); 
        
        $('.full_pay').click(function(){
            $('#cust-btn').prop('disabled', false);
            $('#cust-btn').css('opacity','1');
            $('#pay_type').val($(this).val());
            
        });

        $('.full_pay').click(function(){
        let check=$('#pay_advance').is(':checked');
        if(check==true){
            $('.payment-alert').css('display','flex');
        }
        else{
            $('.payment-alert').css('display','none');
        }
        });
        //remaining payment calculation
        var full_pay=parseInt($('#pay_full span').text());
        var adv_pay=parseInt($('#adv').text());
        $('#pay_full span').text($('.t-amount').text());
        $('.notice-amount').html(' <i class="fa-solid fa-indian-rupee-sign"></i>&nbsp;'+($('.t-amount').text()-adv_pay));
        $('.t-amount').on('DOMSubtreeModified',function(){
            // alert('changed');
            var full_pay=parseInt($('.t-amount').text());
            console.log(full_pay);
            console.log(adv_pay);
            $('#adv').html((full_pay*10)/100);
            var adv_pay=parseInt($('#adv').text());
            // alert(full_pay+"+"+adv_pay);
            $('.notice-amount').html(' <i class="fa-solid fa-indian-rupee-sign"></i>&nbsp;'+(full_pay-adv_pay));
            // alert($('.t-amount').text());
            $('#pay_full span').text(full_pay);
            })
        
        $('.add-btn').click(function(){
            $(this).css("display","none");
            $(this).siblings('.added-btn').css("display","block");
            $(this).siblings('.remove-btn').css("display","block");
            let s_name=$(this).parent('.support-control-btn').siblings('.support-header').children('.support-name').html();
            let s_price=$(this).parent('.support-control-btn').siblings('.support-header').children('.support-price').text();
            console.log(s_name+s_price);
            var t_amount=parseInt($('.t-amount').text())+parseInt(s_price);
            $('.t-amount').html('<i class="fa-solid fa-indian-rupee-sign"></i>&nbsp;'+t_amount);
            var add_on='<div class="ambu-type-box p-relative p-0 border border-0">'+
                                                '<div class="ambu-types-img" style="height:50px;width:50px;border:1px solid gray;"></div><div class="added-support-detail"><div class="ambu-types-detail">'+
                                                   '<h4 class="ambu-type-heading">'+s_name+'</h4>'+
                                                    '<a  class="type-read-more-btn" data-bs-toggle="modal" data-bs-target="#basic"> Read more</a>'+
                                                '</div>'+
                                                '<div class="ambu-type-price-detail">'+
                                                    '<span class="ambu-price"><i class="fa-solid fa-indian-rupee-sign"></i>&nbsp;'+ s_price+'</span></div></div></div>';
        
                $('.ambu-facilities-list').append(add_on);  
                $(this).closest('.add-support-item').attr('addonsStatus','added');
                var addons_div=$(this).closest('.add-support-item').attr('addonsStatus');
                var supportName=$(this).closest('.add-support-item').find('.support-header').find('.support-name').text();
                var supportPrice=$(this).closest('.add-support-item').find('.support-header').find('.support-price').text();
                
                $.ajax({
                    type:'POST',
                    url:"{{ route('Addons_Session_Save') }}",
                    data:{supportName:supportName,supportPrice:supportPrice},
                    success:function(data){
                    alert(data.status);
                    },
                    error:function(data){
                alert(data.status);
                    }
                });
        });
        <?php
        if (\Session::has('addons_status'))
        {
           ?>
                    // alert("{{Session::get('addons_status').Session::get('error').Session::get('booking_id')}}");
         <?php     
            }
         ?>
        $('.remove-btn').click(function(){
            $(this).closest('.add-support-item').attr('addonsStatus','removed');
            var addons_div=$(this).closest('.add-support-item').attr('addonsStatus');
            var supportName=$(this).closest('.add-support-item').find('.support-header').find('.support-name').text();
            var supportPrice=$(this).closest('.add-support-item').find('.support-header').find('.support-price').text();
              
            $.ajax({
                    type:'POST',
                    url:"{{route('Remove_Addon')}}",
                    data:{supportName:supportName,supportPrice:supportPrice},
                    success:function(data){
                    alert(data.addons_status);
                    },
                    error:function(data){
                alert(data.addons_status);
                    }
                });
            // window.location.replace("{{url('/remove_addon')}}"+"/"+supportName+"/"+supportPrice);
            $(this).css("display","none");
            $(this).siblings('.add-btn').css("display","block");
            $(this).siblings('.added-btn').css("display","none");
            let s_price=$(this).parent('.support-control-btn').siblings('.support-header').children('.support-price').text();
            var n1=$(this).parent('.support-control-btn').siblings('.support-header').children('.support-name').html();
            $(".ambu-type-box").each(function() {
                var nn1=$(this).children('.added-support-detail').find('.ambu-type-heading').html();
                if(n1==nn1){
                    $(this).css('display','none');
                }
            
            });
            var t_amount=parseInt($('.t-amount').text())-parseInt(s_price);
            $('.t-amount').html('<i class="fa-solid fa-indian-rupee-sign"></i>&nbsp;'+(t_amount));
            
        });
    


        $('#cust-btn').on('click',function(event) {
    event.preventDefault(); // Prevent the form from submitting normally
    // alert("hi");
    var c_name=$('#c_name').val();
    var c_mob=$('#c_mob').val();
     var full_amount=$('.t-amount').text(); 
     var adv_amount=(full_amount*10)/100; 
    var pay_type=$('#pay_type').val();
    $.ajax({
     
                type:'POST',
                url:"{{ route('Booking_Process') }}",
                data:{c_mob:c_mob,c_name:c_name,total:$('.t-amount').text(),full_amount:full_amount,adv_amount:adv_amount,pay_type:pay_type},
               
                success:function(data){
                    console.log($('.t-amount').text());
                    console.log($('#consumer-detail-form').serialize());
                if($.isEmptyObject(data.error)){
                    // location.reload();
                    console.log(data.consumer);
                    $('.payment-method').css('display','flex');
                    $('.consumer-form').hide();
                 
                }else{
                    console.log(data.consumer);
                }
                },
            error:function(data){
            console.log(data.status+"wrong");
            }
        });
});

$('#consumer-detail-form').on('submit',function(e){
    e.preventDefault();
    // alert("done");
});

$('.support-header').each(function(){
    var supportName=$(this).find('.support-name').text();
    <?php 
    if(Session::get('booking_addons')){
        foreach(Session::get('booking_addons') as $addon){
            ?>
            if('{{$addon->booking_addons_name}}'==supportName && '{{$addon->booking_addons_status}}'=='0' ){
                    $(this).siblings('.support-control-btn').find('.add-btn').click();
                    // alert("add"+'{{$addon->booking_addons_status}}'=='0');
               
            }
           
            <?php
        }
    }
        
    ?>

})


};




    
</script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var total=document.getElementsByClassName('t-amount')[0].innerText;
var payMethod = document.getElementsByClassName('payment-group');

Array.prototype.forEach.call(payMethod, function(element) {
    element.addEventListener('click', function(e) {
    var amt=$("input[id=pay_full_radio]").siblings('span').children('span').text();
    if($('#pay_advance').is(':checked')){
        var amt=$("input[id=pay_advance]").siblings('span').children('span').text();
        console.log($("input[id=pay_advance]").prop("checked", true));
    }

    // payment script

    if($('input[id="pay_full_radio"]').is(':checked')){
        $('input[id="pay_full_radio"]').click();

    }
    else if($('input[id="pay_advance"]').is(':checked')){
        $('input[id="pay_advance"]').click();
    }
    else{
        console.log("Payment Method not selected!");
    }

    e.preventDefault();
        var amount = $('#payment').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}',
            }
        });
        $.ajax({
            type: "post",
            url: "orderid-generate",
            data: {price:amt},
            success: function (data) {
                var order_id = '';
                if (data.order_id) {
                    order_id = data.order_id;
                }

                var options = {
                    "key": "{{ config('app.razorpay_api_key') }}", // Enter the Key ID generated from the Dashboard
                    "amount": amt*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                    "currency": "{{ config('app.currency') }}",
                    "name": "{{ config('app.account_name') }}",
                    "description":"Your Ride Payment:",
                    "image": "{{ asset('images/logo-black.svg') }}",
                    "order_id": order_id, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                    "handler": function (response) {
                        
                        // $('#razorpay_payment_id').val(response.razorpay_payment_id);
                        // $('#razorpay_order_id').val(response.razorpay_order_id);
                        // $('#razorpay_signature').val(response.razorpay_signature);
                        // $('#addPaymentForm').submit();
                        // alert(" before payment ID:"+response.razorpay_payment_id);
                        window.location.replace("{{url('/payment')}}"+"/"+response.razorpay_payment_id+"/"+response.razorpay_order_id+"/"+response.razorpay_signature);
                        alert("payment ID:"+response.razorpay_payment_id);
                    },
                   
                    "modal": {
                    "ondismiss": function () {
                        if (confirm("Are you sure, you want to close the form?")) {
                        txt = "You pressed OK!";
                        console.log("Checkout form closed by the users");
                        } else {
                        txt = "You pressed Cancel!";
                        console.log("Complete the Payment")
                        }
                    }
                }
                    ,
                    "prefill": {
                        "name": "{{ session('consumer_name') }}",
                        "email": "webdevelopermedcab@gmail.com",
                        "contact": "{{session('consumer_name')}}"
                    },
                    "notes": {
                        "address": "Gomati Nagar, Lucknow, Uttar Pradesh"
                    },
                    "theme": {
                        "color": "#c5354f"
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.on('payment.failed', function (response) {
                        alert("Payment Failded:"+response);
                });

                rzp1.open();


            },

        });


    //end payment script
    
    // var options = {
    //         "key": "rzp_test_O4rVxqV6XkdI2A", // Enter the Key ID generated from the Dashboard
    //         "amount":amt*100 , //
    //         "currency": "INR",
    //         "description": "MED CAB",
    //         "image": "assets/icons/red logo.png",
    //         "prefill":
    //         {
    //         "email": "medcab@gmail.com",
    //         "contact": "9876543210",
    //         },
    //         "theme":{
    //             "color":"#c5354f"
    //         },
    //         config: {
    //         display: {
    //             blocks: {
    //             utib: { //name for Axis block
    //                 name: "Pay using Axis Bank",
    //                 instruments: [
    //                 {
    //                     method: "card",
    //                     issuers: ["UTIB"]
    //                 },
    //                 {
    //                     method: "netbanking",
    //                     banks: ["UTIB"]
    //                 },
    //                 ]
    //             },
    //             other: { //  name for other block
    //                 name: "Other Payment modes",
    //                 instruments: [
    //                 {
    //                     method: "card",
    //                     issuers: ["ICIC"]
    //                 },
    //                 {
    //                     method: 'netbanking',
    //                 }
    //                 ]
    //             }
    //             },
    //             hide: [
    //             {
    //             method: "upi"
    //             }
    //             ],
    //             sequence: ["block.utib", "block.other"],
    //             preferences: {
    //             show_default_blocks: false // Should Checkout show its default blocks?
    //             }
    //         }
    //         },
    //     
    });
});
</script>
