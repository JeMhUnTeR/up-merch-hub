<?php
	$acc_type = "";
	if (isset($_SESSION['acc_type'])) {
		$acc_type = $_SESSION['acc_type'];
	}

	$item_name = nl2br(htmlentities($i['item_name']));
	$order_quantity = $r['order_quantity'];
	$item_price = $i['item_price'];
	$order_specs = nl2br(htmlentities($r['order_specs']));
	$item_categories = nl2br(htmlentities($i['item_categories']));
	$item_expiration = nl2br(htmlentities($i['item_expiration']));

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
					<?php echo $item_categories; ?>
				</span>
				<span class="item_panel_expiration">
					Available until <?php echo $item_expiration; ?>
				</span>
			</div>
		</td>
	</tr>
</table>