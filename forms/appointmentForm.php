<?php
@session_start();
require_once 'FormsClass.php';
$input = new FormsClass();

include 'form_details.php';
if($smtp)
include 'phpmailer/sendmail.php';

$formname = 'Set an Appointment Form';
$prompt_message = '<span style="color:#ff0000;">* = Required Information</span>';

if ($_POST){
	if(empty($_POST['Name']) ||
		empty($_POST['Address']) ||
		empty($_POST['Phone']) ||		
		empty($_POST['City']) ||
		empty($_POST['State']) ||
		empty($_POST['Zip']) ||		
		empty($_POST['Email']) ||	
		empty($_POST['secode'])) {
				
	
	$asterisk = '<span style="color:#FF0000; font-weight:bold;">*&nbsp;</span>';
	$asteriskEmail = '<span style="color:#FF0000;">Please enter a valid email address</span>';
	$prompt_message = $asterisk . '<span style="color:#FF0000;"> Required Fields are empty</span>';
	}
	else if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i",stripslashes(trim($_POST['Email']))))
		{ $prompt_message = '<span style="color:#FF0000;">Please enter a valid email address</span>';}
	else if($_SESSION['security_code'] != htmlspecialchars(trim($_POST['secode']), ENT_QUOTES))
		{ $prompt_message = '<span style="color:#CC0000;">Invalid Security Code</span>';}
	else{
	
		$body = '<div align="left" style="width:700px; height:auto; font-size:12px; color:#333333; letter-spacing:1px; line-height:20px;">
			<div style="border:8px double #c3c3d0; padding:12px;">
			<div align="center" style="font-size:22px; font-family:Times New Roman, Times, serif; color:#051d38;">'.$dcomp.'</div>
			<div align="center" style="color:#990000; font-style:italic; font-size:13px; font-family:Arial;">('.$formname.')</div>
			<p>&nbsp;</p>
			<table width="90%" cellspacing="2" cellpadding="5" align="center" style="font-family:Verdana; font-size:13px">
				';
		
			foreach($_POST as $key => $value){
				if($key == 'secode') continue;
				elseif($key == 'day') continue;
				elseif($key == 'year') continue;
				elseif($key == 'submit') continue;
				
				if($key == 'month'){
					$body .='<tr><td><b>Date of Birth</b></td><td>' .$_POST['month']. ' ' .$_POST['day']. ', ' .$_POST['year']. '</td></tr>';
				}elseif(!empty($value)){
					$key2 = str_replace('_', ' ', $key);
					if($value == ':') {
						$body .= '<tr><td colspan="2" style="background:#F0F0F0; line-height:30px"><b>'.$key2.'</b></td></tr>';
					}else {				
						$body .= '<tr><td><b>'.$key2.'</b>:</td> <td>'.htmlspecialchars(trim($value), ENT_QUOTES).'</td></tr>';
					}
				}
			}
			$body .= '
			</table>

			</div>
			</div>';	
	
		$subject = $dcomp . " [" . $formname . "]";		
		
		/************** for smtp ***********/
		if($smtp) { 
			$mail = new SendMail($host, $username, $password);
			$trysend = $mail->sendNow($to_email, $to_name, $cc, $bcc, $from_email, $from_name, $subject, $body);
			if ($trysend == 'ok')
				$sent = true;
			else
				$sent = false;
		}else {
		/************** for mail function ***********/
			$headers= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= "From: ".$from_name." <".$from_email.">\n";
			$headers .= "Cc: ".$cc."\n";
			if(!empty($bcc)){
    $headers .= "Bcc: ".$bcc;
}
			if(mail($to_email, $subject, $body, $headers)) {
				$sent = true;				
			}else {
				$sent = false;
			}
		}
		
		if($sent) {
				$success_msg = "Your message has been submitted.  We will get in touch with you as soon as possible.<br/>Thank you for your time.";
				$prompt_message ="<div style=\"width:auto; height:auto; padding-top:15x; padding-right:20px; padding-left:20px; margin:0 auto 0 auto; font-family:Times New Roman, Times, serif; font-weight:bold; border:6px #BABABA ridge; background:#F2F5F7\">
								<p align=\"center\" style=\"color:green; font-size:16px; font-style:italic;\">{$success_msg}</p></div>";
				unset($_POST);
		}else {
				$success_msg = 'Failed to send email. Please try again.';
				$prompt_message ="<div style=\"width:auto; height:auto; padding-top:15x; padding-right:20px; padding-left:20px; margin:0 auto 0 auto; font-family:Times New Roman, Times, serif; font-weight:bold; border:6px #BABABA ridge; background:#F2F5F7\">
								<p align=\"center\" style=\"color:#FF0000; font-size:16px; font-style:italic;\">{$success_msg}</p></div>";
		}
	}

}
//declaration here
$form_state = 'Florida';	
$state = array('Please select state.','Alabama','Alaska','Arizona','Arkansas','California','Colorado','Connecticut','Delaware','District Of Columbia','Florida','Georgia','Hawaii','Idaho','Illinois','Indiana','Iowa','Kansas','Kentucky','Louisiana','Maine','Maryland','Massachusetts','Michigan','Minnesota','Mississippi','Missouri','Montana','Nebraska','Nevada','New Hampshire','New Jersey','New Mexico','New York','North Carolina','North Dakota','Ohio','Oklahoma','Oregon','Pennsylvania','Puerto Rico','Rhode Island','South Carolina','South Dakota','Tennessee','Texas','Utah','Vermont','Virgin Islands','Virginia','Washington','West Virginia','Wisconsin','Wyoming');
$contact_options = array('Phone','Fax','Email');
$best_time = array('Anytime','Morning at Home','Morning at Work','Afternoon at Home','Afternoon at Work','Evening at Home','Evening at Work');
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php $dcomp; ?></title>

