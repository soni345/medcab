
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AOA:Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap" rel="stylesheet">

    <style>
        *{
            font-family: 'Nunito Sans', sans-serif;
        }
        .container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .registration{
            display:flex;
            flex-direction: column;        
            width:400px;
            max-width:400px;
            max-height:80vh;
            height:80vh;
            border-radius:4px;
            padding-top:20px;
            border:1px solid gray;
            border-radius:4px;
            border-top:8px solid #c5354f;
            
        }
        .registration-form{
            border-bottom:40px;
            display: contents;
        }
        #reg_form{
            display:contents;
          
        }
        .form-inputs{
            padding :0 20px;
        }
        .submit-div{
            padding:20px;
        }
       .form-inputs{
        overflow:scroll;
       }
        .registraion-heading{
            font-weight:bold;
            text-align:center;
            margin-bottom: 30px;
            font-size:30px;
            color:#101010;
        }
        .form-control{
            height: 38px;
            border: 1px solid rgb(198, 197, 197);
            border-radius: 0;
        }
        .select-img{
            position: relative;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .id-proof{
            display:flex;
            gap:15px;
        }
        .id-proof-item{
            display:flex;
            flex-direction:row;
            justify-content:start;
            align-items:center;
            gap:5px;
        }

        
        /* On mouse-over, add a grey background color */
        input[type="checkbox"]:hover{
        background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        input[type="checkbox"]:checked{
        background-color: #c5354f;
        }
        .form-label{
            font-size: 16px!important;
            font-weight: 600;
            line-height: 25px;
            letter-spacing: 0em;
            text-align: left;
            color: #40444F 
        }
        .form-in-label{
            font-size: 14px!important;
            font-weight: 400;
            line-height: 25px;
            letter-spacing: 0em;
            text-align: left;
            color: #40444F 
        }
        .confirm-number{
            display:flex;
            justify-content:start;
            align-items:center;
            gap:3px;
        }
        .confirm-number>label{
            font-size:12px!important;
            font-weight:400;
            color:gray;
        }
        #citylist{
            height:100%;
            width: 100%;
            position:absolute;
            top:100%;
            left:0;
            z-index: 111;
        }
        #submit-btn{
            height: 38px;
            width: 100%;
            border: none;
            color: white;
            font-weight: 500;
            background-color: #c5354f;
        }
        /* Hide scrollbar for Chrome, Safari and Opera */
            .form-inputs::-webkit-scrollbar {
            display: none;
            }

            /* Hide scrollbar for IE, Edge and Firefox */
            .form-inputs {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
            }
            #getfile::file-selector-button {
            display: none;
            }
            input,select,option{
                font-size:14px !important;
            }
            .select-img-btn{
                margin-left: 10px;
                color:gray;
                font-size:14px;
                display:none;
            }
            ::placeholder{
                font-size:14px;
            }
            input[type=file]{
                width:100%;
            }
            #spnPhoneStatus{
                color: #c5c5c5;
                font-size:12px;
            }
    </style>
