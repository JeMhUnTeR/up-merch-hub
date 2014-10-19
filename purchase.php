<?php
	session_start();
	include_once("common.php");

	if (!isset($_SESSION['acc_type'])) {
		header("Location: loginpage.php?err=You%20must%20be%20logged%20in%20to%20view%20this%20page.");
		die("Redirecting...");
	} else if ($_SESSION['acc_type'] != "user" OR !isset($_GET['id'])) {
		header("Location: index.php");
		die("Redirecting...");
	} else {
		$user_acc_id = $_SESSION['acc_id'];
		$item_id = $_GET['id'];
		$row = get_one("SELECT * FROM `items` WHERE `item_id`='$item_id'");
		$item_name = $row['item_name'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Purchase Item | UP Merchandise Hub</title>
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
				Purchase Item
			</span>
			<span class="crumb level2">
				<?php echo "Item " . $item_id; ?>
			</span>
			<span class="crumb level3">
				<?php echo $item_name; ?>
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
			<div class="item_panel">
				<?php
					include("purchase_preview.php");
				?>
			</div>
			<form action="send_order.php" method="POST" id="order_form">
				<input type="hidden" name="acc_id" value="<?php echo $user_acc_id; ?>" />
				<input type="hidden" name="item_id" value="<?php echo $item_id; ?>" />
				<table>
					<tr>
						<td class="form_label">Order Quantity</td>
						<td class="form_input"><input type="text" name="order_quantity" placeholder="Order Quantity" /></td>
					</tr><tr>
						<td class="form_label">Order Specifications</td>
						<td class="form_input"><textarea name="order_specs" placeholder="Order Specifications"></textarea></td>
					</tr>
				</table>
				<table>
					<tr>
						<td class="form_input"><input type="Submit" value="Submit Order" /></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>
</html>