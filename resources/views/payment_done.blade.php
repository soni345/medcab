

@extends('layouts.configLayout')

@extends('layouts.header')
@section('title',"Waiting for ambulance..")


<style>
    
.loading {
    display: flex;
    justify-content: center;
    margin: 100px 0;
}

.loading div,.dot {
    font-size:20px;
    font-weight: bold;
    animation-name: word-loading;
    animation-duration: 2.7s;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
    animation-direction: normal;

}
.dot{
    display:flex;
    justify-content: center;
    align-items:center;
}
.dot span{
    display:block;
    height:5px;
    width:5px;
    background-color: white;
    margin-left:5px;
}
@keyframes word-loading {
    0% {
        margin: 0;
        color: white;
    }

    100% {
        margin: 0;
        color: transparent;
    }


}

.l {
    color: white;
    animation-play-state: paused;
}

.o {
    animation-delay: .3s;

}

.a {
    animation-delay: .6s;
}

.d {
    animation-delay: .9s;
}

.i {
    animation-delay: 1.2s;
}

.n {
    animation-delay: 1.5s;
}

.g {
    animation-delay: 1.8s;
}
.dot-1{
    animation-delay: 2.1s;
}
.dot-2{
    animation-delay: 2.4s;
}
.dot-3{
    animation-delay: 2.7s;
}
</style>

<div class="container h-100 d-flex justify-content-center flex-column align-items-center">
    <a href="{{route('Home')}}" class="move-page-btn mb-4">
        <i class="fa-solid fa-arrow-left-long"></i>Booking:Waiting For Ambulance Driver
    </a>
    <div class="waiting-container d-flex  gap-3 justify-content-center flex-column align-items-center  rounded-3 h-80 w-100 p-5 text-center" style="background-color:#159D89;
;">
        <h6 class="text-light fw-bold">Your Payment is done. <br/></h6>
        <h2 class="text-center text-light fw-bold">Finding Nearest Ambulance To your location</h2>
        <div class=" h-40 w-40 rounded-circle d-flex justify-content-center align-items-center"  style="height:200px;width:200px;position:relative;">
            <div class=" h-100 w-100 over-lay rounded-circle" id="waiting-map" style="height:200px;width:200px; background-color:rgba(225,225,225,.8);"></div>
           <div class="map-overlay">
            <!-- <div class=" waitingLoader rounded-circle" style="z-index:1111;" ></div> -->
            <div class="loading">
                <div class="l">l</div>
                <div class="o">o</div>
                <div class="a">a</div>
                <div class="d">d</div>
                <div class="i">i</div>
                <div class="n">n</div>
                <div class="g">g</div>
                <div class="dot dot-1"><span></span></div>
                <div class="dot do1-2"><span></span></div>
                <div class="dot dot-3"><span></span></div>
            </div>

           </div>
            
   
        </div>
       
    </div>
</div>


<script>
    window.onload = function() {
    createMapFun("{{session('users.drop_lat')}}","{{session('users.drop_lng')}}",'waiting-map');
    myVar = setTimeout(function(){
        window.location.replace ("{{url('/driver/driver_assigned')}}");
        
        alert("done");
    }, 3000);
    }
    
 
    // function myFunction() {
    // myVar = setTimeout(function(){
    //     window.location.replace = "url('/assigned_Driver')";
    // }, 3000);
    // }

</script>
