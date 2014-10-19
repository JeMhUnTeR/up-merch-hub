<?php
	session_start();
	include_once("common.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register | UP Merchandise Hub</title>
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
				Register
			</span>
			<span class="crumb level2">
				User
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
			<form action="reg.php" method="POST" id="login_form">
				<input type="hidden" name="acc_type" value="user" />
				<table>
					<tr>
						<td class="form_label">Username</td>
						<td class="form_input"><input type="text" name="username" placeholder="Username" /></td>
					</tr><tr>
						<td class="form_label">Password</td>
						<td class="form_input"><input type="password" name="password" placeholder="Password" /></td>
					</tr><tr>
						<td class="form_label">First Name</td>
						<td class="form_input"><input type="text" name="first_name" placeholder="First Name" /></td>
					</tr><tr>
						<td class="form_label">Last Name</td>
						<td class="form_input"><input type="text" name="last_name" placeholder="Last Name" /></td>
					</tr><tr>
						<td class="form_label">Contact Number</td>
						<td class="form_input"><input type="text" name="number" placeholder="09123456789" /></td>
					</tr><tr>
						<td class="form_label">Email Address</td>
						<td class="form_input"><input type="text" name="email" placeholder="username@example.com" /></td>
					</tr>
				</table>
				<table>
					<tr>
						<td class="form_input"><input type="Submit" value="Register" /></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>
</html>