<?php
$name=$_POST['name'];
$email=$_POST['email'];
$content=$_POST['content'];
$name=filter_var($name, FILTER_SANITIZE_STRING);
$email=filter_var($email, FILTER_SANITIZE_STRING);
$content=filter_var($content, FILTER_SANITIZE_STRING);
if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
	//INSERT WHATEVER YOU WANT TO DO HERE
}
else
{
	echo("Invalid EMAIL ID");
	header('Refresh: 2;url=about.php');
}
?>

