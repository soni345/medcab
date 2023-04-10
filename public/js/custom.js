function reloadCss()
{
    var links = document.getElementsByTagName("link");
    for (var cl in links)
    {
        var link = links[cl];
        if (link.rel === "stylesheet")
            link.href += "";
    }
}
(function ($) {
	
	// "use strict"
	$(window).scroll(function() {
	var scroll = $(window).scrollTop();
	var box = $('#top').height();
	var header = $('header').height();

	if (scroll >= box - header) {
	$("header").addClass("background-header");
	} else {
	$("header").removeClass("background-header");
	}
	});
	
	// $(function () {
	// 	$('#txtDate').datepicker({
	// 		format: "dd/mm/yyyy"
	// 	});
	// });
	// Window Resize Mobile Menu Fix
	mobileNav();
	// Scroll animation init
	// window.sr = new scrollReveal();
	// Menu Dropdown Toggle
	if($('.menu-trigger').length){
		$(".menu-trigger").on('click', function() {	
			$(this).toggleClass('active');
			$('.header-area .nav').slideToggle(200);
		});
	}


	// Menu elevator animation
	$('.scroll-to-section a[href*=\\#]:not([href=\\#])').on('click', function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				var width = $(window).width();
				if(width < 991) {
					$('.menu-trigger').removeClass('active');
					$('.header-area .nav').slideUp(200);	
				}				
				$('html,body').animate({
					scrollTop: (target.offset().top) - 80
				}, 700);
				return false;
			}
		}
	});

	$(document).ready(function () {
	    $(document).on("scroll", onScroll);
	    //smoothscroll
	    $('.scroll-to-section a[href^="#"]').on('click', function (e) {
	    e.preventDefault();
	    $(document).off("scroll");
	    $('.scroll-to-section a').each(function () {
	    $(this).removeClass('active');
	    })
	    $(this).addClass('active');
		var target = this.hash,
	    menu = target;
	    var target = $(this.hash);
	    $('html, body').stop().animate({
            scrollTop: (target.offset().top) - 79
	        }, 500, 'swing', function () {
	        window.location.hash = target;
	        $(document).on("scroll", onScroll);
	        });
	    });
	});

	function onScroll(event){
	    var scrollPos = $(document).scrollTop();
	    $('.nav a').each(function () {
	        var currLink = $(this);
	        var refElement = jQuery(currLink.attr("href"));
			// alert(refElement.position());
	        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
	            $('.nav ul li a').removeClass("active");
	            currLink.addClass("active");
	        }
	        else{
	            currLink.removeClass("active");
	        }
	    });
	}


	// Page loading animation
	$(window).on('load', function() {
		if($('.cover').length){
			$('.cover').parallax({
				imageSrc: $('.cover').data('image'),
				zIndex: '1'
			});
		}

		$("#preloader").animate({
			'opacity': '0'
		}, 600, function(){
			setTimeout(function(){
				$("#preloader").css("visibility", "hidden").fadeOut();
			}, 300);
		});
	});


	// Window Resize Mobile Menu Fix
	$(window).on('resize', function() {
		mobileNav();
	});


	// Window Resize Mobile Menu Fix
	function mobileNav() {
		var width = $(window).width();
		$('.submenu').on('click', function() {
			if(width < 1200) {
				$('.submenu ul').removeClass('active');
				$(this).children('ul').toggleClass('active');
        $('.submenu ul').toggle();
			}
		});
	}

})(window.jQuery);



$(document).ready(function(){
	$('.modal').modal({
		backdrop: 'static',
		keyboard: false
	},'show');
	$('#schedule').hide();
	
	$("#datepicker").on("change", function() {
		this.setAttribute(
			"data-date",
			moment(this.value, "YYYY-MM-DD")
			.format( this.getAttribute("data-date-format") )
		)
	}).trigger("change");

		
if ($('#book-now').is(':checked')) { 
		$('#schedule').show();
		let current = new Date();
		let dateTime=current.toLocaleString('en-US',{
			weekday: 'short', // long, short, narrow
			day: 'numeric', // numeric, 2-digit
			year: 'numeric', // numeric, 2-digit
			month: 'long', // numeric, 2-digit, long, short, narrow
			hour: 'numeric', // numeric, 2-digit
			minute: 'numeric', // numeric, 2-digit
			second: 'numeric', // numeric, 2-digit
		});
		var dt=current.toLocaleString('hi-IN');
		$('#txtDate').val(dt);
		$('#txtDate').attr("title",dateTime);   	
} 

	  //confirm scheduling
	$('#confirm-btn').click(function(){
        date=$('#datepicker').val();
        time=$('#timepicker').val();
        if(date!="" && time!="" ){
			var newdate=moment(date, "YY/MM/DD").format("DD/MM/YY");
			$('#confirm-btn').prop('disabled', true);
            $('#txtDate').val(date+" | "+time);
			$('#txtDate').attr("title",  $('#txtDate').val());
			$('#ModalCenter').modal('hide');
			console.log(date+" "+time);
        }
		
		else{
			alert("Please select date and time!");
			$('#confirm-btn').prop('disabled', false);
		}
    });



$('#schedule-now').click(function() { 
		// alert("schedule-now");
        if ($(this).is(':checked')) { 
		$('#schedule').show();
    return confirm("Do you want to schedule ?"); 
    } 
});
});

function onlyNumberKey(evt) {
	// Only ASCII character in that range allowed
	var ASCIICode = (evt.which) ? evt.which : evt.keyCode
	if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
		return false;
	return true;
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
	calculateAndDisplayRoutes(directionsService, directionsDisplay,origin,destination);
}

function calculateAndDisplayRoutes(directionsService, directionsDisplay,origin,destination) {           
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


//map creator
  //create map
  function createMapFun(latitude,longitude,id){
	var pyrmont = new google.maps.LatLng(latitude,longitude); // sample location to start with: Mumbai, India
	mapp = new google.maps.Map(document.getElementById(id), {
	center: pyrmont,//latlng
	zoom: 15
	});

	createMarkerFun(pyrmont);
}


//create map marker
function createMarkerFun(latLng,icn=""){
	var marker = new google.maps.Marker({
		map: mapp,
		position:latLng,
		icon:icn,
		title:"Driver",
		
	});
}




