<?php
class SendMail
{
	private $host;
	private $username;
	private $password;
	public function __construct($host, $username, $password)
	{
		$this->host = $host;
		$this->username = $username;
		$this->password = $password;
	}
	public function sendNow($to_email, $to_name, $cc, $bcc, $from_email, $from_name, $subject, $body, $attachment_path = 'none', $attachment_name = 'none')
	{
		require_once 'class.phpmailer.php'; 

		$mail = new PHPMailer();
		
		$mail->IsSMTP();						// set mailer to use SMTP (required)
		$mail->Host = $this->host;              // specify main and backup server (required)
		$mail->SMTPAuth = true;                 // turn on SMTP authentication (required)
		$mail->Username = $this->username;		// SMTP username (required)
		$mail->Password = $this->password;		// SMTP password (required)
		$mail->From = $from_email;				// sender email (required)	 
		$mail->FromName = $from_name; 			// sender name (required)
		$mail->AddAddress($to_email, $to_name);	//email = required, name = optional
		if (!empty($cc)) {
			if(strpos($cc, ',') === false){
				$mail->AddCC($cc);           		//email = required, name = optional
			}else{
				$ccArr = explode(',', $cc);
				foreach($ccArr as $value){
					$mail->AddCC($value);           		//email = required, name = optional
				}
			}	
		}
		if (!empty($bcc)) {
			$mail->AddBCC($bcc);         		//email = required, name = optional
		}
		
		//for file attachment
		if($attachment_path != 'none' && $attachment_name != 'none'){
			$mail->AddAttachment($attachment_path,$attachment_name);  // Attachment (oprional)
		}
		
		//$mail->WordWrap = 50;                 // set word wrap to 50 characters (optional)
		$mail->IsHTML(true);                	// set email format to HTML  (required) ... set false for plain text
		$mail->Subject = $subject;				// Subject (required)
		$mail->Body    = $body;					// Body / message (required)
		if (!$mail->Send()) {
			return $mail->ErrorInfo;
		} else {
			return 'ok';
		}
	}
}
?>