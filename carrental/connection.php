<?php
$servername = 'localhost';
$dbname = 'carRental';
if ($_SESSION['privilege'] === 1)
{
	$username = 'admin';
	$password = '12345';
}
else if ($_SESSION['privilege'] === 2)
{
	$username = 's_user';
	$password = '12345';
}
else if ($_SESSION['privilege'] === 3)
{
	$username = 'user';
	$password = '12345';
}
?>