<link rel="stylesheet" type="text/css" media="screen" href="../scripts/jquery-ui.css" />
<link rel="stylesheet" type="text/css" media="screen" href="../scripts/ui.button.css" />

<script src="../scripts/lib/jquery.js" type="text/javascript"></script>
<script src="../scripts/jquery.validate.js" type="text/javascript"></script>
<script src="../scripts/jquery.ui.core.js" type="text/javascript"></script>
<script src="../scripts/jquery.ui.widget.js" type="text/javascript"></script>
<script src="../scripts/jquery.ui.button.js" type="text/javascript"></script>
<!--<script src="../scripts/themeswitchertool" type="text/javascript" ></script>-->

<script type="text/javascript">
$.validator.setDefaults({
	//submitHandler: function() { alert("submitted!"); },
	highlight: function(input) {
		$(input).addClass("ui-state-highlight");
	},
	unhighlight: function(input) {
		$(input).removeClass("ui-state-highlight");
	}
});

$().ready(function() {
	$.fn.themeswitcher && $('<div/>').css({
		position: "absolute",
		right: 10,
		top: 10
	}).appendTo(document.body).themeswitcher();
	
	// validate signup form on keyup and submit
	$("#signupForm").validate({
		rules: {
			Name: "required",
			Address: "required",
			Phone: "required",
			City: "required",
			State: "required",
			Zip: "required",
			Email: {
				required: true,
				email: true
			},
			secode: "required"

		
		},
		messages: {
			Name: "Required",
			Address: "Required",
			Phone: "Required",
			City: "Required",
			State: "Required",
			Zip: "Required",
			Email: "Enter a valid Email",
			secode: "Required"
		}
	});	
});
</script>

<style type="text/css">
	body { font-size: 6px;; }
	label { display: inline-block; width: 200px; font-size:13px; }
	legend { padding: 0.5em; }
	fieldset fieldset label { display: block; color: red; }
	#signupForm { width: 100%; }
	#signupForm label.error {
		width: auto;
		display: block;
		font-size:11px;
		font-weight:bold;
	}
	.ui-state-highlight, .ui-widget-content .ui-state-highlight{
		border:1px solid red;
	}
	.ui-widget input,.ui-widget textarea{
		border-radius:5px;
		border:1px solid #999999;
		padding:5px 5px;
	}
	.ui-widget input, select, textarea{
	border-radius:5px;
	border:1px solid #999999;
	padding:5px 5px;
}

</style>

