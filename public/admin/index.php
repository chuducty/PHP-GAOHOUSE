<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>

<?php include_layout_template('admin_header.php'); ?>

	<h2>Menu</h2>
	<ul>
		<li><a href="list_photos.php">View Photos</a></li>
		<li><a href="logout.php">Logout</a></li>
	</ul>

<?php include_layout_template('admin_footer.php'); ?>
		