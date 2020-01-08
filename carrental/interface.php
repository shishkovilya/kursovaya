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
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1251 " />
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div class="wrapper">
            <div id="article">
				<fieldset>
					<legend>Выберите действие</legend>
						<form action="add_data.php" method="post"><input type="submit" name="submit" value="Добавить данные"><br></form>
						<form action="remove_data.php" method="post"><input type="submit" name="submit" value="Удаление данных"><br></form>
						<form action="change_data.php" method="post"><input type="submit" name="submit" value="Изменение данных"><br></form>
						<form action="select.php" method="post"><input type="submit" name="submit" value="Выборка данных"><br></form>
						<form action="logout.php" method="post"><input type="submit" name="submit" value="Выйти с аккаунта"><br></form>
				</fieldset>
            </div>
        </div>
    </body>
</html>