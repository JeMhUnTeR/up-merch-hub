<?php
	session_start();
	include_once("common.php");

	if (!isset($_SESSION['acc_type'])) {
		header("Location: loginpage.php?err=You%20must%20be%20logged%20in%20to%20view%20this%20page.");
		die("Redirecting...");
	} else if ($_SESSION['acc_type'] != "user") {
		header("Location: index.php");
		die("Redirecting...");
	} else {
		$acc_id = $_SESSION['acc_id'];
		$name = $_SESSION['first_name'] . " " . $_SESSION['last_name'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Orders | UP Merchandise Hub</title>
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
				<?php echo $name; ?>
			</span>
			<span class="crumb level2">
				All Orders
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
			<div id="filter_panel">
				<form action="" method="POST" id="filter_form">
					<table>
						<tr>
							<td class="form_label">Search Query</td>
							<td class="form_input"><input type="text" name="search_query" placeholder="Search..." value="<?php if (isset($_POST['search_query'])) { echo $_POST['search_query']; } ?>" /></td>
						</tr><tr>
							<td class="form_label">Sort By</td>
							<td class="form_input">
								<select name="sort_by">
									<option value="item_name" <?php if(isset($_POST['sort_by']) AND $_POST['sort_by'] == "item_name") { echo "selected"; } ?>>Item Name</option>
									<option value="item_price" <?php if(isset($_POST['sort_by']) AND $_POST['sort_by'] == "item_price") { echo "selected"; } ?>>Item Price</option>
									<option value="item_expiration" <?php if(isset($_POST['sort_by']) AND $_POST['sort_by'] == "item_expiration") { echo "selected"; } ?>>Item Expiration</option>
									<option value="org_name" <?php if(isset($_POST['sort_by']) AND $_POST['sort_by'] == "org_name") { echo "selected"; } ?>>Organization</option>
								</select>
							</td>
						</tr>
					</table>
					<table>
						<tr>
							<td class="form_input"><input type="Submit" value="Filter List" /></td>
						</tr>
					</table>
				</form>
			</div>
			<?php
				$s = "";
				if (isset($_POST['search_query'])) {
					$s = $_POST['search_query'];
				}
				$o = "item_name";
				if (isset($_POST['sort_by'])) {
					$o = $_POST['sort_by'];
				}
				// $itemlist = get("SELECT DISTINCT I.item_id, I.item_name, I.item_expiration, I.item_categories, O.order_quantity, O.order_specs, K.org_name, I.item_price*O.order_quantity FROM items I, orders O, orgs K HAVING(SELECT (POSITION('$s' in I.item_name) OR POSITION('$s' in I.item_categories) OR POSITION('$s' in I.item_expiration) OR POSITION('$s' in O.order_quantity) OR POSITION('$s' in O.order_specs) OR POSITION('$s' in K.org_name) OR POSITION('$s' in (I.item_price*O.order_quantity))) AND O.acc_id='$acc_id')");
				$itemlist = get("SELECT * FROM `orders` WHERE `acc_id`='$acc_id'");
				while ($r = mysql_fetch_assoc($itemlist)) {
					$item_id = $r['item_id'];
					$i = get_one("SELECT * FROM items WHERE `item_id`='$item_id'");

					$acc_id = $i['acc_id'];
					$item_org = get_one("SELECT `org_name` FROM orgs WHERE acc_id='$acc_id'")['org_name'];

					$src_str = $r['order_quantity'] . $r['order_specs'] . $i['item_name'] . $i['item_categories'] . $i['item_expiration'] . $item_org;
					$src_str .= $r['order_quantity'] * $i['item_price'];
					if ($s == "" OR strpos(strtolower($src_str), strtolower($s)) !== false) {
			?>
					<div class="item_panel">
						<?php include("order_panel.php"); ?>
					</div>
			<?php
					}
				}
			?>
		</div>
	</div>
</body>
</html>