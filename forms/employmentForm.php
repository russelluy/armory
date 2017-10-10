<?php
@session_start();
require_once 'FormsClass.php';
$input = new FormsClass();

include 'form_details.php';
if($smtp)
include 'phpmailer/sendmail.php';

$formname = 'Employment Form';
$prompt_message = '<span style="color:#ff0000;">* = Required Information</span>';

if ($_POST){
	if ($_FILES["attachment"]["error"] > 0) {
		echo "";
	}
	else {
		//echo "Upload: " . $_FILES["attachment"]["name"] . "<br />";
		//echo "Type: " . $_FILES["attachment"]["type"] . "<br />";
		//echo "Size: " . ($_FILES["attachment"]["size"] / 1024) . " Kb<br />";
		//echo "Stored in: " . $_FILES["attachment"]["tmp_name"];
		
		if (file_exists("upload/" . $_FILES["file"]["name"])) {
			echo $_FILES["file"]["name"] . " already exists. ";
		} 
		else {
			move_uploaded_file($_FILES["file"]["tmp_name"],
			"upload/" . $_FILES["file"]["name"]);
		}
	}
	
	if(empty($_POST['Fullname']) ||
		empty($_POST['Address']) ||
		empty($_POST['City']) ||		
		empty($_POST['Zip']) ||	
		empty($_POST['Phone_Day']) ||		
		empty($_POST['Email']) ||	
		empty($_POST['secode'])) {
				
	
	$asterisk = '<span style="color:#FF0000; font-weight:bold;">*&nbsp;</span>';
	$asteriskEmail = '<span style="color:#FF0000;">Please enter a valid email address</span>';
	$prompt_message = $asterisk . '<span style="color:#FF0000;"> Required Fields are empty</span>';
	}
	else if(!eregi("^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,5}$",stripslashes(trim($_POST['Email']))))
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
			if(!empty($_FILES['attachment']['name'])){
				$attachment_path = $_FILES['attachment']['tmp_name'];
			   $attachment_name = basename($_FILES['attachment']['name']);
			}else{
			   $attachment_path = 'none';
			   $attachment_name = 'none';
			  }
			   
			  // send email  
			  $mail = new SendMail($host, $username, $password);
			  $trysend = $mail->sendNow($to_email, $to_name, $cc, $bcc, $from_email, $from_name, $subject, $body, $attachment_path, $attachment_name);
			  if ($trysend == 'ok')
				$sent = true;
			  else
				$sent = false;
		}else {
		/************** for mail function ***********/
			$headers  = "MIME-Version: 1.0\n"; 
			$headers .= "Content-type: text/html; charset=iso-8859-1\n"; 
			$headers .= "From: ".$from_name." <".$from_email.">\n";
			$headers .= "Cc: ".$cc."\n";
			if(!empty($bcc)){
    $headers .= "Bcc: ".$bcc;
}
			
			//file attachment
			if(!empty($_FILES['attachment']['name'])){
				$magic_quotes = get_magic_quotes_runtime();
				set_magic_quotes_runtime(0);	
				$attach_name = basename($_FILES['attachment']['name']);
				$uid = md5(uniqid(time()));
				$headers = "From: ".$from_name." <".$from_email.">\n";
				$headers .= "Cc: ".$cc."\n";
				if(!empty($bcc)){
    $headers .= "Bcc: ".$bcc."\n";
}
				$headers .= "MIME-Version: 1.0\n";
				$headers .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\n\n";
				$headers .= "--".$uid."\n";
				$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
				$headers .= "Content-Transfer-Encoding: 8bit\n\n";
				$headers .= $body;
				$headers .= "\n\n";
				$headers .= "--".$uid."\n";
				$headers .= "Content-Type: application/octet-stream; name=\"".$attach_name."\"\n";
				$headers .= "Content-Transfer-Encoding: base64\n";
				$headers .= "Content-Disposition: attachment; filename=\"".$attach_name."\"\n\n"; 
				$headers .= chunk_split(base64_encode(file_get_contents($_FILES['attachment']['tmp_name'])),76,"\n");
				$headers .= "\n\n";
				$headers .= "--".$uid."--\n";
				set_magic_quotes_runtime($magic_quotes);
			}	
			
			if(mail($to_email, $subject, $body, $headers)) {
				$sent = true;				
			}else {
				$sent = false;
			}
			
		}
		
		if($sent) {
				$success_msg = 'Thank you for sending your application.';
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
$form_state = 'Florida';	
$state = array('Please select state.','Alabama','Alaska','Arizona','Arkansas','California','Colorado','Connecticut','Delaware','District Of Columbia','Florida','Georgia','Hawaii','Idaho','Illinois','Indiana','Iowa','Kansas','Kentucky','Louisiana','Maine','Maryland','Massachusetts','Michigan','Minnesota','Mississippi','Missouri','Montana','Nebraska','Nevada','New Hampshire','New Jersey','New Mexico','New York','North Carolina','North Dakota','Ohio','Oklahoma','Oregon','Pennsylvania','Puerto Rico','Rhode Island','South Carolina','South Dakota','Tennessee','Texas','Utah','Vermont','Virgin Islands','Virginia','Washington','West Virginia','Wisconsin','Wyoming');
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
			Fullname: "required",
			Address: "required",
			City: "required",
			Zip: "required",
			Phone_Day: "required",
			Attachment: "required",
			Email: {
				required: true,
				email: true
			},
			secode: "required"

		
		},
		messages: {
			Fullname: "Required",
			Address: "Required",
			City: "Required",
			Zip: "Required",
			Phone_Day: "Required",
			Attachment: "Required",
			Email: "Enter a valid Email",
			secode: "Required"
		}
	});
		
});
</script>