</head>
<body style="font-family:Arial; font-size:12px; color:#333333; margin:0;"><a name="top" id="top"></a>
<form class="cmxform" id="signupForm" method="post" action="#top" enctype="multipart/form-data" onsubmit="parent.scrollTo(0, 500); return true">
<fieldset class="ui-widget ui-widget-content ui-corner-all">
	
	<table border="0" width="100%"  align="center"  cellpadding="5px;">	
		<tr><td colspan="3" align="left"><?php echo $prompt_message; ?></td></tr>
		<tr><td colspan="2"><hr size="1" noshade="noshade" color="#B2AD80" /></td></tr>
		<tr>
			<td><label for="Name">Full Name <span style="color:#FF0000; font-weight:bold;">*</span></label></td>
			<td align="left" class="ui-widget ui-widget-header2"><?php $input->fields('Name','width: 250px;'); ?></td>
		</tr>
		<tr>
			<td ><label for="Address">Address <span style="color:#FF0000; font-weight:bold;">*</span></label></td>
			<td align="left" class="ui-widget ui-widget-header2"><?php $input->fields('Address','width: 250px;'); ?></td>
		</tr>
		<tr>
			<td ><label for="City">City <span style="color:#FF0000; font-weight:bold;">*</span></label></td>
			<td align="left" class="ui-widget ui-widget-header2"><?php $input->fields('City','width: 250px;'); ?></td>
		</tr>
		<tr>
			<td><label for="State">State</label></td>
			<td align="left" class="ui-widget ui-widget-header2"><?php $input->select('State','width: 254px;',$state); ?></td>
		</tr>
		<tr>
			<td ><label for="Zip">Zip <span style="color:#FF0000; font-weight:bold;">*</span></label></td>
			<td align="left" class="ui-widget ui-widget-header2"><?php $input->fields('Zip','width: 250px;'); ?></td>
		</tr>
		<tr>
			<td ><label for="How_do_you_prefer_to_be_contacted">How do you prefer to be contacted? <span style="color:#FF0000; font-weight:bold;">*</span></label></td>
			<td align="left" class="ui-widget ui-widget-header2"><?php $input->select('How_do_you_prefer_to_be_contacted','width: 250px;',$contact_options); ?></td>
		</tr>
		<tr>
			<td ><label for="Email">Email Address <span style="color:#FF0000; font-weight:bold;">*</span></label></td>
			<td align="left" class="ui-widget ui-widget-header2"><?php $input->fields('Email','width: 250px;'); ?></td>
		</tr>
		<tr>
			<td ><label for="Fax">Fax</label></td>
			<td align="left" ><?php $input->fields('Fax','width: 250px;'); ?></td>
		</tr>
		<tr>
			<td ><label for="Phone">Phone <span style="color:#FF0000; font-weight:bold;">*</span></label></td>
			<td align="left" class="ui-widget ui-widget-header2"><?php $input->fields('Phone','width: 250px;'); ?></td>
		</tr>
		<tr>
			<td ><label for="Best_time_to_call">Best time to call <span style="color:#FF0000; font-weight:bold;">*</span></label></td>
			<td align="left" class="ui-widget ui-widget-header2"><?php $input->select('Best_time_to_call','width: 250px;',$best_time); ?></td>
		</tr>
		<tr>
			<td ><label for="Preferred_date">Preferred Date</label></td>
			<td align="left"><?php $input->fields('Preferred_date','width: 250px;'); ?></td>
		</tr>
		<tr>
			<td ><label for="Preferred_time">Preferred Time</label></td>
			<td align="left"><?php $input->fields('Preferred_time','width: 250px;'); ?></td>
		</tr>
		<tr>
			<td ><label for="Comments">Comments</label></td>
			<td align="left"><?php $input->textarea('Comments','width: 250px; height: 100px;'); ?></td>
		</tr>
		<tr><td colspan="2"><hr size="1" noshade="noshade" color="#B2AD80" /></td></tr>
		<tr>
			<td ><label for="secode">Security Code <span style="color:#FF0000; font-weight:bold;">*</span></label></td>
			<td align="left" class="ui-widget ui-widget-header2"><?php $input->fields('secode','width: 250px;'); ?></td>
		</tr>
		<tr>
			<td >&nbsp;</td>
			<td align="left"><img src="../securitycode/SecurityImages.php?characters=5" border="0" /></td>	
		</tr>
		<tr><td colspan="2"><hr size="1" noshade="noshade" color="#B2AD80" /></td></tr>
		<tr>
			<td colspan="2" align="center"><?php $input->buttons('submit','submit','Submit','cursor: pointer;'); ?></td>
		</tr>
	</table>
</fieldset>	
</form>
</body>
</html>