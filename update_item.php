<?php
	session_start();
	include_once("common.php");

	if (!isset($_SESSION['acc_type'])) {
		header("Location: loginpage.php?err=You%20must%20be%20logged%20in%20to%20view%20this%20page.");
		die("Redirecting...");
	} else if ($_SESSION['acc_type'] != "org" OR !isset($_POST['item_id'])) {
		header("Location: org_items.php");
		die("Redirecting...");
	} else {
		$acc_id = $_SESSION['acc_id'];
		$item_id = $_POST['item_id'];
		$db_acc_id = get_one("SELECT `acc_id` FROM `items` WHERE `item_id`='$item_id'")['acc_id'];
		if ($acc_id != $db_acc_id) {
			header("Location: org_items.php");
			die("Redirecting...");
		}
	}

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$item_name = $_POST['item_name'];
		$item_price = $_POST['item_price'];
		$item_description = $_POST['item_description'];
		$item_expiration = $_POST['item_expiration'];
		$item_categories = $_POST['item_categories'];

		update("UPDATE `items` SET `item_name`='$item_name', `item_price`='$item_price', `item_description`='$item_description', `item_expiration`='$item_expiration', `item_categories`='$item_categories' WHERE `item_id`='$item_id'");

		$thumb_target = "images/thumb_" . $item_id . ".jpg";
		$pic_target = "images/pic_" . $item_id . ".jpg";

		if (isset($_FILES['item_thumb']['tmp_name'])) {
			move_uploaded_file($_FILES['item_thumb']['tmp_name'], $thumb_target);
		}
		if (isset($_FILES['item_pic']['tmp_name'])) {
			move_uploaded_file($_FILES['item_pic']['tmp_name'], $pic_target);
		}

		header("Location: edit.php?id=$item_id&notif=Item%20successfully%20updated.");
	} else {
		header("Location: index.php");
	}
?>