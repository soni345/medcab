<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
       <!-- Latest compiled and minified CSS -->
       <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"  referrerpolicy="no-referrer" />
    <link
      href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


        <!-- ✅ load jQuery ✅ -->
     
        <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

    <!-- ✅ load jquery UI ✅ -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
      integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>

    <!-- Latest compiled JavaScript -->

    <link rel="stylesheet" href="css/custom.css">

    <style>
        
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">
                            <img src="assets/image/logo.png" style="#">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <?php if(Session::has('consumer_name')){?>
                            <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#men">Bookings</a></li>
                            <li class="scroll-to-section"><a href="#women">Wallet</a></li>
                            
                            
                            <li class="scroll-to-section btn download-btn " style="color:#a1a1a1;"><a href="#explore">Download App</a></li>
                            <li class="scroll-to-section d-flex justify-content-start align-items-center"><a href="#kids">
                               <?php
                                    $name=Session()->get('consumer_name');
                                    $words = explode(" ", trim($name));
                                    $initials = null;
                                    foreach ($words as $w) {
                                        if($w==$words[0] || $words[sizeof($words)-1]==$w){
                                            $initials .= $w[0];
                                        }
                                    }?>
                                    <span style="padding:10px;background-color:white;border-radius:50%;color:black;"> 
                                   <?php echo strtoupper($initials);
                                  ?>
                                  </span>
                                  </a>
                            <a href="{{route('logout_page')}}" class="d-flex justify-content-start gap-3 align-items-center"><i class="fa-solid fa-power-off  p-3 fa-2x"></i></a>
                            
                               
                            
                            
                            </li>
                            </ul>  
                        <?php }
                            else{?>
                                <ul class="nav">
                                <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                                <li class="scroll-to-section"><a href="#men">Ambulances</a></li>
                                <li class="scroll-to-section"><a href="#women">Hospitals</a></li>
                                <li class="scroll-to-section"><a href="#kids">Join us</a></li>
                                <li class="scroll-to-section"><a href="#kids">Blog</a></li>
                                <li class="scroll-to-section"><a href="#kids">Contact  us</a></li>
                                <li class="submenu" style="background-color:inherite;">
                                    <a href="javascript:;">Gallery</a>
                                    <ul>
                                        <li><a href="about.html">About Us</a></li>
                                        <li><a href="products.html">Products</a></li>
                                        <li><a href="single-product.html">Single Product</a></li>
                                        <li><a href="contact.html">Contact Us</a></li>
                                    </ul>
                                </li>
                              
                                <li class="scroll-to-section btn download-btn " style="color:#a1a1a1;"><a href="#explore">Download App</a></li>
                            </ul> 
                         <?php   }
                        ?>
                              
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

<!-- Main Section -->
    @yield('main');


  <!-- End of main section -->



  <!-- Footer Area -->
  <footer>
    <div class="footer-container pt-4 pb-4">
        <div class="container">
                <div class="footer-main d-flex justify-content-space-between mb-3">
                    <img src="assets/image/logo.png" alt="#" class="logo">
                    <button class="footer-download-btn">Download MedCab App</button>
                </div>
                <div class="row footer-menu justify-content-space-between gy-3">
                        <div class="col-md-2 col-6">
                            <div class="footer-item w-100">
                                <h4 class="links-heading">Quick Links</h4>
                                <ul>
                                    <li><a href="#">Contact Us</a></li>
                                    <li><a href="#">Join Us</a></li>
                                    <li><a href="#">Blogs</a></li>
                                    <li><a href="#">Gallery</a></li>
                                </ul>
                            </div>

                        </div>
                        <div class="col-md-2 col-6">
                            <div class="footer-item">
                            <h4 class="links-heading">Info.</h4>
                                <ul>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Refund Policy</a></li>
                                    <li><a href="#">Cancellation Policy</a></li>
                                    <li><a href="#">Guidelines</a></li>
                                    <li><a href="#">Terms & Conditions</a></li>
                                </ul>
                            </div>

                        </div>
                        <div class="col-md-8 col-sm-12">
                            <div class="footer-item">
                                <h4 class="links-heading">locations</h4>
                                <div class="row location gy-2 p-2 pl-3s">
                                    <div class="col-4">
                                    <ul class="location-links">
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                     </ul>
                                    </div>

                                    <div class="col-4">
                                    <ul class="location-links">
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                     </ul>
                                    </div>

                                    <div class="col-4">
                                    <ul class="location-links">
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                        <li><a href="#">Ambulances in Mumbai</a></li>
                                     </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                </div>
                <hr style="border-color:white;"/>
                <div class=" row footer-details justify-content-start d-flex gx-3 gy-1">
                    <div class="col-lg-3 col-md-4 col-sm-6 footer-address">
                        <span class="info-icon">
                        <i class="fa-solid fa-location-dot"></i>
                        </span>
                        <span><a href="https://goo.gl/maps/V4uLfjfpQ8hbGtqh9"> 2/141 Vishal Khand Gomti Nagar,<br/> Lucknow, Uttar Pradesh, 226010</a> </span>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6 footer-contact">
               
                        <span class="info-icon">
                        <i class="fa-solid fa-phone"></i>
                        </span>
                        <span><a href="tel: +91 8755672479">+91 8755672479</a></span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 footer-mail">
                        <span class="info-icon">
                        <i class="fa-solid fa-envelope"></i>

                        </span>
                        <span><a href="mailto: info@medcabprivatelimited.com">info@medcabprivatelimited.com</a></span>
                    </div>
                </div>


        </div>
    </div>
</footer>
  <!-- end footer area -->


    
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
 <script src="js/custom.js"></script>
 <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCx0Z4yauzBpfz1F6avmCDriDHhoMChbuw&libraries=places&callback=initMap" ></script>
 

</html>