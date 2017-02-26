<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])){
  redirect_to('index.php');
}else{
  $id = htmlspecialchars($_GET['id']);
}
$states_result = find_state_by_id($id);
// No loop, only one result
$state = db_fetch_assoc($states_result);

$errors = array();

if(is_post_request()) {


  if(isset($_POST['name'])) { $state['name'] = htmlspecialchars($_POST['name']); }
  if(isset($_POST['code'])) { $state['code'] = htmlspecialchars($_POST['code']); }
  if(isset($_POST['country_id'])) { $state['country_id'] = htmlspecialchars($_POST['country_id']); }

  $result = update_state($state);

  if($result === true) {
    redirect_to('show.php?id=' . urlencode($state['id']));
  } else {
    $errors = $result;
  }
}

?>
<?php $page_title = 'Staff: Edit State ' . htmlspecialchars($state['name']); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to States List</a><br />

  <h1>Edit State: <?php echo htmlspecialchars($state['name']); ?></h1>

  <!-- TODO add form -->
 <?php echo display_errors($errors); ?>
  <form action="edit.php?id=<?php echo htmlspecialchars($state['id']); ?>" method="post">
    Name:<br />
    <input type="text" name="name" value="<?php echo htmlspecialchars($state['name']); ?>" /><br />
    Code:<br />
    <input type="text" name="code" value="<?php echo htmlspecialchars($state['code']); ?>" /><br />
    Country id:<br />
    <input type="text" name="country_id" value="<?php echo htmlspecialchars($state['country_id']); ?>" /><br />
    <br />
    <input type="submit" name="submit" value="Update"  />
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
