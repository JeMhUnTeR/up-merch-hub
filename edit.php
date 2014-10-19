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
		$row = get_one("SELECT * FROM `items` WHERE `item_id`='$item_id'");
		$db_acc_id = $row['acc_id'];
		$item_name = $row['item_name'];
		$item_price = $row['item_price'];
		$item_description = $row['item_description'];
		$item_expiration = $row['item_expiration'];
		$item_categories = $row['item_categories'];
		if ($acc_id != $db_acc_id) {
			header("Location: org_items.php");
			die("Redirecting...");
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Item Editor | UP Merchandise Hub</title>
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
				Item Editor
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
			<form enctype="multipart/form-data" action="update_item.php" method="POST" id="item_form">
				<input type="hidden" name="item_id" value="<?php echo $item_id; ?>" />
				<table>
					<tr>
						<td class="form_label">Item Name</td>
						<td class="form_input"><input type="text" name="item_name" placeholder="Item Name" value="<?php echo $item_name; ?>" /></td>
					</tr><tr>
						<td class="form_label">Item Price</td>
						<td class="form_input"><input type="text" name="item_price" placeholder="1299" value="<?php echo $item_price; ?>" /></td>
					</tr><tr>
						<td class="form_label">Item Description</td>
						<td class="form_input"><textarea name="item_description" placeholder="Item Description"><?php echo $item_description; ?></textarea></td>
					</tr><tr>
						<td class="form_label">Item Expiration</td>
						<td class="form_input"><input type="text" name="item_expiration" placeholder="20141019 (YYYYMMDD)" value="<?php echo $item_expiration; ?>" /></td>
					</tr><tr>
						<td class="form_label">Item Categories</td>
						<td class="form_input"><input type="text" name="item_categories" placeholder="category1, category2, category3" value="<?php echo $item_categories; ?>" /></td>
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
						<td class="form_input"><input type="Submit" value="Update Item" /></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>
</html>