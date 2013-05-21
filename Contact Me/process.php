<?php

function remove_headers($string) { 
	$headers = array
	( "/to\:/i", 
	"/from\:/i", 
	"/bcc\:/i",
	"/cc\:/i", 
	"/Content\-Transfer\-Encoding\:/i",
	"/Content\-Type\:/i",
	"/Mime\-Version\:/i" 
	);
$string = preg_replace($headers, '', $string); return htmlentities($string);
}

$name = remove_headers($_POST['name']);
$email = remove_headers($_POST['email']);
$subject = remove_headers($_POST['subject']);
$comments = remove_headers($_POST['comments']);

foreach( $_POST as $value)
{
   if(empty($value) )
   {
    echo "Please fill in all fields.<br/>\n";
	include 'index.html';
	exit( );
   }
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) 
	{
	echo "Please enter a valid email address";
	include 'index.html';
	exit();
	}

$to = 'dina@dinalamdany.com';
$subject = "New message: $subject";
$message = "$name said: $comments";
$headers = "From: $email";


if (mail($to, $subject, $message, $headers)) {
    header("Location: success.html");
} else {
    die("There was a problem sending your email.");
}

?>