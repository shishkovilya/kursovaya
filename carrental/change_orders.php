<?php
	session_start();
	if(!$_SESSION['conn'])
	{
		header('location: index.php');
	}
	$_SESSION['orders'] = $_POST['orders'];
	require_once 'connection.php';
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	$pos = "SELECT owners_order FROM services";
	$result = mysqli_query($conn, $pos);
	if ($result)
	{
		$all_owners_order = mysqli_fetch_all($result);
	}
	$pos = "SELECT driver_lic FROM client";
	$result = mysqli_query($conn, $pos);
	if ($result)
	{
		$all_driver_lic = mysqli_fetch_all($result);
	}
	$pos = "SELECT id_car FROM cars";
	$result = mysqli_query($conn, $pos);
	if ($result)
	{
		$all_id_car = mysqli_fetch_all($result);
	}
	$pos = "SELECT id_worker FROM workers";
	$result = mysqli_query($conn, $pos);
	if ($result)
	{
		$all_id_worker = mysqli_fetch_all($result);
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1251 " />
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="wrapper">
            <div id="article">
				<form action='ch_orders.php' method='post'>
					<fieldset>
						<legend>Изменение записи</legend>
							<label for='id_order'>ФИО заказчика: </label><br><input type='text' id='id_order' name='id_order' placeholder='id_order'><br>
							<label for='client_driver_lic'>Сервис: </label><br><select name='client_driver_lic' id='client_driver_lic'>
								<?php
									for($i = 0;$i < count($all_owners_order); $i = $i+1)
									{
										if ($result)
										{
											$val = mysqli_fetch_all($result);
											echo "<option value='".$all_owners_order[$i][0]."'>".$all_owners_order[$i][0]."</option>";
										}
									}
								?>
								</select><br>
							<label for='client_driver_lic'>Номер водительского удостоверения: </label><br><select name='client_driver_lic' id='client_driver_lic'>
								<?php
									for($i = 0;$i < count($all_driver_lic); $i = $i+1)
									{
										if ($result)
										{
											$val = mysqli_fetch_all($result);
											echo "<option value='".$all_driver_lic[$i][0]."'>".$all_driver_lic[$i][0]."</option>";
										}
									}
								?>
								</select><br>
							<label for='rented_car'>Арендованная машина: </label><br><select name='rented_car' id='rented_car'>
								<?php
									for($i = 0;$i < count($all_id_car); $i = $i+1)
									{
										$pos = "SELECT name_car FROM cars WHERE id_car = '".$all_id_car[$i][0]."'";
										$result = mysqli_query($conn, $pos);
										if ($result)
										{
											$val = mysqli_fetch_all($result);
											echo "<option value='".$all_id_car[$i][0]."'>".$all_id_car[$i][0].", ".$val[0][0]."</option>";
										}
									}
								?>
								</select><br>
							<label for='worker'>Работник: </label><br><select name='worker' id='worker'>
								<?php
									for($i = 0;$i < count($all_id_worker); $i = $i+1)
									{
										$pos = "SELECT id_worker FROM workers WHERE fio_worker = '".$all_id_worker[$i][0]."'";
										$result = mysqli_query($conn, $pos);
										if ($result)
										{
											$val = mysqli_fetch_all($result);
											echo "<option value='".$val[0][0]."'>".$all_id_worker[$i][0]."</option>";
										}
									}
								?>
								</select><br>
							<label for='amount_of_hours'>Время аренды: </label><br><input type='text' id='amount_of_hours' name='amount_of_hours' placeholder='amount_of_hours'><br>
							<label for='data_order'>Дата аренды: </label><br><input type='text' id='data_order' name='data_order' placeholder='data_order'><br>
							<input type='submit' name='submit' value='Изменить'>
					</fieldset>	
				</form>
            </div>
        </div>
    </body>
</html>