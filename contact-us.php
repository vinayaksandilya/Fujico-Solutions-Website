<?php
	session_start();
	require_once("arrays.inc.php");
	//$admin_email="sanjays.weblink@gmail.com";
	// $admin_email="info@electrahomes.com";
	$admin_email="info@fujicosolutions.com";
	$admin_name="Admin"; 
	$website_name="Fujico Solutions"; 
    
    if(@$_POST['actions']=="Submit"){
    @extract($_POST);
    //$name,$email,$contact_number,$company_name,$subjects,$enquiryType,$description,$verification_code
	   
	    @$form_check_alert=dynamic_check_form_values(array("rp-2-Please enter your first name" => "".$_POST['first_name']."","rp-2-Please enter your last name" => "".$_POST['last_name']."", "rp--Please enter your mobile number" => "".$_POST['mobile_number']."", "rp-4-Please enter valid email id" => "".$_POST['email']."",  "rp--Please write your message!" => "".$_POST['message'].""), $validation_ans_arr);
		if($_POST['verification_code']=="") {
			$form_check_alert.="<li>Please enter word verification code.</li>";
		}elseif($_SESSION['verification_code'] != $_POST['verification_code']) {
			$form_check_alert.="<li>Verification Word Mismatch ... Please try again with correct verification word.</li>";
		}
		
		if(!strlen($form_check_alert)>0) 
		{
			
				
			//mail sent to customer
				$to_email=$_POST['email']; 
				$from_email=$admin_email;
				$fromName=$admin_name;
				$name=$_POST['first_name'].' '.$_POST['last_name'];
				
				$mess="Your Enquiry has been sent successully, we will get back to you very shortly.";
				
				$subject="Enquiry @ ".$website_name;
				$msg='Dear '.ucwords($name).',<br/><br/>'.$mess.'<br /><br />Regards<br /><br />Customer Support Team<br />'.$admin_name;
				$headers = "From: $fromName<$from_email> \n";
				$headers .= "Reply-To: $to_email\r\n";
				$headers .= "X-Mailer: PHP/". phpversion();
				$headers .= "X-Priority: 3 \n";
				$headers .= "MIME-version: 1.0\n";
				$headers .= "Content-Type: text/html; charset=UTF-8\n";
				//echo $to_email,$subject,$msg,$headers;
				@mail($to_email,$subject,$msg,$headers);
			//mail send to Admin
							
				$to_email="$admin_email";
				$from_email=$_POST['email'];
				$fromName=$name;
				$subject="Enquiry @ ".$website_name;
				$msg='Dear '.$admin_name.',<br/><br/>New Enquiry:-<br />';
				$msg.='Name : '.ucwords($name);
				$msg.='<br/>Mobile Number : '.$_POST['mobile_number'].'<br/>';
				if($_POST['phone_number']!=""){
					$msg.='<br/>Phone Number : '.$_POST['phone_number'].'<br/>';
				}
				$msg.='<br/>Email : '.$_POST['email'].'<br/>';
				$msg.='</br>Message : '.$_POST['message'].'<br />Regards<br /><br />Customer Support Team<br />'.$admin_name;
				$headers = "From: $fromName<$from_email> \n";
				$headers .= "Reply-To: $to_email \r\n";
				$headers .= "X-Mailer: PHP/". phpversion();
				$headers .= "X-Priority: 3 \n";
				$headers .= "MIME-version: 1.0\n";
				$headers .= "Content-Type: text/html; charset=UTF-8\n";
				//echo $to_email,$subject,$msg,$headers;
				@mail($to_email,$subject,$msg,$headers);
			// ---------
				header("Location:thankyou.htm");
				exit();
		}
	
		if($form_check_alert!="")
		{
			$msg=html_head();
			$msg.=$form_check_alert;
			$msg.=html_foot();
		}
		
	}else{
    
    $first_name='';
    $last_name='';
    $email='';
    $mobile_number='';
	$phone_number='';
    $message='';
    
    }?>
