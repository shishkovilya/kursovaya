<?php
	session_start();
	if(!$_SESSION['conn'])
	{
		header('location: index.php');
	}
	require_once 'connection.php';
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	$pos = "SELECT num_car FROM cars";
	$result = mysqli_query($conn, $pos);
	if ($result)
	{
		$all = mysqli_fetch_all($result);
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=windows-1251 ' />
        <link rel='stylesheet' type='text/css' href='style.css'>
    </head>
    <body>
        <div class='wrapper'>
            <div id='article'>
				<form action='change_cars.php' method='post'>
					<fieldset>
						<legend>Выбор записи</legend>
							<label for='car'>Машины: </label><br><select name='car' id='car'>
								<?php
									for($i = 0;$i < count($all); $i = $i+1)
									{
										$pos = "SELECT * FROM cars";
										$result = mysqli_query($conn, $pos);
										if ($result)
										{
											echo "<option value='".$all[$i][0]."'>ID машины: ".$val[$i][0].", Название машины: ".$val[$i][1].", Вин код: ".$val[$i][2].", Цена за час: ".$val[$i][3]."</option>";
										}
									}
								?>
								</select><br>
							<input type='submit' name='submit' value='Выбрать'>
					</fieldset>	
				</form>
            </div>
        </div>
    </body>
</html>