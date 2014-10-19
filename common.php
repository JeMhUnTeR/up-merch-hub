<?php
	$database = 'up-merch-hub';
	$db_username = 'root';
	$db_password = '';

	date_default_timezone_set('Asia/Manila');

	function get($statement){
		global  $database;
		global $db_username;
		global $db_password;
		$connection = mysql_connect("localhost",$db_username,$db_password);

		if (!$connection)
		{
			die('db error');
		}

		mysql_select_db($database, $connection);
		$result = mysql_query($statement);

		mysql_close($connection);
		return $result;
	}

	function get_one($statement){
		global  $database;
		global $db_username;
		global $db_password;
		$connection = mysql_connect("localhost",$db_username,$db_password);

		if (!$connection)
		{
			die('db error');
		}

		mysql_select_db($database, $connection);

		$result = mysql_query($statement);
		$row = mysql_fetch_assoc($result);

		mysql_close($connection);

		return $row;
	}

	function insert($statement){
		global  $database;
		global $db_username;
		global $db_password;
		$connection = mysql_connect("localhost",$db_username,$db_password);

		if (!$connection)
		{
			die('db error');
		}

		mysql_select_db($database, $connection);

		$result = mysql_query($statement);
		$id =  mysql_insert_id();
		mysql_close($connection);

		return $id;
	}

	function update($statement){
		global  $database;
		global $db_username;
		global $db_password;
		$connection = mysql_connect("localhost",$db_username,$db_password);

		if (!$connection)
		{
			die('db error');
		}

		mysql_select_db($database, $connection);

		$result = mysql_query($statement);
		$rows =  mysql_affected_rows();
		mysql_close($connection);

		return $rows;
	}

	function delete($statement){
		global  $database;
		global $db_username;
		global $db_password;
		$connection = mysql_connect("localhost",$db_username,$db_password);

		if (!$connection)
		{
			die('db error');
		}

		mysql_select_db($database, $connection);

		$result = mysql_query($statement);
		$rows =  mysql_affected_rows();
		mysql_close($connection);

		return $rows;
	}

	$menuitems = array();
	if (!isset($_SESSION['acc_type'])) {
		$menuitems[] = array("Home","index.php");
		$menuitems[] = array("Login","loginpage.php");
		$menuitems[] = array("User Registration","reg_user.php");
		$menuitems[] = array("Org Registration","reg_org.php");
	} else if ($_SESSION['acc_type'] == "user") {
		$menuitems[] = array("Home","index.php");
		$menuitems[] = array("Orders","user_orders.php");
		$menuitems[] = array("Account Settings","settings.php");
		$menuitems[] = array("Logout","logout.php");
	} else if ($_SESSION['acc_type'] == "org") {
		$menuitems[] = array("Home","index.php");
		$menuitems[] = array("Org Merchandise","org_items.php");
		$menuitems[] = array("Add Item","additempage.php");
		$menuitems[] = array("Account Settings","settings.php");
		$menuitems[] = array("Logout","logout.php");
	}