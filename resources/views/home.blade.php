
@extends('layouts.adminlayout')
@section('title',"Home")
@section('main')
<div>
    
<div class="container main-container pt-5">
    <div class="row p-5">
        <div class="col-md-6 col-sm-12">
            <div class="card pick-drop mb-4">
            <form method="post"  action="/search" class="px-4 py-3 " id="loc-form">
            @csrf    
            <div class="form-group">
                <label for="exampleDropdownFormEmail1">PickUp Location</label>
               <div class="input-group pick-group justify-content-center align-items-center">
               <input type="text" class="form-control pick b-none"  name="pick"  id="pickup" placeholder="Enter Pickup location here">
            <i class="fa-solid fa-location-crosshairs control-icon"  id="current_location"></i>
            <i class="fa-solid fa-xmark reset-input control-icon"></i>
                <input type="hidden" id="lat" name="pick_lat" value="lat">
                <input type="hidden" id="lng" name="pick_lng" value="lng">
               </div>
                </div>
                <div class="form-group p-relative">
                    <label for="exampleDropdownFormPassword1">Drop Location</label>
                    <input type="text" class="form-control" id="drop" name="drop" placeholder="Enter Desination location here">
                    <input type="hidden" name="drop_lat" id="drop_lat"  value="lat">
                    <input type="hidden" name="drop_lng" id="drop_lng"  value="lng">

                    <div class="suggestion" id="popup_sugg">
                        <p style="color:gray;font-style:italic; margin:10px;margin-bottom:0px;">Nearest Hospitals:</p>
                        <hr class="m-0">
                        <div class="suggestion-box popup-box"></div>
                </div>
                </div>
                <input type="text" name="distance" id="distance" hidden>
                <div class="input-group " id="schedule" style="border:1px solid gray;border-radius:.375rem;border-color:#ced4da">
                  
                    <label class="input-group-btn" for="txtDate">
                        <span class="btn btn-default">
                        <i class="fa-solid fa-calendar-days"></i>
                        </span>
                    </label>
                    <input id="txtDate" name="schedule-time" type="text" class="form-control date-input b-none" title="date" style="border:none;" placeholder="Schedule Now" />
                </div>

                <div class="input-group d-flex justify-content-between align-items-center" style="border:0px solid gray;border-radius:.375rem;border-color:#ced4da; font-size:12px;">
                    <div class="book-type d-flex align-items-center ">
                        
                        <input id="book-now" type="radio" name="booking" class="mr-2" style="border:none;"  checked/>
                        <label for="" class="ml-2">Book Now</label>
                    </div>
                    <div class="book-type d-flex  align-items-center gy-2">
                       
                        <input   type="radio" class="mr-2" name="booking" id="schedule-now" data-toggle="modal" data-target="#ModalCenter" style="border:none;"  />
                        <label for="" class="ml-2">Schedule Now</label>
                    </div>
             
              </div>
              <!-- Button trigger modal -->
             
                <button type="submit" id="submit-btn" class="btn btn-primary" onsubmit="return droplatlng(this);"> Search Ambulance</button>
            </form>
           

        </div>

        
    </div>
    <div class="col-sm-12 col-md-6">
            <div id="suggestion" class="suggestion">
                    <h6>Nearest Hospitals List:</h6>
                    <div class="row suggestion-box right-box">
                       
                    </div>
                </div>
    </div>
</div>

</div>


<!-- Modal -->
<div class="modal" id="ModalCenter" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h6 class="modal-title text-secondary" id="exampleModalCenterTitle" >Schedule Ambulance</h6>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <!-- <span aria-hidden="true">&times;</span> -->
        </button>
      </div>
      <div class="modal-body ">
            <div class="schedule-boxx">
            <div class="input-group mb-2" id="schedule" style="border:1px solid gray;border-radius:.375rem;border-color:#ced4da">
                  
                  <label class="input-group-btn" for="txtDate">
                      <span class="btn btn-default">
                      <i class="fa-solid fa-calendar-days"></i>
                      </span>
                  </label>
                  <input id="datepicker" type="date" data-date="" data-date-format="DD MMMM YYYY" class="form-control date-input b-none" style="border:none;"  placeholder="Select Date" />
              </div>
              
              <div class="input-group mb-2 " id="schedule" style="border:1px solid gray;border-radius:.375rem;border-color:#ced4da">
                  
                    <label class="input-group-btn" for="txtDate">
                        <span class="btn btn-default">
                        <i class="fa-regular fa-clock"></i>
                        </span>
                    </label>
                    <input id="timepicker" type="time" class="form-control date-input b-none" style="border:none;"  placeholder="Select Time" />
                </div>

                <p>Lorem ipsum dolor sit amet. Nam natus omnis quo vtatem similique et velit.</p>
                <p>Lorem ipsum dolor sit amet. Nam natus omnis quo vtatem similique et velit.</p>
                <p class="text-danger">Term & Condition</p>
            </div>
      </div>
      <div class="modal-footer flex-nowrap border-0">
        <button type="button" class="m-btn medcab-btn-transparent" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="m-btn w-100 medcab-btn" id="confirm-btn">Confirm</button>
      </div>
    </div>
  </div>
