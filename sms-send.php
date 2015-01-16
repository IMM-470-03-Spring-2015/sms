<?php
    /* Send an SMS using Twilio. You can run this file 3 different ways:
     *
     * - Save it as sendnotifications.php and at the command line, run 
     *        php sendnotifications.php
     *
     * - Upload it to a web host and load mywebhost.com/sendnotifications.php 
     *   in a web browser.
     * - Download a local server like WAMP, MAMP or XAMPP. Point the web root 
     *   directory to the folder containing this file, and load 
     *   localhost:8888/sendnotifications.php in a web browser.
     */
 
    // Step 1: Download the Twilio-PHP library from twilio.com/docs/libraries, 
    // and move it into the folder containing this file.
    require "../Services/Twilio.php";
 
    // Step 2: set our AccountSid and AuthToken from www.twilio.com/user/account
    $AccountSid = "ACc97cde1b267c161a9e1d2f916b75d22b";
    $AuthToken = "7ecd6a0f68a4eb7128cdfbfe146ba8f1";
 
    // Step 3: instantiate a new Twilio Rest Client
    $client = new Services_Twilio($AccountSid, $AuthToken);
 
    // Step 4: make an array of people we know, to send them a message. 
    // Feel free to change/add your own phone number and name here.
    $people = array(
        "+12152642459" => "Curious George"
    );
 
    // Step 5: Loop over all our friends. $number is a phone number above, and 
    // $name is the name next to it
    foreach ($people as $number => $name) {
		$msg = null;
		
		try {
			$sms = $client->account->messages->sendMessage(
 
				// Step 6: Change the 'From' number below to be a valid Twilio number 
				// that you've purchased, or the (deprecated) Sandbox number
				"+12675363902", 
 
				// the number we are sending to - Any phone number
				$number,
 
				// the sms body
				"Hey $name, Monkey Party at 7PM. Bring Bananas!"
			);
			
			$msg = array('sid'=>$sms->sid,'date_created'=>$sms->date_created,'to'=>$sms->to,'from'=>$sms->from,'body'=>$sms->body,'status'=>$sms->status);
			
			/*
			$msg.= $sms->date_updated
			$msg.= $sms->date_sent
			$msg.= $sms->account_sid
			$msg.= $sms->num_segments
			$msg.= $sms->num_media
			$msg.= $sms->direction
			$msg.= $sms->api_version
			$msg.= $sms->price
			$msg.= $sms->price_unit
			$msg.= $sms->uri
			$msg.= $sms->subresource_uris
			*/
 
		} catch (Services_Twilio_RestException $e) {
				$msg = $e->getMessage();
		}
		
		// Display a confirmation message on the screen
		echo '<pre>'.print_r($msg,1).'</pre>';
    }