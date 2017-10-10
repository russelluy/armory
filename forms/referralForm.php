<?php
@session_start();
require_once 'FormsClass.php';
$input = new FormsClass();

include 'form_details.php';
if($smtp)
include 'phpmailer/sendmail.php';

$formname = 'Referral Form';
$prompt_message = '<span style="color:#ff0000;">* = Required Information</span>';

if ($_POST){
	if(empty($_POST['Name_of_Referrer']) ||		
		empty($_POST['Email']) ||	
		empty($_POST['secode'])) {
				
	
	$asterisk = '<span style="color:#FF0000; font-weight:bold;">*&nbsp;</span>';
	$asteriskEmail = '<span style="color:#FF0000;">Please enter a valid email address</span>';
	$prompt_message = $asterisk . '<span style="color:#FF0000;"> Required Fields are empty</span>';
	}
	else if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i",stripslashes(trim($_POST['Email']))))
		{ $prompt_message = '<span style="color:#FF0000;">Please enter a valid email address</span>';}
	else if($_SESSION['security_code'] != htmlspecialchars(trim($_POST['secode']), ENT_QUOTES)){
		$prompt_message = '<span style="color:#CC0000;">Invalid Security Code</span>';
	}else{
	
		$body = '<div align="left" style="width:700px; height:auto; font-size:12px; color:#333333; letter-spacing:1px; line-height:20px;">
			<div style="border:8px double #c3c3d0; padding:12px;">
			<div align="center" style="font-size:22px; font-family:Times New Roman, Times, serif; color:#051d38;">'.$dcomp.'</div>
			<div align="center" style="color:#990000; font-style:italic; font-size:13px; font-family:Arial;">('.$formname.')</div>
			<p>&nbsp;</p>
			<table width="90%" cellspacing="2" cellpadding="5" align="center" style="font-family:Verdana; font-size:13px">
				';
		
			foreach($_POST as $key => $value){
				if($key == 'secode') continue;
				elseif($key == 'submit') continue;
				
				if(!empty($value)){
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
				$success_msg = 'We appreciate your referrals. Thank you for your time.';
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
/*************declaration starts here************/

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
			Name_of_Referrer: "required",
			Email: {
				required: true,
				email: true
			},
			secode: "required"

		
		},
		messages: {
			Name_of_Referrer: "Required",
			Email: "Enter a valid Email",
			secode: "Required"
		}
	});
	
	//$("#signupForm input:not(:submit)").addClass("");
	//$("#signupForm input:not(:submit)").addClass("form");
	//$(":submit").button();
	
	
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
		<tr><td colspan="4" align="left"><?php echo $prompt_message; ?></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
			<td>Name of Referrer <span style="color:#FF0000; font-weight:bold;">*</span></td>
			<td class="ui-widget ui-widget-header2"><?php $input->fields('Name_of_Referrer','width: 150px;'); ?></td>
			<td>Email <span style="color:#FF0000; font-weight:bold;">*</span></td>
			<td class="ui-widget ui-widget-header2"><?php $input->fields('Email','width: 150px;'); ?></td>
		</tr>
		<tr><td colspan="4"><hr size="1" noshade="noshade" color="#B2AD80" /></td></tr>
		<tr>
			<td colspan="4">
			<table align="center" width="90%">
				<tr>
					<td align="center"><strong>Name</strong></td>
					<td align="center"><strong>Email</strong></td>
					<td align="center"><strong>Phone</strong></td>
					<td align="left" width="1%">&nbsp;</td>
				</tr>
				<tr>
					<td align="center" class="ui-widget ui-widget-header2"><?php $input->fields('Name_1','width: 150px;'); ?></td>
					<td align="center" class="ui-widget ui-widget-header2"><?php $input->fields('Email_1','width: 150px;'); ?></td>
					<td align="center" class="ui-widget ui-widget-header2"><?php $input->fields('Phone_1','width: 150px;'); ?></td>
					<td align="left" width="1%">&nbsp;</td>
				</tr>
				<tr>
					<td align="center" class="ui-widget ui-widget-header2"><?php $input->fields('Name_2','width: 150px;'); ?></td>
					<td align="center" class="ui-widget ui-widget-header2"><?php $input->fields('Email_2','width: 150px;'); ?></td>
					<td align="center" class="ui-widget ui-widget-header2"><?php $input->fields('Phone_2','width: 150px;'); ?></td>
					<td align="left" width="1%">&nbsp;</td>
				</tr>
				<tr>
					<td align="center" class="ui-widget ui-widget-header2"><?php $input->fields('Name_3','width: 150px;'); ?></td>
					<td align="center" class="ui-widget ui-widget-header2"><?php $input->fields('Email_3','width: 150px;'); ?></td>
					<td align="center" class="ui-widget ui-widget-header2"><?php $input->fields('Phone_3','width: 150px;'); ?></td>
					<td align="left" width="1%">&nbsp;</td>
				</tr>
				<tr>
					<td align="center" class="ui-widget ui-widget-header2"><?php $input->fields('Name_4','width: 150px;'); ?></td>
					<td align="center" class="ui-widget ui-widget-header2"><?php $input->fields('Email_4','width: 150px;'); ?></td>
					<td align="center" class="ui-widget ui-widget-header2"><?php $input->fields('Phone_4','width: 150px;'); ?></td>
					<td align="left" width="1%">&nbsp;</td>
				</tr>
				<tr>
					<td align="center" class="ui-widget ui-widget-header2"><?php $input->fields('Name_5','width: 150px;'); ?></td>
					<td align="center" class="ui-widget ui-widget-header2"><?php $input->fields('Email_5','width: 150px;'); ?></td>
					<td align="center" class="ui-widget ui-widget-header2"><?php $input->fields('Phone_5','width: 150px;'); ?></td>
					<td align="left" width="1%">&nbsp;</td>
				</tr>
			</table>
			</td>
			</tr>	
			
			
		<table align="center" width="100%">
			<tr><td colspan="2"><hr size="1" noshade="noshade" color="#B2AD80" /></td></tr>
			<tr>
				<td >Security Code <span style="color:#FF0000; font-weight:bold;">*</span> </td>
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
	</table>
</fieldset>	
</form>
</body>
</html>