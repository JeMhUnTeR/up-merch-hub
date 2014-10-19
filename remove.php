<?php
	session_start();
	include_once("common.php");

	if (!isset($_SESSION['acc_type'])) {
		header("Location: loginpage.php?err=You%20must%20be%20logged%20in%20to%20view%20this%20page.");
		die("Redirecting...");
	} else if ($_SESSION['acc_type'] != "org" OR !isset($_GET['id'])) {
		header("Location: org_items.php");
		die("Redirecting...");
	} else {
		$acc_id = $_SESSION['acc_id'];
		$item_id = $_GET['id'];
		$db_acc_id = get_one("SELECT `acc_id` FROM `items` WHERE `item_id`='$item_id'")['acc_id'];
		if ($acc_id == $db_acc_id) {
			delete("DELETE FROM `items` WHERE `item_id`='$item_id'");
		}
		header("Location: org_items.php");
		die("Redirecting...");
	}
?>