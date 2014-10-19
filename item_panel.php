<?php
	$acc_type = "";
	if (isset($_SESSION['acc_type'])) {
		$acc_type = $_SESSION['acc_type'];
	}

	$item_id = $r['item_id'];
	$item_name = nl2br(htmlentities($r['item_name']));
	$item_price = nl2br(htmlentities($r['item_price']));
	$item_description = nl2br(htmlentities($r['item_description']));
	$item_categories = nl2br(htmlentities($r['item_categories']));
	$item_expiration = nl2br(htmlentities($r['item_expiration']));

	$acc_id = $r['acc_id'];
	$item_org = get_one("SELECT `org_name` FROM orgs WHERE acc_id='$acc_id'")['org_name'];

	$thumb = "images/thumb_$item_id.jpg";
	if (!file_exists($thumb)) {
		$thumb = "images/thumb_default.jpg";
	}
?>

<table>
	<tr>
		<td class="item_thumb">
			<img src="<?php echo $thumb; ?>" width=200>
		</td>
		<td class="item_content">
			<div class="item_panel_head">
				<span class="item_panel_name">
					<?php echo $item_name; ?>
				</span>
				<span class="item_panel_org">
					<?php echo $item_org; ?>
				</span>
				<span class="item_panel_price">
					Php <?php echo $item_price; ?>.00
				</span>
			</div>
			<div class="item_panel_body">
				<span class="item_panel_description">
					<?php echo $item_description; ?>
				</span>
			</div>
			<div class="item_panel_footer">
				<span class="item_panel_categories">
					<?php echo $item_categories; ?>
				</span>
				<span class="item_panel_expiration">
					Available until <?php echo $item_expiration; ?>
				</span>
				<span class="item_panel_buttons">
					<?php
						if ($acc_type == "user") {
					?>
					<span class="item_panel_button">
						<a href="purchase.php?id=<?php echo $item_id; ?>">Purchase</a>
					</span>
					<?php
						}
					?>
					<?php
						if ($acc_type == "org" AND isset($_SESSION['acc_id']) AND $acc_id == $_SESSION['acc_id']) {
					?>
					<span class="item_panel_button">
						<a href="edit.php?id=<?php echo $item_id; ?>">Edit</a>
					</span>
					<span class="item_panel_button">
						<a href="view_orders.php?id=<?php echo $item_id; ?>">View Orders</a>
					</span>
					<span class="item_panel_button">
						<a href="remove.php?id=<?php echo $item_id; ?>">Remove</a>
					</span>
					<?php
						}
					?>
				</span>
			</div>
		</td>
	</tr>
</table>