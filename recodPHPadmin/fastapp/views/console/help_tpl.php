<?php 
//pr($help_data);
foreach ($help_data as $key => $value) {
  $h_data[$value['help_type']][]=$value;
}
//pr($h_data);
foreach ($h_data as $key=>$val) {
   //pr($val[0]['help_type']);  
  if(array_search($val[0]['help_type'],$module)){
      
  ?>
   <div class="index-wrapper">

    <div class="widget-area row-fluid">

        <div class="box span12">
            <div class="box-header wall" data-original-title="">
                <h2><i class="icon-bell"></i><?=$val[0]['help_type']?> Overview</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="accordion">
                    <?php foreach ($val as $values) {?>
                         <h2 style=" font-size: 14px; font-weight: bold;"><?=$values['help_title']?></h2>
                    <div>
                        <ul class="thumbnails gallery">
                            <li id="image-1" class="thumbnail box span12">
                                <a style="background:url(/uploads/<?=$values['link']?>); background-size: 100%;" href="/uploads/<?=$values['link']?>" class="zoom-in xz"></a>
                            </li>
                          
                       
                        </ul>
                    </div>
                    
                    <?php }?>
                   
                  
                </div>
            </div>
        </div><!--/span-->

    </div>


</div>
<?php }}
if(array_search($val[0]['help_type'],$module)){ /* ?>
<div class="index-wrapper">

    <div class="widget-area row-fluid">

        <div class="box span12">
            <div class="box-header well" data-original-title="">
                <h2><i class="icon-bell"></i>Cable Overview</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div id="accordion">
                    <h2 style=" font-size: 14px; font-weight: bold;">HOW CAN I CHANGE MY SHIPPING ADDRESS?</h2>
                    <div>
                        <ul class="thumbnails gallery">
                            <li id="image-1" class="thumbnail box span12">
                                <a style="background:url(/uploads/channels.gif)" title="Sample Image 1" href="/uploads/channels.gif" class="cboxElement"><img class="grayscale" src="/uploads/channels.gif" alt="" style="display: block;"></a>
                            </li>
                          
                       
                        </ul>
                    </div>
                    <h2 style=" font-size: 14px; font-weight: bold;">HOW DO I ACTIVATE MY ACCOUNT?</h2>
                    <div>
                        <p>
                            Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet
                            purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor
                            velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In
                            suscipit faucibus urna.
                        </p>
                    </div>
                    <h2 style=" font-size: 14px; font-weight: bold;">WHAT DO YOU MEAN BY POINTS? HOW DO I EARN IT?</h2>
                    <div>
                        <p>
                            Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis.
                            Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero
                            ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis
                            lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.
                        </p>
                        <ul>
                            <li>List item one</li>
                            <li>List item two</li>
                            <li>List item three</li>
                        </ul>
                    </div>
                    <h2 style=" font-size: 14px; font-weight: bold;">HOW CAN I USE MY REMAINING ACCOUNT CREDITS?</h2>
                    <div>
                        <p>
                            Cras dictum. Pellentesque habitant morbi tristique senectus et netus
                            et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in
                            faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lacinia
                            mauris vel est.
                        </p>
                        <p>
                            Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus.
                            Class aptent taciti sociosqu ad litora torquent per conubia nostra, per
                            inceptos himenaeos.
                        </p>
                    </div>
                </div>
            </div>
        </div><!--/span-->

    </div>


</div>
<?php }if(array_search('internet',$module)){  ?>
<div class="index-wrapper">

    <div class="widget-area row-fluid">

        <div class="box span12">
            <div class="box-header well" data-original-title="">
                <h2><i class="icon-bell"></i>Internet Overview</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div id="accordion_2">
                    <h2 style=" font-size: 14px; font-weight: bold;">HOW CAN I CHANGE MY SHIPPING ADDRESS?</h2>
                    <div>
                        <ul class="thumbnails gallery">
                            <li id="image-1" class="thumbnail box span12">
                                <a style="background:url(/uploads/channels.gif)" title="Sample Image 1" href="/uploads/channels.gif" class="cboxElement"><img class="grayscale" src="/uploads/channels.gif" alt="" style="display: block;"></a>
                            </li>
                          
                       
                        </ul>
                    </div>
                    <h2 style=" font-size: 14px; font-weight: bold;">HOW DO I ACTIVATE MY ACCOUNT?</h2>
                    <div>
                        <p>
                            Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet
                            purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor
                            velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In
                            suscipit faucibus urna.
                        </p>
                    </div>
                    <h2 style=" font-size: 14px; font-weight: bold;">WHAT DO YOU MEAN BY POINTS? HOW DO I EARN IT?</h2>
                    <div>
                        <p>
                            Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis.
                            Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero
                            ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis
                            lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.
                        </p>
                        <ul>
                            <li>List item one</li>
                            <li>List item two</li>
                            <li>List item three</li>
                        </ul>
                    </div>
                    <h2 style=" font-size: 14px; font-weight: bold;">HOW CAN I USE MY REMAINING ACCOUNT CREDITS?</h2>
                    <div>
                        <p>
                            Cras dictum. Pellentesque habitant morbi tristique senectus et netus
                            et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in
                            faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lacinia
                            mauris vel est.
                        </p>
                        <p>
                            Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus.
                            Class aptent taciti sociosqu ad litora torquent per conubia nostra, per
                            inceptos himenaeos.
                        </p>
                    </div>
                </div>
            </div>
        </div><!--/span-->

    </div>


</div>
<?php } if(array_search('complain',$module)){  ?>
<div class="index-wrapper">

    <div class="widget-area row-fluid">

        <div class="box span12">
            <div class="box-header well" data-original-title="">
                <h2><i class="icon-bell"></i>Complain</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div id="accordion_3">
                    <h2 style=" font-size: 14px; font-weight: bold;">HOW CAN I CHANGE MY SHIPPING ADDRESS?</h2>
                    <div>
                     <p>
                            Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet
                            purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor
                            velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In
                            suscipit faucibus urna.
                        </p>
                    </div>
                    <h2 style=" font-size: 14px; font-weight: bold;">HOW DO I ACTIVATE MY ACCOUNT?</h2>
                    <div>
                        <p>
                            Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet
                            purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor
                            velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In
                            suscipit faucibus urna.
                        </p>
                    </div>
                    <h2 style=" font-size: 14px; font-weight: bold;">WHAT DO YOU MEAN BY POINTS? HOW DO I EARN IT?</h2>
                    <div>
                        <p>
                            Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis.
                            Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero
                            ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis
                            lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.
                        </p>

                    </div>
                    <h2 style=" font-size: 14px; font-weight: bold;">HOW CAN I USE MY REMAINING ACCOUNT CREDITS?</h2>
                    <div>
                        <p>
                            Cras dictum. Pellentesque habitant morbi tristique senectus et netus
                            et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in
                            faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lacinia
                            mauris vel est.
                        </p>
                     
                    </div>
                </div>
            </div>
        </div><!--/span-->

    </div>


</div>
<?php */} ?>
<script>
    $(function () {
        $(".accordion").accordion();
       // $("#accordion_2").accordion();
       // $("#accordion_3").accordion();
    });
</script>
<style>
    .ui-accordion .ui-accordion-header .ui-icon{ display: none;}
    .ui-accordion .ui-accordion-header { height: 20px; padding: 10px; cursor: pointer; position: relative;margin-top: 1px; zoom: 1;}
    .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active{ background: lightgray;}
    h2{font-size: 14px;font-weight: bold;}
    .thumbnail img, .thumbnail > a{ width: 1182px; height: 500px; }
   .well{ display: none!important;}
    .zoom-in {cursor: zoom-in;}
    .wall{height: 20px; padding: 10px;}

</style>