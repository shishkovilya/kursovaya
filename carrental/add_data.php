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
						<form action="add_data_cars.php" method="post"><input type="submit" name="submit" value="Добавить данные для таблицы cars"><br></form>
						<form action="add_data_positions.php" method="post"><input type="submit" name="submit" value="Добавить данные для таблицы positions"><br></form>
						<form action="add_data_workers.php" method="post"><input type="submit" name="submit" value="Добавить данные для таблицы workers"><br></form>
						<form action="add_data_client.php" method="post"><input type="submit" name="submit" value="Добавить данные для таблицы client"><br></form>
						<form action="add_data_order.php" method="post"><input type="submit" name="submit" value="Добавить данные для таблицы order"><br></form>
						<form action="add_data_insurance.php" method="post"><input type="submit" name="submit" value="Добавить данные для таблицы insurance"><br></form>
						<form action="add_data_services.php" method="post"><input type="submit" name="submit" value="Добавить данные для таблицы services"><br></form>
						<form action="logout.php" method="post"><input type="submit" name="submit" value="Выйти с аккаунта"><br></form>
				</fieldset>
            </div>
        </div>
    </body>
</html>