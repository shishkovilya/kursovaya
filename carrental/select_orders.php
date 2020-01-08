<?php
	session_start();
	if(!$_SESSION['conn'])
	{
		header('location: index.php');
	}
	require_once 'connection.php';
	$conn = mysqli_connect($servername, $username, $password, $dbname);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1251 " />
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
	<style type="text/css">
		table {
			border-collapse: collapse;
		}
		table th,
		table td {
			padding: 0 3px;
		}
		table.brd th,
		table.brd td {
			border: 1px solid #000;
		}
	</style>
        <div class="wrapper">
            <div id="article">
				<fieldset>
					<legend>Выборка по таблице orders.</legend>
							<form action = 'select_orderss.php' method = 'post'>
								<label for='num'>Выберите: </label><select name='num' id='num'>
									<?php
										$sql = "SELECT * FROM orders";
										$res = mysqli_query($conn, $sql);
										if ($res)
										{
											$all = mysqli_fetch_all($res);
											$count = count($all);
											$int = intval($count/50);
											$drob = ($count/50)-intval($count/50);
											if($drob === 0)
											{
												$f = $int;
											}
											else
											{
												$f = $int+1;
											}
											for($k = 0;$k < $f; $k++)
											{
												$s = $k+1;
												echo "<option value=". $s .">". $s ."</option>";
											}
										}
									?>
									<input type='submit' name='submit' value='Показать'>
								</select><br>
							</form >
							<table class="brd">
							<?php
								if($_POST['column']!== NULL)
								{
									if($_SESSION['column'] !== $_POST['column'])
									{
										if($_POST['num'] === NULL)
										{
											$pos = "SELECT * FROM orders ORDER BY ".$_POST['column']." ASC LIMIT 50";
										}
										else 
										{
											$pos = "SELECT * FROM orders ORDER BY ".$_POST['column']." ASC LIMIT 50 OFFSET ".$_POST['num'];
										}
									}
									else
									{
										if($_POST['num'] === NULL)
										{
											$pos = "SELECT * FROM orders ORDER BY ".$_POST['column']." DESC LIMIT 50";
										}
										else 
										{
											$pos = "SELECT * FROM orders ORDER BY ".$_POST['column']." DESC LIMIT 50 OFFSET ".$_POST['num'];
										}
									}
									$_SESSION['column'] = $_POST['column'];
								}
								else
								{
									if($_POST['num'] === NULL)
									{
										$pos = "SELECT * FROM orders LIMIT 50";
									}
									else 
									{
										$pos = "SELECT * FROM orders LIMIT 50 OFFSET ".$_POST['num'];
									}
								}
								$q = mysqli_query($conn,'DESCRIBE orders');
								$arr = mysqli_fetch_all($q);
								$result = mysqli_query($conn, $pos);
								if ($result)
								{
									$val = mysqli_fetch_all($result);
									echo "<tr>";
									for($i = 0;$i < count($arr); $i = $i+1)
									{
										echo "<th><form action = 'select_orderss.php' method = 'post'><input type = 'hidden' name = 'column' value = ".$arr[$i][0]."> <input type='submit' name='submit' value=".$arr[$i][0]."></form></th>";
									}
									echo "</tr>";
									for($i = 0;$i < count($val); $i = $i+1)
									{
										echo "<tr>";
										for($j = 0;$j < count($val[$i]); $j = $j+1)
										{
											echo "<td>";
											print_r($val[$i][$j]);
											echo "</td>";
										}
										echo "</tr>";
									}
								}
							?>
							</table>
							<form action = 'select_orderss.php' method = 'post'>
								<label for='num'>Выберите: </label><select name='num' id='num'>
									<?php
										$sql = "SELECT * FROM orders";
										$res = mysqli_query($conn, $sql);
										if ($res)
										{
											$all = mysqli_fetch_all($res);
											$count = count($all);
											$int = intval($count/50);
											$drob = ($count/50)-intval($count/50);
											if($drob === 0)
											{
												$f = $int;
											}
											else
											{
												$f = $int+1;
											}
											for($k = 0;$k < $f; $k++)
											{
												$s = $k+1;
												echo "<option value=". $s .">". $s ."</option>";
											}
										}
									?>
									<input type='submit' name='submit' value='Показать'>
								</select><br>
							</form >
							<form action = 'interface.php' method = 'post'><input type='submit' name='submit' value='Назад'>
							</form >
				</fieldset>
            </div>
        </div>
    </body>
</html>