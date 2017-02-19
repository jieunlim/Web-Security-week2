<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}else{
  $id = htmlspecialchars($_GET['id']);
}
$users_result = find_user_by_id($id);
// No loop, only one result
$user = db_fetch_assoc($users_result);

// Set default values for all variables the page needs.
$errors = array();

if(is_post_request()) {

  // Confirm that values are present before accessing them.
  if(isset($_POST['first_name'])) { $user['first_name'] = htmlspecialchars($_POST['first_name']); }
  if(isset($_POST['last_name'])) { $user['last_name'] = htmlspecialchars($_POST['last_name']); }
  if(isset($_POST['username'])) { $user['username'] = htmlspecialchars($_POST['username']); }
  if(isset($_POST['email'])) { $user['email'] = htmlspecialchars($_POST['email']); }

  if(isset($_POST['update'])){
    $result = update_user($user);
    if($result === true) {
      redirect_to('show.php?id=' . urlencode($user['id']));
    } else {
      $errors = $result;
    }
  }else if(isset($_POST['delete'])){

      redirect_to('delete.php?id=' . urlencode($user['id']));
    } else {
      $errors = 'here error occured';
    }

}
?>
<?php $page_title = 'Staff: Edit User ' . htmlspecialchars($user['first_name']) . " " . htmlspecialchars($user['last_name']); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to Users List</a><br />

  <h1>Edit User: <?php echo htmlspecialchars($user['first_name']) . " " . htmlspecialchars($user['last_name']); ?></h1>

  <?php echo display_errors($errors); ?>

  <form action="edit.php?id=<?php echo urlencode($user['id']); ?>" method="post">
    First name:<br />
    <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" /><br />
    Last name:<br />
    <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" /><br />
    Username:<br />
    <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" /><br />
    Email:<br />
    <input type="text" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" /><br />
    <br />
    <input type="submit" name="update" value="Update" style="width:70px"  />
    <input type="submit" name="delete" value="Delete" style="width:70px; margin:10px;" />
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
