<?php
function html_head_old(){
	$var='<table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td valign="top"><div style="color: #ff0000; font: normal 18px Arial, Helvetica, sans-serif; padding: 10px 15px 0px 5px;">ERROR!</div><div style="font:bold 12px arial; padding-left:50px; color:#bf0000;"><ul style="margin:4px; padding:2px;">';
	return $var;
}


function html_foot_old(){
	$var='</ul></div></td></tr></table><br />';
	return $var;
}

function html_head(){
	$var='<div>ERROR!</div><ul>';
	return $var;
}


function html_foot(){
	$var='</ul>';
	return $var;
}



function dynamic_check_form_values($elements_arr, $validation_arr) {
	$alert_message="";
	$retuned_val="";
	foreach($elements_arr as $key => $val) {
		$expld_name=explode("-",$key);
		$req_prob_st=trim("$expld_name[0]");
		$req_prob_id=trim("$expld_name[1]");
		$alert=trim("$expld_name[2]");
		$val=trim("$val");
		$html_head='<table><tr><td valign="top"><div><div style="color: #ff0000; font: normal 18px Arial, Helvetica, sans-serif; padding: 10px 15px 0px 5px;">ERROR!</div><div style="font:bold 12px arial; padding-left:50px; color:#bf0000;"><ul style="margin:4px; padding:2px;">';
		$html_foot='</ul></div></td></tr></table><br /><br />';

		if(!strlen($val)>0 and ($req_prob_st=="r" or $req_prob_st=="rp")) {
			$alert_message .= "<li>$alert</li>";
		}
		if(strlen($val)>0 and ($req_prob_st=="p" or $req_prob_st=="rp")) {
   			$exploded_exp=explode("^~~^", $validation_arr[$req_prob_id]);
   			$allowed_exp="$exploded_exp[0]";
			if (!preg_match("/$allowed_exp/", $val)) {   
				$alert_message .="<li>$alert, $exploded_exp[1]</li>";
			}
		}
	}
	if(strlen($alert_message)>0) {
		$msg=$alert_message;
		return $msg;
	}
	else {
		return "";
	}
}

$validation_ans_arr = array(
'1'=> '^([0-9])+$^~~^allowed characters are 0 to 9',
'2'=>'^([a-zA-Z\s])+([\s])*([a-zA-Z\s])*$^~~^allowed characters are a to z',
'3'=>'^([a-zA-Z0-9\s])+$^~~^allowed alphanumeric characters are 0-9, a to z, A -Z',
'4'=>'^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$^~~^allowed format email@website.com', 
'5'=>'^(\+)*([0-9])+([-\/\.])+([0-9])+([-\/\.])+([0-9])+$^~~^allowed format +91-011-21566456', 
'6'=>'^(http):\/\/(www\.)?([a-zA-Z])+\.(com|net|org|edu|co.uk|co.in|ca)$^~~^allowed format http://www.weblinkindia.net',  
'7'=>'^([0-9])+(\/|-){1}([0-9])+(\/|-)([0-9]){4}$^~~^allowed format  dd/mm/yyyy or dd-mm-yyyy',
'8'=>'^([0-9])+$^~~^allowed characters are 0 to 9',
'9'=>'^([0-9])+(\.)+([0-9])+$^~~^allowed format  7.5',
'10'=>'^([a-zA-Z0-9\s])+([&\-\.])*([a-zA-Z0-9\s])*$^~~^allowed characters are 0 to 9, a to z, dot, &, hiphen',
'11'=>'^([a-zA-Z0-9\s])+([&\-\.,\(\)\/])*([a-zA-Z0-9\s&\-\.,\(\)\/])*^~~^allowed characters are 0 to 9, a to z, &, comma, hiphen, dot, brackets',
'12'=>'^(\+)*([0-9])+([-\/\.])*([0-9])+([-\/\.])*([0-9])+$^~~^allowed characters are 0 to 9, +, /, -',
'13'=>'^(\+)*([0-9])+([-\/])*([0-9])+([-\/])*([0-9])+$^~~^allowed characters are 0 to 9, -, / and format could be +9891854673 or 91-011-9891854673 ',
'14'=>'^([1-9])+([0-9])*$^~~^must be greater than 0',
'15'=>'^([0-9]){2}(:){1}([0-5]){1}([0-9]){1}(:){1}([0-5]){1}([0-9]){1}$^~~^must be in format of 01:20:20      01(Hours), 20(Minutes and limit is up to 59), 01(Seconds and limit is up to 59)',
'16'=>'^([0-9\.])*([0-9])+([0-9\.])*$^~~^allowed characters are 0 to 9',
'17'=>'^([0-9]{1})([0-9]{1})(\/|-{1})([0-9]{1})([0-9]{1})(\/|-{1})([1-9]{1})([0-9]{3})$^~~^allowed format dd-mm-yyyy',
'18'=>'^[0-9A-Za-z\s_ -]+(.[jJ][pP][gG]|.[gG][iI][fF]|.[jJ][pP][eE][gG])$^~~^'
);
?>