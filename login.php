<?php
	session_start();
	include_once("common.php");

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$un = $_POST['username'];
		$pw = sha1($_POST['password']);

		$row = get_one("SELECT * FROM accounts WHERE username='$un' AND password='$pw'");

		if ($row) {
			$db_id = $row['acc_id'];
			$db_un = $row['username'];
			$db_pw = $row['password'];
			$db_at = $row['acc_type'];

			$_SESSION['acc_id'] = $db_id;
			$_SESSION['username'] = $un;
			$_SESSION['acc_type'] = $db_at;

			if ($db_at == "user") {
				$row2 = get_one("SELECT * FROM users WHERE acc_id=$db_id");
				$_SESSION['first_name'] = $row2['first_name'];
				$_SESSION['last_name'] = $row2['last_name'];
				$_SESSION['number'] = $row2['number'];
				$_SESSION['email'] = $row2['email'];

				echo "Logged in! Redirecting...";
				header("Location: index.php");
			} else if ($db_at == "org") {
				$row2 = get_one("SELECT * FROM orgs WHERE acc_id=$db_id");
				$_SESSION['org_name'] = $row2['org_name'];
				$_SESSION['number'] = $row2['number'];
				$_SESSION['email'] = $row2['email'];

				echo "Logged in! Redirecting...";
				header("Location: org_items.php");
			}
		} else {
			echo "Unable to log in. Redirecting...";
			header("Location: loginpage.php?err=Wrong%20username%20and%20password%20combination.");
		}
	} else {
		header("Location: loginpage.php");
	}
?>