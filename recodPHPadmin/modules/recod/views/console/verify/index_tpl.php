 <?php //pr($result);?>
<!DOCTYPE HTML>  
<html>
<head>
<meta content="width=device-width,initial-scale=1" name=viewport>
<style>
    body{
        text-align: center;
    }
    .idcardx{
        height: fit-content;
    display: inline-grid;
    }
    .idcardx .cardshadow{
    width: 332px;
    clear: both;
    height: 100%;
    margin: 30px auto;
    border-radius: 28px;
    -webkit-box-shadow: -1px -4px 33px -2px rgba(0,0,0,0.75);
    -moz-box-shadow: -1px -4px 33px -2px rgba(0,0,0,0.75);
    box-shadow: -1px -4px 33px -2px rgba(0,0,0,0.75);
    }
    .idcardx .cardheader{
    color: #d80000;
        font-size: 38px;
        text-align: CENTER;
        font-family: serif;
        line-height: 90px;
    }
    .idcardx .carddesignation{
    background-color: #cccccc;
    font-size: 22px;
    text-align: center;
    margin-top: -60px;
    }
    .idcardx .authority{
    background-color: #D80000;
    font-size: 14px;
    text-align: center;
    margin-top: -215px;
    color: white;
    font-weight: bold;
    font-family: sans-serif;
    }
    .idcardx .cardmiddle{
        height: 280px;
    }
    .idcardx .bg-image{
        background-image: url(https://www.rkproduction.co.in/html/img/Captures4.PNG);
    background-position: center;
    background-size: contain;
    background-repeat: no-repeat;
    height: 71px;
    width: 100%;
    z-index: -1;
    margin-top: 11px;
    
    }
    .idcardx .cardimage{
    background-image:url('https://www.rkproduction.co.in/html/img/loading.gif');
    height: 210px;
    margin: 12px auto 6px;
    background-position: center;
    width: 160px;
    background-size: contain;
    background-repeat: no-repeat;
    
    }
    .idcardx .cardstamp{
    height: 100px;
    transform: rotate(332deg);
    position: relative;
    width: 100px;
    text-align: center;
    background-image: url('https://www.rkproduction.co.in/html/img/stamp.png');
    background-position: center;
    background-size: contain;
    left: 200px;
    top: -150px;
    }
    .idcardx .cardsign{
    height: 100px;
    transform: rotate(360deg);
    position: relative;
    width: 100px;
    text-align: center;
    background-image: url('https://www.rkproduction.co.in/html/img/sign.png');
    background-position: center;
    background-size: contain;
    left: 200px;
    top: -240px;
    }
    .idcardx .cardinfo{
    text-align: center;
    }
    .idcardx .generalData h3{
    margin: 0;
        font-size: 13px;
    }.idcardx .generalData {
    margin-left: 17px;
    margin-top: 8px;
    float: left;
        text-align: left;
    }
    .idcardx .cardqr{
    background-image:url('https://www.rkproduction.co.in/html/img/loading.gif');
    height: 90px;
    width: 90px;
    float: left;
    margin-left: 9px;
    background-size: cover;
    background-position: center;
    }
</style>
</head>
<body>  

<div class="idcardx">
      <div class="cardshadow">
          <div class="cardheader">
              <h1>PRESS</h1>
          </div>
          <div class="carddesignation"> <?php print_r($result['role_name']);?></div>
      <div>
        <div class="bg-image"></div>
        <div class="cardmiddle">
            <div class="cardimage" style="background-image: url(&quot;https://www.rkproduction.co.in/uploads/rkproduction/users/<?php print_r($result['user_img']);?>&quot;);">
            </div>
            <div class="cardinfo">
               <h2 id="crdusername"> <?php print_r($result['user_name']);?></h2>   
            </div>
            <div class="cardstamp">
            </div>
            <div class="cardsign">
            </div>
            
            <div class="authority">RKAR MULTIPURPOSE BUSINESS PVT LTD</div>
            <div class="generalData">
                <h3>Membership from: <span id="member_start"> <?php print_r($result['membership_date']);?></span> </h3>
                <h3>Membership expires: <span id="member_end"><?php print_r($result['membership_end_date']);?></span></h3>
                
                <h3>Blood Group: <span id="member_blood"><?php print_r($result['user_blood_group']);?></span></h3>
                <h3>Gender: <span id="member_gender"><?php print_r($result['user_gender']);?></span></h3>
                <h3>Mobile No: <span id="member_gender"><?php print_r($result['user_contact_no']);?></span></h3>
                <h3>Address: <span id="member_gender"><?php print_r($result['user_address']);?></span></h3>
                <h3>Pincode: <span id="member_gender"><?php print_r($result['user_pincode']);?></span></h3>

            </div>
            
        </div>
      </div>
      </div>
    </div>

</body>
<script>

$(function(){
    $("#notification_form").submit(function(){
        dataString = $("#notification_form").serialize();
        currentPostRequest = $.ajax({
            type: "POST",
            url: "https://www.rkproduction.co.in/console/notifications",
            data: dataString,
            success: function(data){
                data = JSON.parse(data);
                // console.log(data);

                if(data.status=="success"){
                    alert(data.message)
                    location.reload(true);
                }
                // $("#result").html('Successfully updated record!'); 
                // $("#result").addClass("alert alert-success");
            }

        });

        return false;

    });
});
</script>
</html>
