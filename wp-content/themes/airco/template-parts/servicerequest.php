<?php //Service Request
$debug = FALSE; //for special debugging purposes :)
date_default_timezone_set('America/New York');
if($_POST && $_POST['secu'] == '' && $_POST['cmd'] == 'servreq'){ 
	
	$ph1 = $_POST['phone1'];
	$ph2 = $_POST['phone2'];
	$ph3 = $_POST['phone3'];
	$fullnumber = $ph1.$ph2.$ph3;
	
	$postvars = array(
		'Name' => $_POST['fname'].' '.$_POST['lname'],
		'Email Address' => $_POST['youremail'],
		'Phone Number' => $ph1.'-'.$ph2.'-'.$ph3,
		'Zip Code' => $_POST['yourzip'],
		'Requested Service Date' => date('M j, Y',strtotime($_POST['servicedate'])),
		'Additional Info' => htmlentities(stripslashes($_POST['additionalinfo'])),
	);
	
	$successmessage = '<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span><span class="sr-only">Success:</span> Your request has been received. Our staff will review your submission and get back wth you to schedule the closest time slot available.';
	$errormessage = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Errors were found. Please correct the indicated fields below.';
	//BEGIN CHECKS
	$passCheck = TRUE;
	$adderror = '';
	
	if($_POST['youremail'] == ''){ 
		$passCheck = FALSE;
		$adderror .= '<li>Email address is required.</li>';
	}elseif(!filter_var($_POST['youremail'], FILTER_VALIDATE_EMAIL) && !preg_match('/@.+\./', $_POST['youremail'])) {
		$passCheck = FALSE;
		$emailformattedbadly = TRUE;
		$adderror .= '<li>Email is formatted incorrectly.</li>';
	}
	if($_POST['fname'] == ''){ 
		$passCheck = FALSE;
		$adderror .= '<li>First name is required.</li>';
	}
	if($_POST['lname'] == ''){ 
		$passCheck = FALSE;
		$adderror .= '<li>Last name is required.</li>';
	}
	if($ph1 == '' || $ph2 == '' || $ph3 == ''){ 
		$passCheck = FALSE;
		$adderror .= '<li>All phone number fields are required.</li>';
	}elseif(!is_numeric($fullnumber)){
		$passCheck = FALSE;
		$phoneformattedbadly = TRUE;
		$adderror .= '<li>Phone fields require numbers.</li>';
	}
	if($_POST['servicedate'] == ''){ 
		$passCheck = FALSE;
		$adderror .= '<li>Please select a service date.</li>';
	}
	if($_POST['yourzip'] == ''){ 
		$passCheck = FALSE;
		$adderror .= '<li>Zip code is required.</li>';
	}elseif(!is_numeric($_POST['yourzip'])){
		$passCheck = FALSE;
		$zipformattedbadly = TRUE;
		$adderror .= '<li>Zip code requires numbers.</li>';
	}
	$headline = 'Service requested from website';
	$receiptheadline = 'Your service request';
	
	$sendadmin = array(
		'to'		=> 'ableair@gmail.com',
		'from'		=> 'Atlanta Air Company <noreply@mg.ableheatingandair.com>',
		'subject'	=> $headline,
		'bcc'		=> 'support@kerigan.com',
        'replyto'		=> $_POST['youremail']
	);
	
	$sendreceipt = array(
		'to'		=> $_POST['youremail'],
		'from'		=> 'Atlanta Air Company <noreply@mg.ableheatingandair.com>',
		'subject'	=> $receiptheadline,
		'bcc'		=> 'support@kerigan.com'
	);
	
	include('emailtemplate.php');
	
	$adminintrocopy = '<p '.$headlinestyle.'>You have received a service request from the website. Details are below:</p>';
	$receiptintrocopy = '<p '.$headlinestyle.'>Your service request has been received but not yet reserved. As we review website submissions, we will contact you to schedule the closest available time slot. What you submitted is below:</p>';
	
	$fontstyle = 'font-family: Tahoma, sans-serif; color:#555;';
	$headlinestyle = 'sytle="font-size:16px;'.$fontstyle.'"';
	$labelstyle = 'style="padding:4px 8px; background:#f3f3f3; border:1px solid #FFF; font-weight:bold;'.$fontstyle.' font-size:14px;"';
	$datastyle = 'style="padding:4px 8px; background:#f3f3f3; border:1px solid #FFF;'.$fontstyle.' font-size:14px;"';
	
	$submittedData = '<table cellpadding="0" cellspacing="0" border="0" style="width:100%" ><tbody>';
	foreach($postvars as $key => $var ){
		if(!is_array($var)){
			$submittedData .= '<tr><td '.$labelstyle.' >'.$key.'</td><td '.$datastyle.'>'.$var.'</td></tr>';
		}else{
			$submittedData .= '<tr><td '.$labelstyle.' >'.$key.'</td><td '.$datastyle.'>';
			foreach($var as $k => $v){
				$submittedData .= '<span style="display:block;width:100%;">'.$v.'</span><br>';
			}
			$submittedData .= '</ul></td></tr>';
		}
	}
	$submittedData .= '</tbody></table>';
	
	$adminContent = $adminintrocopy.$submittedData;
	$receiptContent = $receiptintrocopy.$submittedData;
	
	$emaildata = array(
		'headline'	=> $headline, 
		'introcopy'	=> $adminContent,
	);
	$receiptdata = array(
		'headline'	=> $receiptheadline, 
		'introcopy'	=> $receiptContent,
	);
	
	if($passCheck){
		sendEmail($sendadmin, $templatetop, $emaildata, $templatebot);
		sendEmail($sendreceipt, $templatetop, $receiptdata, $templatebot);
	}
}
if($horizontal == TRUE){ $formclass = 'col-sm-6 col-xs-12'; } else { $formclass = 'col-xs-12'; }
if($showIntro == TRUE){ 
	if($_POST['secu'] == '' && $_POST && $_POST['cmd'] == 'servreq'){
		if($_POST['secu'] == '' && $passCheck == FALSE && $_POST) {
			echo '<div class="alert alert-danger" role="alert">'.$errormessage.'</div>';
		}
		if($_POST['secu'] == '' && $passCheck == TRUE && $_POST) {
			echo '<div class="alert alert-success" role="alert">'.$successmessage.'</div>';
		}
	}else{
		echo '<p>'.$intro.'</p>';	
	}
}else{
	if($_POST['secu'] == '' && $_POST && $_POST['cmd'] == 'servreq'){
		if($_POST['secu'] == '' && $passCheck == FALSE && $_POST) {
			echo '<div class="alert alert-danger" role="alert">'.$errormessage;
			if($adderror != '') { echo '<ul>'.$adderror.'</ul>'; }
			echo '</div>';
		}
		if($_POST['secu'] == '' && $passCheck == TRUE && $_POST) {
			echo '<div class="alert alert-success" role="alert">'.$successmessage.'</div>';
		}
	}
}
?>
<form class="form" enctype="multipart/form-data" method="post">
<div class="row">
    <div class="col-sm-6">
    	<div class="row">
        	<div class="col-sm-6">
                <div class="form-group <?php if($_POST['fname']=='' && $_POST && $_POST['secu']=='' && $_POST['cmd'] == 'servreq') { echo 'has-error'; } ?>">
                    <label>FIRST NAME*</label>
                    <input name="fname" type="text" class="form-control" value="<?php echo $_POST['fname']; ?>" required>
                </div> 
            </div>
            <div class="col-sm-6">
                <div class="form-group <?php if($_POST['lname']=='' && $_POST && $_POST['secu']=='' && $_POST['cmd'] == 'servreq') { echo 'has-error'; } ?>">
                    <label>LAST NAME*</label>
                    <input name="lname" type="text" class="form-control" value="<?php echo $_POST['lname']; ?>" required>
                </div> 
            </div>
        </div>
        <div class="form-group <?php if(($_POST['youremail']=='' && $_POST && $_POST['secu']=='' && $_POST['cmd'] == 'servreq') || ($emailformattedbadly == TRUE && $_POST && $_POST['secu']=='' && $_POST['cmd'] == 'servreq')) { echo 'has-error'; } ?>">      
            <label>EMAIL*</label>
            <input name="youremail" type="email" class="form-control" value="<?php echo $_POST['youremail']; ?>" required>
        </div> 
        <div class="form-group <?php if((($_POST['phone1'] == '' || $_POST['phone2'] == '' || $_POST['phone3'] == '') && $_POST && $_POST['secu']=='' && $_POST['cmd'] == 'servreq') || ($phoneformattedbadly == TRUE && $_POST && $_POST['secu']=='' && $_POST['cmd'] == 'servreq')) { echo 'has-error'; } ?>"> 
            <label>PHONE NUMBER*</label>
            <div class="phone-group">
            <input type="tel" name="phone1" class="form-control ph ph1 <?php if($_POST['phone1'] == '') { echo 'has-error'; } ?>" value="<?php echo $_POST['phone1']; ?>" maxlength="3" required>
            <input type="tel" name="phone2" class="form-control ph ph2 <?php if($_POST['phone2'] == '') { echo 'has-error'; } ?>" value="<?php echo $_POST['phone2']; ?>" maxlength="3" required>
            <input type="tel" name="phone3" class="form-control ph ph3 <?php if($_POST['phone3'] == '') { echo 'has-error'; } ?>" value="<?php echo $_POST['phone3']; ?>" maxlength="4" required>
            </div>
        </div> 
        <div class="form-group <?php if(($_POST['yourzip']=='' && $_POST && $_POST['secu']=='' && $_POST['cmd'] == 'servreq') || ($zipformattedbadly == TRUE && $_POST && $_POST['secu']=='' && $_POST['cmd'] == 'servreq')) { echo 'has-error'; } ?>"> 
            <label>ZIP CODE OF PROPERTY*</label>
            <input name="yourzip" type="text" class="form-control zip" value="<?php echo $_POST['yourzip']; ?>" maxlength="5" pattern="\d{5}-?(\d{4})?" required>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group cal-container <?php if($_POST['servicedate']=='' && $_POST && $_POST['secu']=='' && $_POST['cmd'] == 'servreq') { echo 'has-error'; } ?>">
            <label>REQUESTED SERVICE DATE*</label>
            <input type="text" name="servicedate" class="form-control cal datepicker" value="<?php echo $_POST['servicedate']; ?>" required>
        </div> 
        <div class="form-group">
            <label>ADDITIONAL INFORMATION</label>
            <textarea name="additionalinfo" rows="4" class="form-control"><?php echo stripslashes($_POST['additionalinfo']); ?></textarea>
        </div>
        <div class="form-group">
			<input type="hidden" name="cmd" value="servreq" >
            <button class="btn btn-primary btn-md pull-right" >Submit Request</button>
        </div>
    </div>
</div> 
</form>