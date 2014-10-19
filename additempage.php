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
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Item | UP Merchandise Hub</title>
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
				<?php echo $org_name; ?>
			</span>
			<span class="crumb level2">
				Add New Merchandise
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
			<form enctype="multipart/form-data" action="additem.php" method="POST" id="item_form">
				<table>
					<tr>
						<td class="form_label">Item Name</td>
						<td class="form_input"><input type="text" name="item_name" placeholder="Item Name" /></td>
					</tr><tr>
						<td class="form_label">Item Price</td>
						<td class="form_input"><input type="text" name="item_price" placeholder="1299" /></td>
					</tr><tr>
						<td class="form_label">Item Description</td>
						<td class="form_input"><textarea name="item_description" placeholder="Item Description"></textarea></td>
					</tr><tr>
						<td class="form_label">Item Expiration</td>
						<td class="form_input"><input type="text" name="item_expiration" placeholder="20141019 (YYYYMMDD)" /></td>
					</tr><tr>
						<td class="form_label">Item Categories</td>
						<td class="form_input"><input type="text" name="item_categories" placeholder="category1, category2, category3" /></td>
					</tr><tr>
						<td class="form_label">Item Thumbnail</td>
						<td class="form_input"><input type="file" name="item_thumb" /></td>
					</tr><tr>
						<td class="form_label">Item Photo</td>
						<td class="form_input"><input type="file" name="item_pic" /></td>
					</tr>
				</table>
				<table>
					<tr>
						<td class="form_input"><input type="Submit" value="Add Item" /></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>
</html>