</head>
<body>  
    <div class="container">
        <div class="registration">
            <h1 class="registraion-heading">AOA Registration Form</h1>
            <div class="registration-form">
                <form action="registrationCode.php" method="post" id="reg_form" enctype="multipart/form-data">
                    <div class="form-inputs">
                        <div class="mb-3 form-group">
                        <label  class="form-label">Mobile No.</label>
                        <input type="text" name="mobile" class="form-control" id="mobile-number" placeholder="xxxxxxxxxx" maxlength="10" required>
                        <span id="spnPhoneStatus"></span>
                    </div>
                    <div class="mb-3 form-group">
                        <label  class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="
                        " placeholder="Your Name" required>
                    </div>
                    <div class="mb-3 form-group">
                        <label  class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="
                        " placeholder="Your Email Address" required>
                    </div>
                    <div class=" mb-3 form-group confirm-number">
                        <input type="checkbox" id="check-number">
                        <label  class="form-in-label">Is your mobile number and WhatsApp Number same?</label>
                    </div>
                    <div class="mb-3 form-group ">
                        <label  class="form-label">WhatsApp Number</label>
                        <input type="text" name="w-number" class="form-control" id="whatsapp-number" placeholder="xxxxxxxxxx"required>
                    </div>
                    <div class="mb-3 form-group">
                        <label  class="form-label">Ambulance Type</label>
                        <?php 
                        include "db_connection.php";
                        $res1=mysqli_query($db_ambu,"select ambulance_category_name from ambulance_category");
                        ?>
                        <select class="form-select" name="ambu-type" aria-label="Default select example" required>
                        <option disabled selected>Select Ambulance Type</option>
                        <?php
                            if(mysqli_num_rows($res1)>0){
                                while($r1=mysqli_fetch_assoc($res1)){
                                    ?>
                                    <option value="<?php echo $r1['ambulance_category_name'];?>"><?php echo $r1['ambulance_category_name'];?></option>
                                <?php    
                                }
                                    echo "something went wrong";
                                }
                        ?>
                        </select>
                    </div>   
                    <div class="mb-3 form-group "  >
                        <label  class="form-label">Vehicle RC Image </label>
                        <div class="select-img">
                        <input type="file" name="rc-img" class="form-control getfile" 
                        required>
                        </div>
                    </div>
                    <div class="mb-3 form-group">
                        <label  class="form-label">Vehicle RC Number </label>
                        <input type="text"  name="rc-number" class="form-control" id="
                        "  placeholder="Vehicle RC Number" required>
                    </div>
                    <div class="mb-3 form-group DL "  >
                        <label  class="form-label">DL Image(Optional)</label>
                        <div class="select-img">
                        <input type="file" name="DL-img"  class="form-control getfile" 
                         >

                        </div>
                    </div>
                    <div class="mb-3 form-group DL ">
                        <label  class="form-label">DL Number(Optional) </label>
                        <input type="text" name="DL-number"  class="form-control " id="
                        " placeholder="DL Number" required>
                    </div>
                   
                 
                    <div class="mb-3 form-group vehicle "  >
                        <label  class="form-label">Vehicle Front Image(Optional)</label>
                        <div class="select-img">
                        <input type="file" name="vehicle-front-img"  class="form-control getfile" 
                         >

                        </div>
                    </div>
                    <div class="mb-3 form-group vehicle "  >
                        <label  class="form-label">Vehicle Back Image(Optional)</label>
                        <div class="select-img">
                        <input type="file" name="vehicle-back-img"  class="form-control getfile" 
                         >

                        </div>
                    </div>
                    <div class="mb-3 form-group ">
                        <label  class="form-label">Referral Code(Optional)</label>
                        <input type="text" maxlength="6" name="referral-code" class="form-control" id="referral-code" placeholder="eg. AOA0012" required>
                    </div>
                    
                    <div class="mb-3 form-group">
                        <label  class="form-label">Id Proof</label>
                        <div class="id-proof">
                  
                    <div class="id-proof-item">  
                            <input type="checkbox" name="aadhar-id" value="Adhar" id="aadhar" class="checkmark" >
                            <label  class="form-in-label">Adhar Card</label>
                    </div>  

                    <div class="id-proof-item">  
                            <input type="checkbox" name="voter-id" value="voter"  id="voter" class="checkmark" >
                            <label  class="form-in-label">voter Card</label>
                    </div>
                        <div class="id-proof-item"> 
                            <input type="checkbox"  name="PAN-id" value="PAN" id="PAN" class="checkmark" >
                            <label  class="form-in-label">PAN Card</label> 
                        </div>
      
                        </div>
                    </div>
                   
                    <div class="mb-3 form-group aadhar id-input"  >
                        <label  class="form-label">Adhar Card Photo(Front) </label>
                        <div class="select-img">
                        <input type="file" name="aadhar-front-img" class="form-control getfile " 
                         >
                        <!-- <span class="select-img-btn">Choose File</span> -->
                        </div>
                    </div>
                    <div class="mb-3 form-group aadhar id-input"  >
                        <label  class="form-label">Adhar Card Photo(Back) </label>
                        <div class="select-img">
                        <input type="file" name="aadhar-back-img"  class="form-control getfile " 
                         >
                        <!-- <span class="select-img-btn">Choose File</span> -->
                        </div>
                    </div>
                    <div class="mb-3 form-group aadhar id-input">
                        <label  class="form-label">Adhar Number </label>
                        <input type="text" maxlength="12" name="aadhar-number"  class="form-control " id="
                        " placeholder="Adhar Number" required>
                    </div>
                   
                    <div class="mb-3 form-group voter id-input"  >
                        <label  class="form-label">Voter Card Image</label>
                        <div class="select-img">
                        <input type="file" name="voter-img"  class="form-control getfile" 
                         >

                        </div>
                    </div>
                    <div class="mb-3 form-group voter id-input">
                        <label  class="form-label">Votar Card Number </label>
                        <input type="text" name="voter-number"  class="form-control" id="
                        " placeholder="Voter Card number">
                    </div>
                    <div class="mb-3 form-group PAN id-input"  >
                        <label  class="form-label">PAN Card Image</label>
                        <div class="select-img">
                        <input type="file" name="PAN-img"  class="form-control getfile" 
                         >
                        <!-- <span class="select-img-btn">Choose File</span> -->
                        </div>
                    </div>
                    <div class="mb-3 form-group PAN id-input">
                        <label  class="form-label">PAN Card Number </label>
                        <input type="text" maxlength="12" name="PAN-number" class="form-control" id="
                        " placeholder="PAN Card number">
                    </div>  
                    <div class="mb-3 form-group  ">
                        <label  class="form-label">Pincode </label>
                        <input type="text" maxlength="6" name="pincode" class="form-control" id="
                        " placeholder="Pincode" required>
                    </div>
                    <div class="mb-3 form-group position-relative">
                        <label  class="form-label">City</label>
                        <input type="text" name="city" class="form-control" id="city" placeholder="City" required>
                        <div id="citylist" class="position-absolute top-100">
                            
                        </div>
                       
                    </div> 
                    
                     
   
                </div>
                    <div class="submit-div">
                    <input type="submit" value="SUBMIT" id="submit-btn">
                    </div>
                </form>
            </div>
        </div>
    </div>
  
