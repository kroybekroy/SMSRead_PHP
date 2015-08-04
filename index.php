<?php

echo 'Start';

try{

	$smsFile = '/home/dj/Downloads/sms.txt';

	$handle = fopen($smsFile, "r");

	if ($handle) {
	
		$o_sms = new sms();
	
	    while (($line = fgets($handle)) !== false) {
	            	
	        if(strpos($line, "_id") === 0)
	        {
	        	$o_sms->id = substr($line, strlen("_id : "));
	        }
	        else if(strpos($line, "address") === 0)
	        {
	        	$o_sms->address = substr($line, strlen("address : "));
	        }        
	        else if(strpos($line, "date") === 0)
	        {
	        	$o_sms->date = substr($line, strlen("date : "));
	        }
	        else if(strpos($line, "subject") === 0)
	        {	
	        	$o_sms->subject = substr($line, strlen("subject : "));
	        }
	        else if(strpos($line, "body") === 0)
	        {	
	        	$o_sms->body = substr($line, strlen("body : "));
	        }
	        else if(strpos($line, "---") === 0)
	        {
	        	$servername = "localhost";
	        	$username = "root";
	        	$password = "Welcome@123";
	        	
	        	try {
	        		$statement = "INSERT INTO sms (id, address, date, subject, body)
	        		VALUES ('$o_sms->id', '$o_sms->address', '$o_sms->date', '$o_sms->subject', '$o_sms->body')";
	        		        		
	        		$conn = new PDO("mysql:host=$servername;dbname=smsread", $username, $password);
	        		
	        		$conn->query($statement);
	        	}
	        	finally 
	        	{
	        		$conn = null;
	        		$o_sms = null;
	        	}
	        	
	        	$o_sms = new sms();
	        }
	    }
	
	    fclose($handle);
	}
}
catch (Exception $ex)
{
	echo $ex->getMessage();
}

echo 'Stop';
?>
<?php
class sms
{
	public $id;
	
	public $address;
	
	public $date;
	
	public $subject;
	
	public $body;
}
?>