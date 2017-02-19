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

  $result = delete_user($user);
  if($result === true) {
    redirect_to('index.php');
  } else {
    echo "Delete error occured";
  }
}
?>
<?php $page_title = 'Staff: Delete User ' . htmlspecialchars($user['first_name']) . " " . htmlspecialchars($user['last_name']); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to Users List</a><br />

  <h1>Delete User: <?php echo htmlspecialchars($user['first_name']) . " " . htmlspecialchars($user['last_name']); ?></h1>
  <h3>Are you sure you want to permanently delete the user: </h3>

  <?php echo display_errors($errors); ?>

  <form action="delete.php?id=<?php echo urlencode($user['id']);?>" method="post">

    First name:<br />
    <input type="text" readonly="readonly" style="background-color:#bdc3c7" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" /><br />
    Last name:<br />
    <input type="text" readonly="readonly" style="background-color:#bdc3c7" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" /><br />
    Username:<br />
    <input type="text" readonly="readonly" style="background-color:#bdc3c7" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" /><br />
    Email:<br />
    <input type="text" readonly="readonly" style="background-color:#bdc3c7" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" /><br />
    <br />
    <input type="submit" name="submit" value="Delete"  />
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
