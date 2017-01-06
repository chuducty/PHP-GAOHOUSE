<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // Find all the photos
  // 1. the current page number ($current_page)
    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

    // 2. records per page ($per_page)
    $per_page = 9;

    // 3. total record count ($total_count)
    $total_count = User::count_all();
    

    // Find all photos
    // use pagination instead
    //$photos = Photograph::find_all();
    
    $pagination = new Pagination($page, $per_page, $total_count);
    
    // Instead of finding all records, just find the records 
    // for this page
    $sql = "SELECT * FROM users ";
    $sql .= "ORDER BY id DESC ";
    $sql .= "LIMIT {$per_page} ";
    $sql .= "OFFSET {$pagination->offset()}";

    $users = User::find_by_sql($sql);

?>
<?php include_layout_template('admin_header.php'); ?>

<h2>Photographs</h2>
<?php echo output_message($message); ?>
<a href="signup.php">Upload a new User</a>
<br>
<table class="bordered">
  <tr>
    <th>Username</th>
    
    <th>Firstname</th>
    <th>Last name</th>
    
  </tr>
<?php foreach($users as $user): ?>
  <tr>
    
    <td><?php echo $user->username; ?></td>
    <td><?php echo $user->first_name; ?></td>
    <td><?php echo $user->last_name; ?></td>
    
    <td><a href="delete_user.php?id=<?php echo $user->id; ?>">Delete</a></td>
  </tr>
<?php endforeach; ?>
</table>
<div id="pagination" style="clear: both;">
<?php
  if($pagination->total_pages() > 1) {
    
    if($pagination->has_previous_page()) { 
      echo "<a href=\"list_photos.php?page=";
      echo $pagination->previous_page();
      echo "\">&laquo; Previous</a> "; 
    }

    for($i=1; $i <= $pagination->total_pages(); $i++) {
      if($i == $page) {
        echo " <span class=\"selected\">{$i}</span> ";
      } else {
        echo " <a href=\"list_users.php?page={$i}\">{$i}</a> "; 
      }
    }

    if($pagination->has_next_page()) { 
      echo " <a href=\"list_users.php?page=";
      echo $pagination->next_page();
      echo "\">Next &raquo;</a> "; 
    }
    
  }

?>
</div>


<?php include_layout_template('admin_footer.php'); ?>
