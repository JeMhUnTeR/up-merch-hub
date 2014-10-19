<div id="logowrap">
	<img src="images/logo.png" height=50>
</div>
<div id="navwrap">
	<?php
		foreach ($menuitems as $menuitem) {
	?>
	<a href="<?php echo $menuitem[1]; ?>" class="navitem">
		<?php echo $menuitem[0]; ?>
	</a>
	<?php
		}
	?>
</div>