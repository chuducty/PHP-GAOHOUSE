<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>

<?php include_layout_template('admin_header.php'); ?>

<?php
	$user = User::find_by_id(2);
	$user->password = "1234CCCCC";
	$user->save();
?>

<?php include_layout_template('admin_footer.php'); ?>
		
