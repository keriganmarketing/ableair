<?php
//default settings
define(ADMIN_EMAIL,'atlantaaircompany@gmail.com');
define(DOMAIN_NAME,'atlantaaircompany.com');
$passCheck = TRUE;

$leads = new kmaLeads();
$honeypot = new Akismet( site_url(),'16d52e09a262');

//OK... form was submitted and it's not a bot... probably
if($_POST['sec'] == '' && $_POST['formId'] == 'Service Request' ){

	//assign vars to our post items
	$fName          = $_POST['fname'];
	$lName          = $_POST['lname'];
	$phone1         = $_POST['phone1'];
	$phone2         = $_POST['phone2'];
	$phone3         = $_POST['phone3'];
	$emailAddress   = $_POST['emailaddress'];

	$fullNumber     = '('.$phone1.') '.$phone2.'-'.$phone3;
	$formType       = $_POST['formId'];

	//Run our own checks on submitted data

	$adderror = array(); //make array of error data so we can loop it later

	if($fName.$lName == ''){
		$passCheck = FALSE;
		$adderror[] = 'First and last name are required. How else will we know who you are?';
	}
	if($emailAddress == ''){
		$passCheck = FALSE;
		$adderror[] = 'Please include your email address. You have one don\'t you?';
	}elseif(!filter_var($emailAddress, FILTER_VALIDATE_EMAIL) && !preg_match('/@.+\./', $emailAddress)) {
		$passCheck = FALSE;
		$emailFormattedBadly = TRUE;
		$adderror[] = 'The email address you entered doesn\'t look quite right. Better take another look.';
	}
	if($phone1 == '' || $phone2 == '' || $phone3 == '' || strlen($phone1)< 3 || strlen($phone2)< 3 || strlen($phone3)< 4 ){
		$passCheck = FALSE;
		$adderror[] = 'How would you like us to call you? We promise not to give your number to telemarketers.';
	}
	if($math != 6 ){
		$passCheck = FALSE;
		$adderror[] = 'Either you aren\'t very good at math or you aren\'t human...';
	}

	//assign vars to honeypot submission
	$honeypot->setCommentAuthor( $fName.' '.$lName );
	$honeypot->setCommentAuthorEmail( $emailAddress );
	$honeypot->setCommentContent( $emailMessage );
	$honeypot->setPermalink(strtolower(str_replace(' ','-',$_POST['fullname']).'-'.date('Y-m-d')));

	$successmessage = '<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span><span class="sr-only">Success:</span> ';
	$errormessage = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> ';

	if($honeypot->isCommentSpam()){
		//THIS IS SPAM
		//TODO: insert post marked as spam... how do we do that again?

		$passCheck = FALSE; //Why not?
		$errormessage .= 'Your message was flagged by our state-of-the-art spam checker. If you are selling SEO, I doubt you could do better than we can. If you are selling fake watches or purses, we don\'t want any. Otherwise, try adjusting your message to be less spammy.';

	} else { //NOT SPAM

		//Passed all checks
		if($passCheck) {

			//SET UP AND SEND LEAD VIA EMAIL
			//Set up headers
			$sendadmin = array(
				'to' => ADMIN_EMAIL,
				'from' => get_bloginfo() . ' <noreply@' . DOMAIN_NAME . '>',
				'subject' => 'Start a Project submission from website',
				'bcc' => 'support@kerigan.com',
				'replyto' => $emailAddress
			);
			$sendreceipt = array(
				'to' => $emailAddress,
				'from' => get_bloginfo() . ' <noreply@' . DOMAIN_NAME . '>',
				'subject' => 'Thanks for contacting us',
				'bcc' => 'support@kerigan.com'
			);

			//datafields for email
			$postvars = array(
				'Name' => $fName . ' ' . $lName,
				'Email Address' => $emailAddress,
				'Phone Number' => $fullNumber
			);

			$fontstyle = 'font-family: sans-serif;';
			$headlinestyle = 'style="font-size:20px; ' . $fontstyle . ' color:#000;"';
			$copystyle = 'style="font-size:16px; ' . $fontstyle . ' color:#333;"';
			$labelstyle = 'style="padding:4px 8px; background:#eaeaea; border:1px solid #fff; font-weight:bold; ' . $fontstyle . ' font-size:14px; color:#333; width:150px;"';
			$datastyle = 'style="padding:4px 8px; background:#eaeaea; border:1px solid #fff; ' . $fontstyle . ' font-size:14px; color:#333; "';

			$adminintrocopy = '<p ' . $copystyle . '>Details are below:</p>';
			$receiptintrocopy = '<p ' . $copystyle . '>We\'ll get back to you as soon as we can. What you submitted is below:</p>';
			$dateofemail = '<p ' . $copystyle . '>Date Submitted: ' . date('M j, Y') . ' @ ' . date('g:i a') . '</p>';

			$submittedData = '<table cellpadding="0" cellspacing="0" border="0" style="width:100%" ><tbody>';
			foreach ($postvars as $key => $var) {
				if (!is_array($var)) {
					$submittedData .= '<tr><td ' . $labelstyle . ' >' . $key . '</td><td ' . $datastyle . '>' . $var . '</td></tr>';
				} else {
					$submittedData .= '<tr><td ' . $labelstyle . ' >' . $key . '</td><td ' . $datastyle . '>';
					foreach ($var as $k => $v) {
						$submittedData .= '<span style="display:block;width:100%;">' . $v . '</span><br>';
					}
					$submittedData .= '</ul></td></tr>';
				}
			}
			$submittedData .= '</tbody></table>';

			$emaildata = array(
				'headline' => '<h2 ' . $headlinestyle . '>' . $sendadmin['subject'] . '</h2>',
				'introcopy' => $adminintrocopy . $submittedData . $dateofemail,
			);
			$receiptdata = array(
				'headline' => '<h2 ' . $headlinestyle . '>' . $sendreceipt['subject'] . '</h2>',
				'introcopy' => $receiptintrocopy . $submittedData . $dateofemail,
			);

			$leads->sendEmail($sendadmin, $emaildata);
			$leads->sendEmail($sendreceipt, $receiptdata);

			//Insert Post based on form submission
			$leads->wp_insert_post(
				array( //POST INFO
					'post_content' => '',
					'post_status' => 'publish',
					'post_type' => 'lead',
					'post_title' => $fName . ' ' . $lName . ' on ' . date('M j, Y'),
					'comment_status' => 'closed',
					'ping_status' => 'closed',
					'meta_input' => array( //POST META
						'lead_info_lead_type' => $formType,
						'lead_info_name' => $fName . ' ' . $lName,
						'lead_info_date' => date('M j, Y') . ' @ ' . date('g:i a e'),
						'lead_info_phone_number' => $fullNumber,
						'lead_info_email_address' => $emailAddress,
						'lead_info_message' => $emailMessage,
					)
				), true
			);

			$successmessage .= '<strong>Your submission was received. We sleep too, so please allow us 24 hours to get back to you.</strong>';
			$showAlert = '<div class="alert alert-success" role="alert">'.$successmessage.'</div>';

		} else { // Pass failed. Let's show an error message.

			$listErrors = '';
			foreach($adderror as $errorDirection) {
				$listErrors .= '<br>• '.$errorDirection;
			}
			$errormessage .= '<strong>Errors were found in your submission. Please correct the indicated fields below and try again.</strong>';
			$showAlert = '<div class="alert alert-danger" role="alert">'.$errormessage.$listErrors.'</div>';

		}
	}
}

if( $showAlert != '' ){
	echo '<div class="row justify-content-center"><div class="col-lg-10 col-xl-8 text-center" >'.$showAlert.'</div></div>';
} ?>
<form class="form" action="" method="post" >
	<section id="step1" class="form-section">
		<div class="row justify-content-center">
			<div class="col-lg-10 col-xl-8 text-center" >
				[start questions]
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-lg-7 col-xl-5 text-center" >
				<!--<div class="form-group row text-center justify-content-center">
					<div class="col">
						<div class="g-recaptcha" data-sitekey="6LcwNxQUAAAAANUji96UxBvziKoMjCw4A0fZdsrM"></div>
					</div>
				</div>-->
				<div class="form-group row">
					<div class="col">
						<input type="text" value="" class="sec" name="sec" style="position:absolute; height:1px; width:1px; visibility:hidden; top:-1px; left: -1px;" >
						<input type="hidden" value="Service Request" name="formId" >
						<button class="btn btn-primary btn-block btn-lg" type="submit" >Let's Go Fish'n!</button>
					</div>
				</div>
			</div>
		</div>
	</section>
</form>