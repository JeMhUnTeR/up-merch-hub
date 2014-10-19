<?php
	session_start();
	include_once("common.php");

	if (!isset($_SESSION['acc_type'])) {
		header("Location: loginpage.php?err=You%20must%20be%20logged%20in%20to%20view%20this%20page.");
		die("Redirecting...");
	} else if ($_SESSION['acc_type'] != "user") {
		header("Location: index.php");
		die("Redirecting...");
	}

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$acc_id = $_POST['acc_id'];
		$item_id = $_POST['item_id'];
		$order_date = date("Ymd");
		$order_quantity = $_POST['order_quantity'];
		$order_specs = $_POST['order_specs'];

		insert("INSERT INTO `orders`(`acc_id`,`item_id`,`order_date`,`order_quantity`,`order_specs`) values('$acc_id','$item_id','$order_date','$order_quantity','$order_specs')");

		header("Location: index.php?notif=Order%20successfully%20submitted.");
	} else {
		header("Location: index.php");
	}
?>