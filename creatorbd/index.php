<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	
	$conn = mysqli_connect($servername, $username, $password);
	
	if (!$conn)
	{
		die("connection failed: " . mysqli_connect_error());
	}
	echo "Connection successfully!\n";
	
	//база данных
	$sql = "CREATE DATABASE carRental";
	
	if (mysqli_query($conn, $sql))
	{
		echo "Database carRental created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}
	echo "<br>";
	$dbname = "carRental";
	$conn = mysqli_connect($servername, $username, $password, $dbname);





	//таблица #1 должность
	$sql = "CREATE TABLE positions(
	id_position SERIAL PRIMARY KEY,
	name_position text NOT NULL,
	classification_lvl integer)";

	if (mysqli_query($conn, $sql))
	{
		echo "Table positions created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}
	echo "<br>";

	//таблица #2 сотрудники
	$sql = "CREATE TABLE workers(
	id_worker SERIAL PRIMARY KEY,
	fio_worker text NOT NULL,
	position integer REFERENCES positions (id_position),
	worker_adress text)";

	if (mysqli_query($conn, $sql))
	{
		echo "Table workers created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}
	echo "<br>";
	//таблица #3 клиент
	$sql = "CREATE TABLE client(
	driver_lic integer UNIQUE,
	fio_owner text NOT NULL,
	phone_number_client integer NOT NULL)";

	if (mysqli_query($conn, $sql))
	{
		echo "Table client created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}

	echo "<br>";

	//таблица #4 сервис
	$sql = "CREATE TABLE services(
	id_services SERIAL PRIMARY KEY,
	service_adress text,
	phone_number_service integer NOT NULL,
	owners_order text NOT NULL)";

	if (mysqli_query($conn, $sql))
	{
		echo "Table services created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}
	echo "<br>";
	//таблица #6 страховка
	$sql = "CREATE TABLE insurance(
	number_insurance SERIAL PRIMARY KEY,
	company text,
	vin_code_car char(16))";

	if (mysqli_query($conn, $sql))
	{	
		echo "Table insurance created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}
	echo "<br>";
	//таблица #7 машины
	$sql = "CREATE TABLE cars(
		id_car SERIAL PRIMARY KEY,
		name_car text NOT NULL,
		vehicleIdentification char(16) REFERENCES insurance (vin_code_car),
		price_per_hour integer)";

	if (mysqli_query($conn, $sql))
	{
		echo "Table cars created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}
	
	echo "<br>";

	//таблица #5 заказ
	$sql = "CREATE TABLE orders(
	id_order text REFERENCES services (owners_order),
	client_driver_lic integer REFERENCES client (driver_lic),
	rented_car integer REFERENCES cars (id_car),
	workers_registration integer REFERENCES workers (id_worker),
	amount_of_hours integer NOT NULL,
	data_order timestamp NOT NULL)";

	if (mysqli_query($conn, $sql))
	{
		echo "Table orders created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}
	echo "<br>";
	

	
	
	echo "<br>";
		echo "<br>";
			echo "<br>";
 	// ТРИГЕРЫ УДАЛЕНИЯ
	
	//триггер #1 удаление сервиса
	$sql = "CREATE TRIGGER remove_services AFTER DELETE ON services
			FOR EACH ROW BEGIN
			   DELETE FROM oreder WHERE id_order = OLD.owners_order;
			END";

	if (mysqli_query($conn, $sql))
	{
		echo "Trigger remove_services created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}

	echo "<br>";
	//триггер #2 удаление страховки
	$sql = "CREATE TRIGGER remove_insurance AFTER DELETE ON insurance
			FOR EACH ROW BEGIN
			   DELETE FROM cars WHERE vehicleIdentification = OLD.vin_code_car;
			END";

	if (mysqli_query($conn, $sql))
	{
		echo "Trigger remove_insurance created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}
	echo "<br>";

	//триггер #3 удаление клиента
	$sql = "CREATE TRIGGER remove_client AFTER DELETE ON client
			FOR EACH ROW BEGIN
			   DELETE FROM orders WHERE client_driver_lic = OLD.driver_lic;
			END";

	if (mysqli_query($conn, $sql))
	{
		echo "Trigger remove_client created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}

	echo "<br>";
	//триггер #4 удаление работника
	$sql = "CREATE TRIGGER remove_workers AFTER DELETE ON workers
			FOR EACH ROW BEGIN
			   DELETE FROM orders WHERE workers_registration = OLD.id_worker;
			END";

	if (mysqli_query($conn, $sql))
	{
		echo "Trigger remove_workers created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}

	echo "<br>";
	//триггер #5 удаление сервисов
	$sql = "CREATE TRIGGER remove_positions AFTER DELETE ON positions
			FOR EACH ROW BEGIN
			   DELETE FROM workers WHERE position = OLD.id_position;
			END";

	if (mysqli_query($conn, $sql))
	{
		echo "Trigger remove_positions created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}

	echo "<br>";
	//триггер #6 удаление машин
	$sql = "CREATE TRIGGER remove_cars AFTER DELETE ON cars
			FOR EACH ROW BEGIN
			   DELETE FROM orders WHERE rented_car = OLD.id_car;
			END";
	if (mysqli_query($conn, $sql))
	{
		echo "Trigger remove_cars created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}
		echo "<br>";
			echo "<br>";
				echo "<br>";
	



	// ТРИГЕРЫ ИЗМЕНЕНИЯ
	
	//триггер #1 изменение сервисов
	$sql = "CREATE TRIGGER update_services AFTER UPDATE ON services
			FOR EACH ROW BEGIN
			   UPDATE orders SET id_order = NEW.owners_order WHERE id_order = OLD.owners_order;
			END";

	if (mysqli_query($conn, $sql))
	{
		echo "Trigger update_services created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}
	echo "<br>";
	//триггер #2 изменение страховки
	$sql = "CREATE TRIGGER update_insurance AFTER UPDATE ON insurance
			FOR EACH ROW BEGIN
			   UPDATE cars SET vehicleIdentification = NEW.vin_code_car WHERE vehicleIdentification = OLD.vin_code_car;
			END";

	if (mysqli_query($conn, $sql))
	{
		echo "Trigger update_insurance created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}
		echo "<br>";
	//триггер #3 изменение клиента
	$sql = "CREATE TRIGGER update_client AFTER UPDATE ON client
			FOR EACH ROW BEGIN
			   UPDATE orders SET client_driver_lic = NEW.driver_lic WHERE client_driver_lic = OLD.driver_lic;
			END";

	if (mysqli_query($conn, $sql))
	{
		echo "Trigger update_client created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}
	echo "<br>";
	//триггер #4 изменение работника
	$sql = "CREATE TRIGGER update_workers AFTER UPDATE ON workers
			FOR EACH ROW BEGIN
			   UPDATE oreder SET workers_registration = NEW.id_worker WHERE workers_registration = OLD.id_worker;
			END";

	if (mysqli_query($conn, $sql))
	{
		echo "Trigger update_workers created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}

	echo "<br>";
	//триггер #5 изменение должности
	$sql = "CREATE TRIGGER update_positions AFTER UPDATE ON positions
			FOR EACH ROW BEGIN
			   UPDATE workers SET position = NEW.id_position WHERE position = OLD.id_position;
			END";

	if (mysqli_query($conn, $sql))
	{
		echo "Trigger update_positions created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}
	echo "<br>";
	//триггер #6 изменение услуг
	$sql = "CREATE TRIGGER update_cars AFTER UPDATE ON cars
			FOR EACH ROW BEGIN
			   UPDATE orders SET rented_car = NEW.id_car WHERE rented_car = OLD.id_car;
			END";

	if (mysqli_query($conn, $sql))
	{
		echo "Trigger update_cars created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}
	
		echo "<br>";
			echo "<br>";
				echo "<br>";
	// индекс

	//индекс #1 выборка машин
	$sql = "CREATE INDEX index_cars ON cars(id_car, vehicleIdentification, price_per_hour)";

	if (mysqli_query($conn, $sql))
	{
		echo "Index index_cars created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}
	echo "<br>";
	//индекс #2 выборка должности
	$sql = "CREATE INDEX index_positions ON positions(id_position, classification_lvl)";

	if (mysqli_query($conn, $sql))
	{
		echo "Index positions created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}
		echo "<br>";
	//индекс #3 выборка работников
	$sql = "CREATE INDEX index_workers ON workers(id_worker, position)";

	if (mysqli_query($conn, $sql))
	{
		echo "Index workers created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}
	echo "<br>";
	//индекс #4 выборка клиента
	$sql = "CREATE INDEX index_client ON client(driver_lic, phone_number_client)";

	if (mysqli_query($conn, $sql))
	{
		echo "Index index_client created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}
	echo "<br>";
	//индекс #5 выборка заказа
	$sql = "CREATE INDEX index_orders ON orders(client_driver_lic, rented_car, workers_registration, amount_of_hours, data_order)";

	if (mysqli_query($conn, $sql))
	{
		echo "Index index_order created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}
		echo "<br>";
	//индекс #6 выборка страховки
	$sql = "CREATE INDEX index_insurance ON insurance(number_insurance, vin_code_car)";

	if (mysqli_query($conn, $sql))
	{
		echo "Index index_insurance created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}
		echo "<br>";
	//индекс #7 выборка сервисов
	$sql = "CREATE INDEX index_services ON services(id_services, phone_number_service)";

	if (mysqli_query($conn, $sql))
	{
		echo "Index index_services created successfully!\n";
	}
	else
	{
		echo "Error: " . mysqli_error($conn);
	}
?>