</body>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {

    // Reset form on load
    $('#reg_form')[0].reset();

    if(!$("#check-number").is(':checked') && $("#mobile-number").val()==""){
        $("#check-number").attr("disabled", true);
    }
  else{
    $("#check-number").attr("disabled", false);
  }
    $('#check-number').change(function() {
        if(this.checked) {
            var number=$("#mobile-number").val();
            var returnVal = confirm("Are you sure?"+number);  
            $('#whatsapp-number').val(number);
            console.log($('#whatsapp-number').val(number));
            // $(this).prop("checked", returnVal);
        }      
    });

    $("#mobile-number").change(function() {
        if($(this).val()!="") {
            $("#check-number").attr("disabled", false);
            if($('#check-number').is(':checked')){
                $('#whatsapp-number').val($(this).val());
            }
            }
          
        });

    $('#check-number').change(function(){
        if($('#check-number').is(':checked')==false){
            $('#whatsapp-number').val("");
        }
        if($('#check-number').is(':checked')==true){
            var number=$("#mobile-number").val();
            $('#whatsapp-number').val(number);
        }
    })
    

    $('#mobile-number').keypress(function(e) {
        if (validatePhone('mobile-number')) {
            alert("Valid Mobil Number");
            $('#spnPhoneStatus').html('Valid Mobil Number');
            $('#spnPhoneStatus').css('color', 'green');
        }
        else {
            // $('#spnPhoneStatus').html('Invalid Mobile Number');
            $('#spnPhoneStatus').css('color', 'red');
            if($('#mobile-number').val().length==10){
                $('#spnPhoneStatus').html("");
            }
            
        }

    
});
    function validatePhone(txtPhone){
    var a = document.getElementById(txtPhone).value;
    var filter = /[6-9]{1}[0-9]{9}/;
    if (filter.test(a) && a.length <= 10) {
        return true;
    }
        else {
            return false;
        }
    }
    $('.id-input').hide();
 
        if($('.checkmark').is(':checked')) {
            // alert("done");
            if($(this).attr("id")=="aadhar"){
                $(".aadhar").toggle();
            }
            if($(this).attr("id")=="voter"){
                $(".voter").toggle();
            }
            if($(this).attr("id")=="PAN"){
                $(".PAN").toggle();
            }
        }
    
    $('.checkmark').change(function() {
        if(this.checked) {
            if($(this).attr("id")=="aadhar"){
                $(".aadhar").toggle();
            }
            if($(this).attr("id")=="voter"){
                $(".voter").toggle();
            }
            if($(this).attr("id")=="PAN"){
                $(".PAN").toggle();
            }
        }
      
      

        
      
    });
 
    //number validation
    // var value = $("#mobile-number").val();
    // var NumberRegex = /^[0-9]*$/;
    // if(value.length <= 10){
    // if(NumberRegex.test(value)){
    // //do whatever you want to
    // }else{
    // alert('invalid')
    // }

    $("#city").keyup(function(e){
        var city=$(this).val();
        if(city!=""){
            e.preventDefault(); 
            $.ajax({
            url: 'search_city.php', 
            type: 'POST',
            data: {city:city},
            success: function(response){
                $('#citylist').html(response);
                $("#citylist").fadeIn();
            }  
            });
        }
        else{
                $('#citylist').html("");
                $("#citylist").fadeOut();
            }
    });
    $(document).on('click','li',function(){
        $('#city').val($(this).text());
        $("#citylist").fadeOut();
    });

    $("#mobile-number").change(function(e){
        var mobile=$(this).val();
        if(mobile!=""){
            e.preventDefault(); 
                    $.ajax({
                    url: 'search_city.php', 
                    type: 'POST',
                    data: {mobile:mobile},
                    success: function(data){
                        var db = JSON.stringify(data);
                        var data_r = JSON.parse(db);
                        console.log(data_r);
                        
                        $('#spnPhoneStatus').html("");
                        if(data=='1'){
                            $('#spnPhoneStatus').html("already Exists");
                        $("#spnPhoneStatus").css('color','red');
                        }
                    }       
                });
            }
        });

        $('forms').submit(function(event){
            alert("form submission");
            event.preventDefault(); 
            var formdtat = new FormData("#reg_form");
            console.log(formdtat);
            $.ajax({
                    url: 'registrationCode.php',
                    type: 'POST',
                    data: formdtat,
                    contentType: false,
                    cache: false,
                    processData:false,  
                    success: function(response){
                        $('#reg_form')[0].reset();
                        var d = JSON.parse(response)
                        if(d.status==1){
                            alert(d.message);
                        }
                        else{
                            alert(d.message);
                        }
                        console.log(response);
                    }
                });
        });
}); 

</script>
</html>
