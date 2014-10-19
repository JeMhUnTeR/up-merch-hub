<?php
	session_start();
	include_once("common.php");

	if (!isset($_SESSION['acc_type'])) {
		header("Location: loginpage.php?err=You%20must%20be%20logged%20in%20to%20view%20this%20page.");
		die("Redirecting...");
	} else {
		$acc_type = $_SESSION['acc_type'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Settings | UP Merchandise Hub</title>
	<?php include("head.php"); ?>
</head>
<body>
	<div id="header">
		<div class="vwrap">
			<?php include("header.php"); ?>
		</div>
	</div>
	<div id="navcrumbs">
		<div class="vwrap">
			<span class="crumb level1">
				Settings
			</span>
			<span class="crumb level2">
				<?php
					if ($acc_type == "user") {
						echo "User";
					} else if ($acc_type == "org") {
						echo "Organization";
					} else {
						echo "Other";
					}
				?>
			</span>
			<?php
				if (isset($_SESSION['username'])) {
			?>
			<span class="userdisplay">
				Logged in as
				<strong>
					<?php
						if ($_SESSION['acc_type'] == "user") {
							echo $_SESSION['first_name'] . " " . $_SESSION['last_name'];
						} else if ($_SESSION['acc_type'] == "org") {
							echo $_SESSION['org_name'];
						}
					?>
				</strong>
				<span class="userdisplay_username"><?php echo $_SESSION['username']; ?></span>
			</span>
			<?php
				}
			?>
		</div>
	</div>
	<div id="body">
		<div class="vwrap">
			<?php
				if (isset($_GET['notif'])) {
			?>
			<div id="notif">
				<?php echo $_GET['notif']; ?>
			</div>
			<?php
				}
			?>
			<?php
				if (isset($_GET['err'])) {
			?>
			<div id="err">
				<?php echo $_GET['err']; ?>
			</div>
			<?php
				}
			?>
			<form action="update_profile.php" method="POST" id="login_form">
				<table>
					<tr>
					<?php
						if ($acc_type == "user") {
					?>
						<td class="form_label">First Name</td>
						<td class="form_input"><input type="text" name="first_name" placeholder="First Name" value="<?php echo $_SESSION['first_name']; ?>" /></td>
					</tr><tr>
						<td class="form_label">Last Name</td>
						<td class="form_input"><input type="text" name="last_name" placeholder="Last Name" value="<?php echo $_SESSION['last_name']; ?>" /></td>
					</tr><tr>
					<?php
						} else if ($acc_type == "org") {
					?>
						<td class="form_label">Organization Name</td>
						<td class="form_input"><input type="text" name="org_name" placeholder="Organization Name" value="<?php echo $_SESSION['org_name']; ?>" /></td>
					</tr><tr>
					<?php
						}
					?>
						<td class="form_label">Contact Number</td>
						<td class="form_input"><input type="text" name="number" placeholder="09123456789" value="<?php echo $_SESSION['number']; ?>" /></td>
					</tr><tr>
						<td class="form_label">Email Address</td>
						<td class="form_input"><input type="text" name="email" placeholder="username@example.com" value="<?php echo $_SESSION['email']; ?>" /></td>
					</tr><tr>
						<td class="form_label">New Password</td>
						<td class="form_input"><input type="password" name="newpassword" placeholder="Leave blank to keep old password." /></td>
					</tr><tr>
						<td class="form_label">Confirm Password</td>
						<td class="form_input"><input type="password" name="password" placeholder="Confirm password to change info above." /></td>
					</tr>
				</table>
				<table>
					<tr>
						<td class="form_input"><input type="Submit" value="Update Info" /></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>
</html>