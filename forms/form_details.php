<?php
//-------------------------------------------
// default smtp(phpmailer)
// change to clients smtp settings when launched
//-------------------------------------------
$host = 'secure.emailsrvr.com';
$username = 'onlineform4@proweaver.net';
$password = 'CebuCebu13';
//set to false when using mail() function
$smtp = true;
//-------------------------------
//apply changes here
// ------------------------------
$to_email = 'joseph_guapo@yahoo.com';
$cc = '';
$dcomp = 'Company Name';
// ----------------------------
$to_name = 'Info';
$bcc = '';
$from_email = (!empty($_POST['Email'])) ? $_POST['Email'] : 'joseph_guapo@yahoo.com';
$from_name = 'Message From Your Site';
$req = '<span style="color:#FF0000;">* </span>';
//----------------------------
//remove comments when testing
//----------------------------
//$to_email = 'qa@proweaver.net';
//$cc = 'pdqapw@gmail.com';
//----------------------------
?>