</div>

<div id="map" style="height:300px;width:100%;"></div>



<script>
    
$(document).ready(function(){
    $('#schedule-now').on('click', function () {
        $('#ModalCenter').modal('toggle');
        alert("show model");
     })
     
    

    $('#lat').val("done");

             var  pickUp_autocomplete= new google.maps.places.Autocomplete((document.getElementById('pickup')),{
                types:['geocode'],
                
            });

            var  drop_autocomplete= new google.maps.places.Autocomplete((document.getElementById('drop')),{
                types:['hospital'],
            });

              // Getting and setting Current location(name) to drop input 
              $('#current_location').click(function() {
                         $(this).hide();
                        $('.reset-input').show();
                        if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(showPosition);
                        } else { 
                        console.log("Geolocation is not supported by this browser.");
                        }     
                               
                     });


                     function showPosition(position) {     
                                
                                var val_lat=parseFloat(position.coords.latitude);
                                var val_lng=parseFloat(position.coords.longitude);
                                map = new google.maps.Map(document.getElementById("map"), {
                                    center: { lat:position.coords.latitude , lng:position.coords.longitude },
                                    zoom: 6,
                                });
                                
                                 initialize(val_lat,val_lng);
                                var infoWindow = new google.maps.InfoWindow();
                                const geocoder= new google.maps.Geocoder();
                                geocodeLatLng(geocoder,val_lat,val_lng);  
                             
                             }


                             function geocodeLatLng(geocoder,val_lat,val_lng){
                                        const latlng= { lat:val_lat, lng:val_lng };
                                        geocoder.geocode({location:latlng}).then((response)=>{
                                        $('#pickup').val(response.results[0].formatted_address);
                                    })
                            
                            }



        var mapp;
        var initmap;
        function initialize(latitude,longitude) {
        if(latitude!="" && longitude!=""){
            var pyrmont = new google.maps.LatLng(latitude,longitude); // sample location to start with: Mumbai, India
            mapp = new google.maps.Map(document.getElementById('map'), {
            center: pyrmont,
            zoom: 15
            });
            var request = {
            location: pyrmont,
            radius: 1000,
            types: ['hospital','clinic'] // this is where you set the map to get the hospitals and health related places
            };
            $('#lat').val(latitude);
            $('#lng').val(longitude);
            var service = new google.maps.places.PlacesService(mapp);
            service.nearbySearch(request, callback);
         }
    }
 
        function callback(results, status) {
        if(status == google.maps.places.PlacesServiceStatus.OK) {
            var arr =[];
            var p_lat=$('#lat').val();
            var p_lng=$('#lng').val();

            for (var i = 0; i <5; i++) {
                    createMarker(results[i]);
                   var  d_lat=results[i].geometry.location.lat()
                    var d_lng=results[i].geometry.location.lng()
                    var dis=distance(p_lat,p_lng,d_lat,d_lng);
                    var usr ={};
                    usr.name = results[i].name;
                    usr.drop_lat = d_lat;
                    usr.drop_lng = d_lng;
                    usr.vicinity = results[i].vicinity;
                    usr.distance=dis.toFixed(3);
                    // console.log(usr.distance);
                    arr.push(usr);
                }
            showList(arr,results);
            }
        }

        function showList(placelist,results){
            $('.popup-box').html('');
            $('.right-box').html('');
                var i=1;
                for (var place in placelist){
               var formated_address=placelist[place].name.concat(' ',placelist[place].vicinity);
            var places="<div class='hospital-name' id='name-"+i+"' value='"+placelist[place].name.concat(' ',placelist[place].vicinity)+"' onclick='myFunction(this)'  d_lat='"+placelist[place].drop_lat+"' d_lng='"+placelist[place].drop_lng+"' > <img src='"+results[2].icon+"'/><span>"+placelist[place].name+"<br/>"+placelist[place].vicinity+"</span><span >"+placelist[place].distance+"<br>km</br></span></div>";
           console.log(placelist[place].name.concat(' ',placelist[place].vicinity));
            var place_box=" <div class='col-xs-12 col-sm-6 pt-2 pb-2'>"+
                            "<div class='suggestion-card hospital-name card p-2'>"+
                                    "<span d_lat='"+placelist[place].drop_lat+"' d_lng='"+placelist[place].drop_lng+"'>"+placelist[place].name+"<br/>"+placelist[place].vicinity+"</span>"+
                            "</div>"+
                        "</div>";
                    $('.suggestion-box.right-box').append(place_box);
                   
                    $('.popup-box').append(places);
                    i++;
                }
            
            }

            function createMarker(place) {
                var placeLoc = place.geometry.location;
                var marker = new google.maps.Marker({
                    map: mapp,
                    position: place.geometry.location,
                    
                });

                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.setContent(place.name);
                    infowindow.open(mapp, this);
                });
            }


    function get_location(pickup){
          
          if($('#pickup').val()!=''){
          var geocoder = new google.maps.Geocoder();
          var address=$('#pickup').val();
              geocoder.geocode( { 'address': pickup}, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                  var pick={};
                  pick['pick_lat']=results[0].geometry.location.lat();
                  pick['pick_lng']=results[0].geometry.location.lng();
                  var latitude = results[0].geometry.location.lat();
                  var longitude = results[0].geometry.location.lng();
                  $('#lat').val(latitude);
                  $('#lng').val(longitude);  
              }  
               initialize(latitude,longitude);  
              }); 
          }
          
        }


        $('.reset-input').click(function() {
                        $('#pickup').val(''); 
                        $(this).hide();
                        $('#current_location').show();
                        $('#suggestion').html('');
                        $('#popup_sugg').html('');
                        $('.suggestion').hide();
                        $('#map').html('');
                        initialize("","");
                    });
                  

                    $('#pickup').click(function(){
                        $(this).val('');
                        $('#map').html('');
                        $('.right-box').html('');
                        $('.popup-box').html('');
                    
                    });

        $('#drop').click(function(){
            pickup=$('#pickup').val();
            drop=$('#drop').val();
            if(pickup!=''){
                  get_location(pickup);
                 $('#popup_sugg').show();
               
            }
            else if(pickup!="" && drop!=""){
                $('#drop').val(''); 
                alert("enter your drop location");
            }
            else{
                alert($('#pickup').val()+"Please Enter Pick Up address first!");
            }
         

        });

    
        $('#drop').keydown(function(){
            $("#popup_sugg").hide();
        });
      
        $('#pickup').change(function(){

        });
        


    
       