<!DOCTYPE htm>
<htm>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="keywords" content="">
<title>Fujico Solutions</title>
<link rel="shortcut icon" href="favicon.ico">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/layout-dsr.css" rel="stylesheet" type="text/css">
<link href="gs-carousel/gs.carousel.css" rel="stylesheet">
<link href="gs-carousel/gs.theme.css" rel="stylesheet">
<link rel="stylesheet" href="css/fluid_dg.css">
<script type="text/javascript">
function validate_contactus() {
	//$name,$email,$contact_number,$company_name,$subjects,$enquiryType,$description,$verification_code
	var frm=document.contactus;
	var namefilter=/^[a-zA-Z ]*$/;
    var emailfilter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	
	if (frm.first_name.value==0) {
		alert("Please enter your first name");
		frm.first_name.focus();
		return false;
	}
	if (!namefilter.test(frm.first_name.value)) {
    	 alert("Only letters and white space allowed");
    	 frm.first_name.focus();
     	 return false;
    }
	if (frm.last_name.value==0) {
		alert("Please enter your last name");
		frm.last_name.focus();
		return false;
	}
	if (!namefilter.test(frm.last_name.value)) {
    	 alert("Only letters and white space allowed");
    	 frm.last_name.focus();
     	 return false;
    }
	if (frm.mobile_number.value==0) {
		alert("Please enter mobile number");
		frm.mobile_number.focus();
		return false;
	}
    if (!emailfilter.test(frm.email.value)) {
		alert("Please enter valid email address");
		frm.email.focus();
		return false;
	}
	if (frm.message.value==0) {
		alert("Please write your message");
		frm.message.focus();
		return false;
	}
	if (frm.verification_code.value==0) {
		alert("Please enter verification code");
		frm.verification_code.focus();
		return false;
	}
	
	
}
</script>
</head>
<body class="con"><!-- #BeginLibraryItem "/Library/header_top.lbi" -->
<header>
    <div class="top-head">
        <div class="top-head1">
            <div class="container">
            	<div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                        <div class="nav-header">
                            <p class="call_icon"><img src="images/call_icon.png" alt="" class="mr8"><a href="tel:+971551465555">+971551465555</a></p>
                            <p class="message_icon"><img src="images/message_icon.png" alt="" class="mr8"><a href="mailto:info@fujicosolutions.com" title="info@fujicosolutions.com">info@fujicosolutions.com</a></p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-6 col-lg-6">
                        <div class="social">
                            <ul class="social-links">
                                <li><a href="javascript:void(0)" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="javascript:void(0)" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="javascript:void(0)" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="javascript:void(0)" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="javascript:void(0)" target="_blank"><i class="fa fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
            	</div>
            </div>
        </div>
        <p class="clearfix"></p>
        <div class="container">
            <div class="row">
            	<div class="col-xs-12 col-sm-3 col-md-2 col-lg-2">
                	<div class="logo"><a href="index.htm"><img src="images/logo.png" class="img-responsive"/></a></div>
                </div>
                <div class="col-xs-12 col-sm-9 col-md-10 col-lg-10">
                    <nav>
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"><span class="visible-xs">Navigation</span></button>
                        </div>
						<div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <li><a href="index.htm" title="Home" id="hom">Home</a></li>
                                <li><a href="about-us.htm" title="About Us" id="abo">About Us</a></li>
                                <li class="dropdown"><a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" title="Services" id="ser">Services<span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="air-conditioning-installation.htm" title="Air conditioning installation">Air conditioning installation</a></li>
                                        <li><a href="air-conditioning-service.htm" title="Air conditioning Service">Air conditioning Service</a></li>
                                        <li><a href="electrical-solutions-consultancy.htm" title="Electrical solutions & Consultancy">Electrical solutions &amp; Consultancy</a></li>
                                    </ul>
                                </li>
                                <li><a href="contact-us.htm" title="Contact Us" id="con">Contact Us</a></li>
                            </ul>
                        </div>
                    </nav>
                	<p class="clearfix"></p>
                </div>
            </div>
        	<p class="clearfix"></p>
        </div>
    </div>
</header><!-- #EndLibraryItem --><div class="clearfix"></div>
<!---------banner-start----------><div class="rel">
 <img src="images/contact_us_banner.jpg" class="img-responsive center-block w100" alt="">
  <div class="clearfix"></div>
</div><div class="clearfix"></div>
<div class="breadcrumb_outer hidden-xs">
  <div class="container">
  	<div class="row">
    <ul class="breadcrumb">
      <li class="pl5"><a href="index.htm">Home</a></li>
      <li class="active">Contact Us</li>
    </ul>
  </div>
  </div>
