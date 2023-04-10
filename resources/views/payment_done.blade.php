

@extends('layouts.configLayout')

@extends('layouts.header')
@section('title',"Waiting for ambulance..")



    <?php if(!empty($success)){?>
        <script>
alert('{{$success}}');
console.log('{{$success}}');
</script>
<?php }
else{
    echo "<h1>empty variable</h1>";
}
?>
<?php
print_r(Session::all());

?>
<a href="">{{session::get('consumer.pay_amount')}}dfghjkl</a>
<div class="container h-100 d-flex justify-content-center flex-column align-items-center">
    <a href="{{route('Home')}}" class="move-page-btn mb-4">
        <i class="fa-solid fa-arrow-left-long"></i>Booking:Waiting For Ambulance Driver
    </a>
    <div class="waiting-container d-flex  gap-3 justify-content-center flex-column align-items-center  rounded-3 h-80 w-100 p-5 text-center" style="background-color:#159D89;
;">
        <h6 class="text-light fw-bold">Your Payment is done. <br/></h6>
        <h2 class="text-center text-light fw-bold">Finding Nearest Ambulance To your location</h2>
        <div class=" h-40 w-40 rounded-circle d-flex justify-content-center align-items-center" id="waiting" style="height:200px;width:200px;position:relative;">
            <!-- <div class=" h-100 w-100 rounded-circle"  style="height:200px;width:200px; background-color:rgba(225,225,225,.8);"></div> -->
            <div class=" waitingLoader rounded-circle" style="z-index:1111;" onload="myFunction()"></div>
   
        </div>
       
    </div>
</div>


<script>
    window.onload = function() {
    createMapFun("{{session('users.drop_lat')}}","{{session('users.drop_lng')}}",'waiting-map');
    }
    
    function myFunction() {
    myVar = setTimeout(diverPage, 3000);
    }

    function showPage() {
    document.getElementById("loader").style.display = "none";
    document.getElementById("myDiv").style.display = "block";
    }
</script>