$('#drop').change(function(){
    let origin=$('#pickup').val();
    let destination=$('#drop').val();
    let dist=calculateDistance(origin,destination);
    alert("origin="+origin+"destination="+destination+"distance="+dist);
    $('#distance').val(dist);

});

    //calling callback function
    
     
    function distance(lat1, lon1, lat2, lon2) {
        var p = 0.017453292519943295;    // Math.PI / 180
        var c = Math.cos;
        var a = 0.5 - c((lat2 - lat1) * p)/2 + 
                c(lat1 * p) * c(lat2 * p) * 
                (1 - c((lon2 - lon1) * p))/2;
                var distance=12742 * Math.asin(Math.sqrt(a));
        return  12742 * Math.asin(Math.sqrt(a));
        // console.log(distance);
        }

});

var elements = document.getElementsByClassName("hospital-name");

var myFunction = function(e) {
    var drop = e.getAttribute("value");
    document.getElementById('drop').value=drop;
    $('#popup_sugg').hide();
    var pickup=$('#pickup').val();
    var drop_lat=e.getAttribute("d_lat");
    var drop_lng=e.getAttribute("d_lng");
    $('#drop_lat').val(drop_lat);
    $('#drop_lng').val(drop_lng);
    console.log("latitude="+ drop_lat+" longitude="+drop_lng);                 
 
    

    calculateDistance(pickup,drop);
    // alert($("#distance").val());
}

for (var i = 0; i < elements.length; i++) {
    elements[i].addEventListener('click', myFunction, false);   
}
       


function calculateDistance(origin,destination) {
        var service = new google.maps.DistanceMatrixService();
        service.getDistanceMatrix(
            {
                origins: [origin],
                destinations: [destination],
                travelMode: google.maps.TravelMode.DRIVING,
                unitSystem: google.maps.UnitSystem.IMPERIAL, // miles and feet.
                // unitSystem: google.maps.UnitSystem.metric, // kilometers and meters.
                avoidHighways: false,
                avoidTolls: false
            }, callback_cal);
    }


    //calling callback function
    function callback_cal(response, status) {
        console.log(response);
        if (status != google.maps.DistanceMatrixStatus.OK) {
            $('#result').html(err);
        } else {
            var origin = response.originAddresses[0];
            var destination = response.destinationAddresses[0];
            if (response.rows[0].elements[0].status === "ZERO_RESULTS") {
                $('#result').html("Better get on a plane. There are no roads between "  + origin + " and " + destination);
            } else {
                var dis_in_km;
                dis_in_km= response.rows[0].elements[0].distance.value/1000;
                $("#distance").val(dis_in_km);
                alert( dis_in_km);
               
            }
        }
    }

function droplatlng(e){
    drop=$('#drop').val();
  e.preventDefault();
    if(drop!=""){
        var geocoder = new google.maps.Geocoder();
        alert("drop location"+drop);
        geocoder.geocode( { 'address': drop}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var drop_lat = results[0].geometry.location.lat();
                  var drop_lng = results[0].geometry.location.lng();
                  $('#drop_lat').val(drop_lat);
                  $('#drop_lng').val(drop_lng); 
                  alert($('#drop_lat').val());
                  alert($('#drop_lng').val());
                  console.log("latitude="+ drop_lat+" longitude="+drop_lng); 
                  alert("latitude="+drop_lat+" longitude="+drop_lng);
                  return false; 
                }  
                
              
              });           
    }
    else{
        return false;
    }
  

}

</script>
@endsection
