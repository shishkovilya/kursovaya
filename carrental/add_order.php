<?php
	session_start();
	if(!$_SESSION['conn'])
	{
		header('location: index.php');
	}
	require_once 'connection.php';
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	$result =$conn->prepare("INSERT INTO orders VALUES (?, ?, ?, ?, ?, ?)");
	$result->bind_param("ssssss", $_POST['id_order'], $_POST['client_driver_lic'], $_POST['rented_car'], $_POST['workers_registration'], $_POST['amount_of_hours'], $_POST['data_order']);
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