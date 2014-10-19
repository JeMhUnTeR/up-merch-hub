<?php
	session_start();
	include_once("common.php");

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$un = $_POST['username'];
		$pw = sha1($_POST['password']);
		$at = $_POST['acc_type'];

		$row = get_one("SELECT * FROM accounts WHERE username='$un'");

		if (!$row) {
			$acc_id = insert("INSERT INTO `accounts`(`username`,`password`,`acc_type`) values('$un','$pw','$at')");
			if ($at == "user") {
				$first_name = $_POST['first_name'];
				$last_name = $_POST['last_name'];
				$number = $_POST['number'];
				$email = $_POST['email'];

				insert("INSERT INTO `users`(`acc_id`,`first_name`,`last_name`,`number`,`email`) values('$acc_id','$first_name','$last_name','$number','$email')");

				header("Location: loginpage.php?notif=Registration%20successful.%20You%20may%20now%20log%20in%20below.");
			} else if ($at == "org") {
				$org_name = $_POST['org_name'];
				$number = $_POST['number'];
				$email = $_POST['email'];

				insert("INSERT INTO `orgs`(`acc_id`,`org_name`,`number`,`email`) values('$acc_id','$org_name','$number','$email')");

				header("Location: loginpage.php?notif=Registration%20successful.%20You%20may%20now%20log%20in%20below.");
			}
		} else {
			if ($at == "user") {
				header ("Location: reg_user.php?err=Username%20already%20exists.");
				die("Redirecting...");
			} else if ($at == "org") {
				header ("Location: reg_org.php?err=Username%20already%20exists.");
				die("Redirecting...");
			}
		}
	} else {
		header("Location: index.php");
	}
?>