</div>
<div class="clearfix"></div>
<!---------start---------->
<div class="container">
    <div class="row pb40">
    	<div class="heading_sub animated drop_eff">
    	<h1>Contact Us</h1>
    	<p class="clearfix"></p></div>
        <div class="col-xs-12 col-md-6 animated drop_eff3">
            <div class="fs20 blue">Have a Query?</div>
            <div class="contact_form_cont">
                <form name="contactus" id="contactus" method="post" action="" onsubmit="return validate_contactus();">
                <p class="fs16 mt5">Just Fill the Below Information:</p>
                <div class="red ac b"><?php echo @$msg;?></div>
                <fieldset class="contact_form mt15" style="border:none;">
                    <div class="mt5">
                         <input type="text" id="first_name" name="first_name" value="<?php echo $first_name;?>" placeholder="First Name *">
                        <input type="text" id="last_name" name="last_name" value="<?php echo $last_name;?>" placeholder="Last Name *">
                    </div>
                    <div class="mt5">
                        <input type="text" id="mobile_number" name="mobile_number" value="<?php echo $mobile_number;?>" placeholder="Mobile No *">
                        <input type="text"  id="phone_number" name="phone_number" value="<?php echo $phone_number;?>" placeholder="Phone No ">
                    </div>
                    <div class="mt5">
                        <input type="text" class="large" id="email" name="email" value="<?php echo $email;?>" placeholder="Email Id *">
                    </div>
                    <div class="mt5">
                        <textarea name="message" class="large" id="message" cols="45" rows="4" placeholder="Message *"><?php echo $message;?></textarea>
                    </div>
                    <div class="mt5">
                        <input type="text" name="verification_code" id="verification_code" class="vam" style="width:140px;" placeholder="Enter Code *">
                        
                        <img src="CaptchaSecurityImages.php?width=77&height=21&characters=6" id="captcha" alt="" class="vam"> <a href="javascript:void(0);" onclick="document.getElementById('captcha').src='CaptchaSecurityImages.php?'+Math.random();"><img src="images/refresh.png" alt="" class="vam"></a> 
                      </div>
                    <div class="mt10">
                        <input id="actions" name="actions" type="submit" value="Submit" class="btn7" >
                        <input name="reset" type="reset" value="Reset" class="btn2 ml3">
                    </div>
                </fieldset>
                </form>
            </div>
        </div>
		<div class="visible-xs visible-sm bb mb40">&nbsp;</div>
        <div class="col-xs-12 col-md-6 animated drop_eff5">
            <div class="fs20 blue">Administration And Operations</div>
            <p class="gray fs16 mt5">Feel free to call us, we will be very happy to assist you.</p>
            <div class="row mt20">
                <div class="col-xs-12 col-sm-12">
                    <div class="call">
                        <p class="ttu weight600">Call Us:</p>
                        <p class="weight300 fs16 gray"><a href="tel:+971551465555">+971551465555</a> <b class="fs12 weight400 gray">Mobile</b></p>
                    </div>
                </div>
                <p class="clearfix"></p>
                <hr>
                <div class="col-xs-12 col-sm-12">
                    <div class="web">
                        <p class="ttu weight600">Fax:</p>
                        <p class="weight300 fs16 gray"><a href="tel:+97192220782">+97192220782</a> </p>
                    </div>
                </div>
                <p class="clearfix"></p>
                <hr>
                <div class="clearfix"></div>
                <!--<div class="col-xs-12 col-sm-12">
                    <div class="web">
                        <p class="ttu weight600">Website:</p>
                        <p class="weight300 fs16 gray"><a href="http://technopark-sa.com/" target="_blank" class="u">www.technopark-sa.com</a></p>
                    </div>
                </div>-->
                <div class="col-xs-12 col-sm-12">
                    <div class="email">
                        <p class="ttu weight600">Email:</p>
                        <p class="weight300 fs16 gray"><a href="mailto:info@fujicosolutions.com" class="u">info@fujicosolutions.com</a></p>
                    </div>
                </div>
            </div>
		</div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="clearfix"></div>
