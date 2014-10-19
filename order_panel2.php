<?php
	$acc_type = "";
	if (isset($_SESSION['acc_type'])) {
		$acc_type = $_SESSION['acc_type'];
	}

	$item_id = $r['item_id'];
	$acc_id = $r['acc_id'];
	$i = get_one("SELECT * FROM items WHERE `item_id`='$item_id'");
	$a = get_one("SELECT * FROM accounts WHERE `acc_id`='$acc_id'");
	$u = get_one("SELECT * FROM users WHERE `acc_id`='$acc_id'");

	$user_name = nl2br(htmlentities($a['username']));
	$user_fullname = nl2br(htmlentities($u['first_name'] . " " . $u['last_name']));
	$order_quantity = $r['order_quantity'];
	$item_price = $i['item_price'];
	$order_specs = nl2br(htmlentities($r['order_specs']));
	$user_number = nl2br(htmlentities($u['number']));
	$user_email = nl2br(htmlentities($u['email']));

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
					<?php echo $user_fullname; ?>
				</span>
				<span class="item_panel_org">
					<?php echo $user_name; ?>
				</span>
				<span class="item_panel_price">
					Quantity: <?php echo $order_quantity; ?>; Php <?php echo $order_quantity * $item_price; ?>.00
				</span>
			</div>
			<div class="item_panel_body">
				<span class="item_panel_description">
					<?php echo $order_specs; ?>
				</span>
			</div>
			<div class="item_panel_footer">
				<span class="item_panel_categories">
					<?php echo $user_number; ?>
				</span>
				<span class="item_panel_expiration">
					<?php echo $user_email; ?>
				</span>
			</div>
		</td>
	</tr>
</table>