<?php
	$item_id = $row['item_id'];
	$item_name = nl2br(htmlentities($row['item_name']));
	$item_price = nl2br(htmlentities($row['item_price']));
	$item_description = nl2br(htmlentities($row['item_description']));
	$item_categories = nl2br(htmlentities($row['item_categories']));
	$item_expiration = nl2br(htmlentities($row['item_expiration']));

	$acc_id = $row['acc_id'];
	$item_org = get_one("SELECT `org_name` FROM orgs WHERE acc_id='$acc_id'")['org_name'];

	$thumb = "images/thumb_$item_id.jpg";
	if (!file_exists($thumb)) {
		$thumb = "images/thumb_default.jpg";
	}

	$pic = "images/pic_$item_id.jpg";
	if (!file_exists($pic)) {
		$pic = "images/pic_default.jpg";
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
				<span class="item_pic">
					<img src="<?php echo $pic; ?>">
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