<div class="fh5co-parallax" style="background-image: url(images/call_bg.jpg);" data-stellar-background-ratio="0.5">
    <div class="services_section">
        <div class="services_ot">
            <div class="callus_bg animated drop_eff pt20">
            	<h2>Give Us A Call!</h2>
                <div class="container">  
                    <div class="col-xs-12 col-sm-6 col-md-5 col-lg-4 ac pt10 mb10 col-lg-offset-2 col-md-offset-1">
                        <div class="pb20">
                            <p class="fl phone1"><img src="images/phone.png" width="43" height="49" alt=""></p>
                            <p class="fl phone">Contact Number<br>
                            <span><a href="tel:+971551465555">+971551465555</a></span> </p>
                        </div>
                    	<p class="clearfix"></p>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-5 col-lg-4 ac pt10">
                        <div class="pb20">
                            <p class="fl phone1"><img src="images/email.png" width="48" height="35" alt=""></p>
                            <p class="fl phone">Email ID<br>
                            <span><a href="mailto:info@fujicosolutions.com">info@fujicosolutions.com</a></span> </p>
                        </div>
                        <p class="clearfix"></p>
                    </div>
                 </div>
             </div>
		</div>
	</div>
</div>
<div class="clearfix"></div><!-- #BeginLibraryItem "/Library/footer.lbi" -->
<footer>
    <div class="footer_bg">
        <div class="container">
            <div class="row">
                <div class="followus animated drop_eff">
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                        <div class="ft_heading">
                            <p class="ft_heading">&nbsp;</p>
                            <h3 class="ft_heading hidden-xs hidden-sm">Quick Links</h3>
                            <h3 class="ft_heading visible-xs visible-sm dd_next hand">Quick Links</h3>
                            <div class="f_dd_box">
                                <div class="footer_nav">
                                    <ul>
                                        <li><a href="index.htm" title="Home">Home</a></li>
                                        <li><a href="about-us.htm" title="About Us">About Us</a></li>
                                        <li><a href="contact-us.htm" title="Contact Us">Contact Us</a></li>
                                        <li><a href="sitemap.htm" title="Sitemap">Sitemap</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                        <div class="ft_heading">
                            <p class="ft_heading">&nbsp;</p>
                            <h3 class="ft_heading hidden-xs hidden-sm">Service</h3>
                            <h3 class="ft_heading visible-xs visible-sm dd_next hand">Service</h3>
                            <div class="f_dd_box">
                                <div class="footer_nav">
                                    <ul>
                                    	<li><a href="electrical-solutions-consultancy.htm" title="Air conditioning installation">Air conditioning installation</a></li>
                                        <li><a href="air-conditioning-service.htm" title="Air conditioning Service">Air conditioning Service</a></li>
                                        <li><a href="electrical-solutions-consultancy.htm" title="Electrical solutions & Consultancy">Electrical solutions & Consultancy</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                        <div class="ft_heading">
                            <p class="ft_heading">&nbsp;</p>
                            <h3 class="ft_heading hidden-xs hidden-sm">Follow Us</h3>
                            <h3 class="ft_heading visible-xs visible-sm dd_next hand">Follow Us</h3>
                            <div class="f_dd_box">
                                <div class="followus1">
                                    <ul class="followus-links">
                                        <li><a href="javascript:void(0)" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="javascript:void(0)" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="javascript:void(0)" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="javascript:void(0)" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="javascript:void(0)" target="_blank"><i class="fa fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-4">
                        <div class="mt10">
                            <p class="ft-logo"><a href="index.htm"><img src="images/logo.png" alt=""></a></p>
                            <div class="footer_copyright opensans gray lh18px copy">Copyright © 2017 Fujico Solutions.<br>
                            All rights reserved.
                            <p class="clearfix"></p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="clearfix"></div>
    <div class="copyright_bg">
        <div class="container">
            <div class="copyright_sec3">
                
            </div>
            <div class="clearfix mb15"></div>
        </div>
    </div>
</footer><!-- #EndLibraryItem --><script src="//ajax.aspnetcdn.com/ajax/jquery/jquery-1.8.3.min.js"></script>
<script type="text/javascript">var Page='home';</script> 
<script type="text/javascript" src="Scripts/script.int.dg.js"></script>
</body>
</htm>
