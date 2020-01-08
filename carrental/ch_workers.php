<?php
	session_start();
	if(!$_SESSION['conn'])
	{
		header('location: index.php');
	}
	require_once 'connection.php';
	$conn = new mysqli($servername, $username, $password, $dbname);
	$result =$conn->prepare("UPDATE workers SET id_worker = ?, fio_worker = ?, position = ?, worker_adress = ? WHERE id_worker = ?");
	$result->bind_param("sssss", $_POST['id_worker'], $_POST['fio_worker'], $_POST['position'], $_POST['worker_adress'], $_POST['workers']);
	if ($result->execute() === TRUE)
	{
		echo "<script type='text/javascript'>alert('Record changed!');</script>";
	}
	else
	{
		echo "<script type='text/javascript'>alert('Error: ".$conn->error."');</script>";
	}
	echo "<script>document.location.href = 'interface.php'; </script>";
?>