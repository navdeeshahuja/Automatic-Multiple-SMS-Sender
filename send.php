<?php

	$handler = fopen('./counter.txt', 'r');
	$number = fread($handler, filesize('./counter.txt'));

	if(intval($number)>24)
	{
		die();
	}

	$message_filename = "./messages/message".$number.".txt";

	$handler = fopen($message_filename, 'r');

	$message=fread($handler, filesize($message_filename));

	$authKey = "Your Auth Key";

	$mobileNumber = '9999999999,9999999999';

	$senderId = "YOURID";

	$message = urlencode($message);
	 
	$route = "4";

	$postData = array(
	    'authkey' => $authKey,
	    'mobiles' => $mobileNumber,
	    'message' => $message,
	    'sender' => $senderId,
	    'route' => $route
	);

	$url="https://control.msg91.com/api/sendhttp.php";

	$ch = curl_init();
	curl_setopt_array($ch, array(
	    CURLOPT_URL => $url,
	    CURLOPT_RETURNTRANSFER => true,
	    CURLOPT_POST => true,
	    CURLOPT_POSTFIELDS => $postData

	));

	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	$output = curl_exec($ch);

	if(curl_errno($ch))
	{
	    //echo 'error:' . curl_error($ch);
	}

	curl_close($ch);

	$number++;

	$handler = fopen('./counter.txt', 'w');
	fwrite($handler, "$number");

	echo "done $number";
?>