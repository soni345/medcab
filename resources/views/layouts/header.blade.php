
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