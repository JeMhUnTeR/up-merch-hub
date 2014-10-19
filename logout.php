<?php
	session_start();
	session_destroy();
	header('Location: loginpage.php?notif=You%20have%20been%20successfully%20logged%20out.');
?>