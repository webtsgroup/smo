<?
//---------------------------------------------------------------------------------------
function send_email($from_name,$from_email,$to,$email_subject,$email_msg,$format,$replyto="",$smtp){
	if (!$smtp) {
		return Send_Mail_Att($from_name,$from_email,$to,$email_subject,$email_msg,$format,$replyto);
	}
	else {
		return Send_Mail_SMTP($from_name,$from_email,$to,$email_subject,$email_msg,$format,$replyto);
	}
}	
//---------------------------------------------------------------------------------------------------------	
function Send_Mail_Att($From_name,$From,$To,$Subject,$Email_Mess,$Format="",$replyto=""){
	global $charset;
	$From_name=stripslashes($From_name);
	$From_name=str_replace("&quot;","''",$From_name);
	if (ereg("(.*)<(.*)>", $From_name, $regs)) {
	   $From_name = '=?UTF-8?B?'.base64_encode($regs[1]).'?=<'.$regs[2].'>';
	}

	$headers  = "MIME-Version: 1.0\r\n";
	if($Format =="1"){
		$headers .= "Content-type: text/html; charset=UTF-8\r\n";
	}
	else{
		$Email_Mess = strip_tags($Email_Mess);
		$headers .= "Content-type: text/plain; charset=UTF-8\r\n";
	}

	$headers .= "X-Priority: 3\r\n";
	$headers .= "X-MSMail-Priority: Normal\r\n";
	$headers .= "X-Mailer: php\r\n";
	$headers .= "From: \"".$From_name."\" <".$From.">\r\n";
	
	if($replyto ==""){
		$replyto='no-reply@hahai-partners.com';	
	}
	
	$headers .= "Reply-To: \"".$replyto."\" <".$replyto.">\r\n";
	$headers .= "Return-Path: \"".$replyto."\" <".$replyto.">\r\n";
	$Subject=stripslashes($Subject);
	$Subject=str_replace("&quot;","\"",$Subject);
	$Email_Mess=stripslashes($Email_Mess);
	$Email_Mess=str_replace("&quot;","\"",$Email_Mess);
	$Email_Mess=str_replace("%show_email_footer%",$sending_email_footer,$Email_Mess);
	return (@mail($To,$Subject,$Email_Mess,$headers,'-f'.$replyto.'')); 
	//return (@mail($To,$Subject,$Email_Mess,$headers)); 
}
//---------------------------------------------------------------------------------------	
function Send_Mail_SMTP($from_name,$from_email,$to,$email_subject,$email_msg,$format,$replyto="") {				
	global $cf_SMTP_Host,$cf_SMTP_Port,$cf_SMTP_Authentication,$cf_SMTP_Username,$cf_SMTP_Password,$charset;		
	if ($from_name != "") {
		$headers["From"] = $from_name ."<$from_email>";
	}
	else {
		$headers["From"] = $from_email ."<$from_email>";
	}
	$To = $to ."<$to>";
	$headers["To"] = $To;
	$headers["Subject"] = $email_subject;
	if($replyto ==""){
			$replyto='no-reply@hahai-partners.com';	
	}
	$headers["Reply-To"] = $replyto ."<$replyto>";
	$headers["Return-path"] = $replyto ."<$replyto>";
	
	if ($format == "1") {
		$headers["Content-Type"] = "text/html; charset=$charset\n";
	}
	else {
		$email_msg = strip_tags($email_msg);
		$headers["Content-Type"] = "text/plain; charset=$charset\n";
	}
	$smtpinfo["host"] = $cf_SMTP_Host;
	$smtpinfo["port"] = $cf_SMTP_Port;
	$smtpinfo["auth"] = ($cf_SMTP_Authentication == "1") ? (true) : (false);
	if ($smtpinfo["auth"]) {
		$smtpinfo["username"] = $cf_SMTP_Username;
		$smtpinfo["password"] = $cf_SMTP_Password;
	}
	$mail_object =& Mail::factory("smtp", $smtpinfo);
	$mail = $mail_object->send($to, $headers, $email_msg);
	if (PEAR::isError($mail)) {
		return 0;
	}
	else return 1;
}
?>