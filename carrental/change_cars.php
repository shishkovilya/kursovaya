<?php
	session_start();
	if(!$_SESSION['conn'])
	{
		header('location: index.php');
	}
	require_once 'connection.php';
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	$_SESSION['car'] = $_POST['car'];
	require_once 'connection.php';
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	$pos = "SELECT fio_owner FROM car_owners";
	$result = mysqli_query($conn, $pos);
	if ($result)
	{
		$all = mysqli_fetch_all($result);
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
				<form action='ch_cars.php' method='post'>
					<fieldset>
						<legend>Изменение записи</legend>
							<label for='id_car'>Номер машины: </label><br><input type='text' id='id_car' name='id_car' placeholder='id_car'><br>
							<label for='name_car'>Машина: </label><br><input type='text' id='name_car' name='name_car' placeholder='name_car'><br>
							<label for='vehicleIdentification'>Вин код: </label><br><select name='vehicleIdentification' id='vehicleIdentification'>
								<?php
									for($i = 0;$i < count($all); $i = $i+1)
									{
										$pos = "SELECT driver_license FROM car_owners WHERE fio_owner = '".$all[$i][0]."'";
										$res = mysqli_query($conn, $pos);
										if ($res)
										{
											$val = mysqli_fetch_all($res);
											$j = $i + 1;
											echo "<option value='".$val[0][0]."'>".$all[$i][0]."</option>";
										}
									}
								?>
							</select><br>
							<label for='price_per_hour'>Цена за час: </label><br><input type='text' id='price_per_hour' name='price_per_hour' placeholder='price_per_hour'><br>
							<input type='submit' name='submit' value='Изменить'>
					</fieldset>	
				</form>
            </div>
        </div>
    </body>
</html>