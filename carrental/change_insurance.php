<?php
	session_start();
	if(!$_SESSION['conn'])
	{
		header('location: index.php');
	}
	require_once 'connection.php';
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	$_SESSION['insurance'] = $_POST['insurance'];
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
				<form action="ch_insurance.php" method="post">
					<fieldset>
						<legend>Изменение записи</legend>
							<label for="number_insurance">ID услуги: </label><br><input type="text" id="number_insurance" name="number_insurance" placeholder="number_insurance"><br>
							<label for="company">Название услуги: </label><br><input type="text" id="company" name="company" placeholder="company"><br>
							<label for="vin_code_car">Цена услуги: </label><br><input type="text" id="vin_code_car" name="vin_code_car" placeholder="vin_code_car"><br>
							<input type="submit" name="submit" value="Изменить">
					</fieldset>	
				</form>
            </div>
        </div>
    </body>
</html>