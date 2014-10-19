<?php
	session_start();
	include_once("common.php");

	if (!isset($_SESSION['acc_type'])) {
		header("Location: loginpage.php?err=You%20must%20be%20logged%20in%20to%20view%20this%20page.");
		die("Redirecting...");
	} else if ($_SESSION['acc_type'] != "org") {
		header("Location: index.php");
		die("Redirecting...");
	} else {
		$acc_id = $_SESSION['acc_id'];
		$username = $_SESSION['username'];
		$org_name = $_SESSION['org_name'];
		$number = $_SESSION['number'];
		$email = $_SESSION['email'];
	}

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$item_name = $_POST['item_name'];
		$item_price = $_POST['item_price'];
		$item_description = $_POST['item_description'];
		$item_expiration = $_POST['item_expiration'];
		$item_categories = $_POST['item_categories'];

		$item_id = insert("INSERT INTO `items`(`item_name`,`acc_id`,`item_price`,`item_description`,`item_expiration`,`item_categories`) values('$item_name','$acc_id','$item_price','$item_description','$item_expiration','$item_categories')");

		$thumb_target = "images/thumb_" . $item_id . ".jpg";
		$pic_target = "images/pic_" . $item_id . ".jpg";

		move_uploaded_file($_FILES['item_thumb']['tmp_name'], $thumb_target);
		move_uploaded_file($_FILES['item_pic']['tmp_name'], $pic_target);

		header("Location: org_items.php");
	} else {
		header("Location: additempage.php");
	}
?>