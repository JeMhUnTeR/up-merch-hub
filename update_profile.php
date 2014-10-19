<?php
	session_start();
	include_once("common.php");

	if (!isset($_SESSION['acc_type'])) {
		header("Location: loginpage.php?err=You%20must%20be%20logged%20in%20to%20view%20this%20page.");
		die("Redirecting...");
	} else {
		$acc_type = $_SESSION['acc_type'];
	}

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$pw = sha1($_POST['password']);
		$npw = $_POST['newpassword'];

		if ($npw == "") {
			$npw = $pw;
		} else {
			$npw = sha1($npw);
		}

		$db_un = $_SESSION['username'];
		$row = get_one("SELECT password FROM accounts WHERE username='$db_un'");
		$db_pw = $row['password'];
		$acc_id = $_SESSION['acc_id'];

		if ($pw == $db_pw) {
			update("UPDATE `accounts` SET `password`='$npw' WHERE `acc_id`='$acc_id'");
			if ($acc_type == "user") {
				$first_name = $_POST['first_name'];
				$last_name = $_POST['last_name'];
				$number = $_POST['number'];
				$email = $_POST['email'];

				$_SESSION['first_name'] = $first_name;
				$_SESSION['last_name'] = $last_name;
				$_SESSION['number'] = $number;
				$_SESSION['email'] = $email;

				update("UPDATE `users` SET `first_name`='$first_name', `last_name`='$last_name', `number`='$number', `email`='$email' WHERE `acc_id`='$acc_id'");

				header("Location: settings.php?notif=Settings%20successfully%20updated.");
			} else if ($acc_type == "org") {
				$org_name = $_POST['org_name'];
				$number = $_POST['number'];
				$email = $_POST['email'];

				$_SESSION['org_name'] = $org_name;
				$_SESSION['number'] = $number;
				$_SESSION['email'] = $email;

				update("UPDATE `orgs` SET `org_name`='$org_name', `number`='$number', `email`='$email' WHERE `acc_id`='$acc_id'");

				header("Location: settings.php?notif=Settings%20successfully%20updated.");
			}
		} else {
			header ("Location: settings.php?err=Wrong%20password.");
			die("Redirecting...");
		}
	} else {
		header("Location: index.php");
	}
?>