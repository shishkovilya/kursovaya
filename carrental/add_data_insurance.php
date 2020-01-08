<?php
	session_start();
	if(!$_SESSION['conn'])
	{
		header('location: index.php');
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
				<form action='add_insurance.php' method='post'>
					<fieldset>
						<legend>Новая запись</legend>
							<label for='company'>Компания: </label><br><input type='text' id='company' name='company' placeholder='company'><br>
							<label for='vin_code_car'>Вин код: </label><br><input type='text' id='vin_code_car' name='vin_code_car' placeholder='vin_code_car'><br>
							<input type='submit' name='submit' value='Добавить'>
					</fieldset>	
				</form>
            </div>
        </div>
    </body>
</html>