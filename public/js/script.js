
    var latLng;
    const geocoder= new google.maps.Geocoder();
    const  infoWindow = new google.maps.InfoWindow();

    // add autocomplete place search
    google.maps.event.addDomListener(window, 'load', function () {
        var Input_autocomplete = new google.maps.places.Autocomplete(document.getElementById('input-id'));

     });

     //create map
    function createMapFun(latitude,longitude){
        var pyrmont = new google.maps.LatLng(latitude,longitude); // sample location to start with: Mumbai, India
        mapp = new google.maps.Map(document.getElementById('map'), {
        center: pyrmont,//latlng
        zoom: 15
        });

        createMarker(latLng);
    }


    //create map marker
    function createMarkerFun(latLng,icn,name){
        var marker = new google.maps.Marker({
            map: mapp,
            position:latLng,
            icon:icn,
            title:name,
            
        });
    }


    // Nearby Search
    function nearBySearch(latLng){
        var request = {
            location: latLng,
            radius: 1000,
            types: ['hospital','clinic'] // this is where you set the map to get the hospitals and health related places
            };
            infowindow = new google.maps.InfoWindow();
            var service = new google.maps.places.PlacesService(mapp);
            service.nearbySearch(request, callback);


            function callback(results, status) {
                console.log("callback"+google.maps.places.PlacesServiceStatus.OK+" "+results.length);
                if(status == google.maps.places.PlacesServiceStatus.OK) {
                // var placelist=[];
                var placelist={};
                for (var i = 0; i <5; i++) {
                        createMarker(results[i]);
                        placelist[results[i].vicinity] = results[i].name;
                    }
                console.log(placelist);
                }
            }
    }


    //get Current location
    function currentLocation(){
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else { 
            console.log("Geolocation is not supported by this browser.");
            }

           
    }

    function showError(error) {
        switch(error.code) {
        case error.PERMISSION_DENIED:
            x.innerHTML = "User denied the request for Geolocation."
            break;
        case error.POSITION_UNAVAILABLE:
            x.innerHTML = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            x.innerHTML = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            x.innerHTML = "An unknown error occurred."
            break;
             }
        }


    function showPosition(position) {     
                                
        var val_lat=parseFloat(position.coords.latitude);
        var val_lng=parseFloat(position.coords.longitude); 
        console.log("lat="+val_lat+" lng="+val_lng);
        console.log(position.coords.accuracy);
    }


    //Get lat long to address or location
    function geocodeLatLng(geocoder){
        const latlng= { lat:val_lat, lng:val_lng };
        geocoder.geocode({location:latlng}).then((response)=>{
        console.log(response);     
         })

     }

     //get lat long from address or location
     function get_Location_latlng(address){
        var geocoder = new google.maps.Geocoder();
            geocoder.geocode( { 'address': address}, function(results, status) {
                console.log(status+"and"+google.maps.GeocoderStatus.OK);
            if (status == google.maps.GeocoderStatus.OK) {
            
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
            }
        });

     }
        //get address from input on  place_change event
        //  google.maps.event.addListener(from_places, 'place_changed', function () {
        //         var from_place = from_places.getPlace();
        //         var from_address = from_place.formatted_address;
        //         $('#origin').val(from_address);
        //     });



     //distance matrix

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
        if (status != google.maps.DistanceMatrixStatus.OK) {
            $('#result').html(err);
        } else {
            var origin = response.originAddresses[0];
            var destination = response.destinationAddresses[0];
            if (response.rows[0].elements[0].status === "ZERO_RESULTS") {
                $('#result').html("Better get on a plane. There are no roads between "  + origin + " and " + destination);
            } else {
                var detail=[];
                detail['distance'] = response.rows[0].elements[0].distance;
                var duration = response.rows[0].elements[0].duration;
                console.log(response.rows[0].elements[0].distance);
                detail['km'] = distance.value / 1000; // the kilom
                detail['mile'] = distance.value / 1609.34; // the mile
                detail['duration_text']= duration.text;
                detail['duration_value']= duration.value;

                
                // $('#in_mile').text(distance_in_mile.toFixed(2));
                // $('#in_kilo').text(distance_in_kilo.toFixed(2));
                // $('#duration_text').text(duration_text);
                // $('#duration_value').text(duration_value);
                // $('#from').text(origin);
                // $('#to').text(destination);
                // alert("else"+distance_in_kilo);
                return detail['km'];
                console.log(detail['km']);
            }
        }
    }

    //manually calcute distance between 2 location
    function distance(lat1, lon1, lat2, lon2) {
        var p = 0.017453292519943295;    // Math.PI / 180
        var c = Math.cos;
        var a = 0.5 - c((lat2 - lat1) * p)/2 + 
                c(lat1 * p) * c(lat2 * p) * 
                (1 - c((lon2 - lon1) * p))/2;

        return 12742 * Math.asin(Math.sqrt(a)); // 2 * R; R = 6371 km
        }





        // Polyline display
        function polyline_display(origin,destination,map_id) {
            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;
            var map = new google.maps.Map(document.getElementById(map_id), {
              zoom: 16,
              center: {lat: 41.85, lng: -87.65}
            });
            directionsDisplay.setMap(map);
            calculateAndDisplayRoute(directionsService, directionsDisplay,origin,destination);
          
          }
        
          function calculateAndDisplayRoute(directionsService, directionsDisplay,origin,destination) {           
            directionsService.route({
              origin:origin,
              destination:destination,
              travelMode: 'DRIVING'
            }, function(response, status) {
              if (status === 'OK') {
                directionsDisplay.setDirections(response);
              } else {
                window.alert('Directions request failed due to ' + status);
              }
            });
           
          }
        
         
        
        





