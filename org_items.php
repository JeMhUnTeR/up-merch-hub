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
	<title>Org Merchandise | UP Merchandise Hub</title>
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
				All Merchandise
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
				$itemlist = get("SELECT * FROM items NATURAL JOIN orgs HAVING (SELECT (POSITION('$s' in item_name) OR POSITION('$s' in item_description) OR POSITION('$s' in item_price) OR POSITION('$s' in item_categories) OR POSITION('$s' in org_name)) AND acc_id='$acc_id') ORDER BY `$o`, `item_name`");
				while ($r = mysql_fetch_assoc($itemlist)) {
			?>
				<div class="item_panel">
					<?php include("item_panel.php"); ?>
				</div>
			<?php
				}
			?>
		</div>
	</div>
</body>
</html>