<?php

function logMessage($logLevel, $message)
{
    	
    	$todaysDate = date("Y-M-D");
    	$todaysTime = date("h:i:s A");
    $filename = "log-{$todaysDate}.log";
    	$handle = fopen($filename, 'a');
    	$fullMessage = $todaysDate . ' ' . $todaysTime . ' [ ' . $logLevel . ' ] ' . $message . PHP_EOL;
    	fwrite($handle, $fullMessage);
    	fclose($handle);
}
function logInfo($message){
	logMessage("INFO", $message);
}

function logError($message){
	logMessage("ERROR", $message);
}

logMessage("INFO", "This is an info message.");
logMessage("ERROR", "This is an info message.");
