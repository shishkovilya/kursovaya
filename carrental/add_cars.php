<?php
	session_start();
	if(!$_SESSION['conn'])
	{
		header('location: index.php');
	}
	require_once 'connection.php';
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	$result =$conn->prepare("INSERT INTO cars VALUES (NULL, ?, ?, ?)");
	$result->bind_param("sss", $_POST['name_car'], $_POST['vehicleIdentification'], $_POST['price_per_hour']);
	if ($result->execute() === TRUE)
	{
		echo "<script type='text/javascript'>alert('Record created!');</script>";
	}
	else
	{
		echo "<script type='text/javascript'>alert('Error: ".$conn->error."');</script>";
	}
	echo "<script>document.location.href = 'interface.php'; </script>";
?>