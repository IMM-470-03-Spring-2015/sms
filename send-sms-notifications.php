<?php
	/* Send an SMS using Twilio. You can run this file 3 different ways:
	 *
	 * - Save it as send-sms-notifications.php and at the command line, run 
	 *        php send-sms-notifications.php
	 *
	 * - Upload it to a web host and load, i.e http://www.tcnj.edu/~username/sms/send-sms-notifications.php 
	 *   in a web browser.
	 * - Download a local server like WAMP, MAMP or XAMPP. Point the web root 
	 *   directory to the folder containing this file, and load 
	 *   localhost:8888/send-sms-notifications.php in a web browser.
	 */

	// Step 1: Download the Twilio-PHP library from twilio.com/docs/libraries, 
	// and move it into the folder containing this file.
	require "Services/Twilio.php";

	// Step 2: set our AccountSid and AuthToken from www.twilio.com/user/account
	$AccountSid = "ACxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
	$AuthToken = "7exxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

	// Step 3: instantiate a new Twilio Rest Client
    
    // use this line if not using TCNJ web account
	$client = new Services_Twilio($AccountSid, $AuthToken);
    
    // use this block if using TCNJ web account
    /*
    $http = new Services_Twilio_TinyHttp(
        'https://api.twilio.com',
        array('curlopts' => array(
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,)
    ));

    $client = new Services_Twilio($AccountSid, $AuthToken, "2010-04-01", $http);
    */
    // end TCNJ connect block

	// Step 4: make an array of people we know, to send them a message. 
	// Feel free to change/add your own phone number and name here.
	$people = array(
		"+1xxxxxxxxxx" => "Curious George",
		"+1xxxxxxxxxx" => "Boots",
		"+1xxxxxxxxxx" => "Virgil",
	);

	// Step 5: Loop over all our friends. $number is a phone number above, and 
	// $name is the name next to it
	foreach ($people as $number => $name) {

		$sms = $client->account->messages->sendMessage(

		// Step 6: Change the 'From' number below to be a valid Twilio number 
		// that you've purchased, or the (deprecated) Sandbox number
			"XXX-XXX-XXXX", 

			// the number we are sending to - Any phone number
			$number,

			// the sms body
			"Hey $name, Monkey Party at 7PM. Bring Bananas!"
		);

		// Display a confirmation message on the screen
		echo "Sent message to $name \n";
	}