<style type="text/css">
	body { font-size: 6px;; }
	label { display: inline-block; width: 200px;  font-size:13px;}
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
		<tr><td colspan="3" align="left"><?php echo $prompt_message; ?></td></tr>
			<tr><td colspan="2"><hr size="1" noshade="noshade" color="#B2AD80" /></td></tr>
			<tr >
				<td>
					<label for="Fullname">Full Name <span style="color:#FF0000; font-weight:bold;">*</span> </label>
				</td>	
				<td align="left" class="ui-widget ui-widget-header2">
					<?php $input->fields('Fullname','width: 200px;'); ?>
				</td>
			</tr>
			<tr>
				<td>
					<label for="Address">Address <span style="color:#FF0000; font-weight:bold;">*</span> </label>
				</td>
				<td align="left" class="ui-widget ui-widget-header2">
					<?php $input->fields('Address','width: 200px;'); ?>
				</td>
			</tr>
			<tr >
				<td>
					<label for="City">City <span style="color:#FF0000; font-weight:bold;">*</span> </label>
				</td>
				<td align="left" class="ui-widget ui-widget-header2">
					<?php $input->fields('City','width: 200px;'); ?>
				</td>
			</tr>
			<tr >
				<td>State</td>
				<td align="left"><?php $input->select('State','width: 204px;',$state); ?></td>
		   </tr>
			<tr >
				<td>
					<label for="Zip">Zip <span style="color:#FF0000; font-weight:bold;">*</span> </label>
				</td>
				<td align="left" class="ui-widget ui-widget-header2">
					<?php $input->fields('Zip','width: 200px;'); ?>
				</td>
			</tr>
			<tr >
				<td>
					<label for="Phone_Day">Phone Day <span style="color:#FF0000; font-weight:bold;">*</span> </label>
				</td>
				<td align="left" class="ui-widget ui-widget-header2">
					<?php $input->fields('Phone_Day','width: 200px;'); ?>
				</td>
			</tr>
			<tr >
				<td>
					<label for="Phone_Evening">Phone Evening</label>
				</td>
				<td align="left">
					<?php $input->fields('Phone_Evening','width: 200px;'); ?>
				</td>
			</tr>
			<tr >
				<td>
					<label for="email">Email Address <span style="color:#FF0000; font-weight:bold;">*</span> </label>
				</td>
				<td align="left" class="ui-widget ui-widget-header2">
					<?php $input->fields('Email','width: 200px;'); ?>
				</td>
			</tr>
			<tr >
				<td width="250">What license do you currently hold?</td>
				<td align="left"><?php $input->chkbox('What_license_do_you_currently_hold?',array('HHA','RN','LPN','None')); ?></td>
			</tr>
			<tr >
				<td width="200">Are you over 18?</td>
				<td align="left"><?php $input->radio('Are_you_over_18?',array('Yes','No')); ?></td>
			</tr>
			<tr>
				<td width="200">Do you have a Driver's License?</td>
				<td align="left"><?php $input->radio('Do_you_have_a_Drivers_License?',array('Yes','No')); ?></td>
			</tr>
			<tr>
				<td width="200">Do you own a car?</td>
				<td align="left"><?php $input->radio('Do_you_own_a_car?',array('Yes','No')); ?></td>
			</tr>
			<tr>
				<td width="200">What shifts would you prefer?</td>
				<td align="left"><?php $input->chkbox('What_shifts_would_you_prefer?',array('Days','Nights','PM','Live-in')); ?></td>
			</tr>
			<tr>
				<td width="200">Previous experience</td>
				<td align="left"><?php $input->textarea('Previous_experience','width: 200px; height: 100px;'); ?></td>
			</tr>
			<tr>
				<td width="200">How did you hear about us?</td>
				<td align="left"><?php $input->fields('How_did_you_hear_about_us?','width: 200px;'); ?></td>
			</tr>
			
			<tr>
				<td width="200"><label for="attachment">Attach Resume </label></td>
				<td align="left"><input type="file" name="attachment" size="30" /></td>
			</tr>
			
			<tr><td colspan="2"><hr size="1" noshade="noshade" color="#B2AD80" /></td></tr>
			<tr>
				<td ><label for="secode">Security Code <span style="color:#FF0000; font-weight:bold;">*</span> </label></td>
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