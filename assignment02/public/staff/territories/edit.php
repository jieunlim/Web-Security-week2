<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}else{
  $id = htmlspecialchars($_GET['id']);
}
$territories_result = find_territory_by_id($id);
// No loop, only one result
$territory = db_fetch_assoc($territories_result);

$errors = array();

if(is_post_request()) {


  if(isset($_POST['name'])) { $territory['name'] = htmlspecialchars($_POST['name']); }
  if(isset($_POST['state_id'])) { $territory['state_id'] = htmlspecialchars($_POST['state_id']); }
  if(isset($_POST['position'])) { $territory['position'] = htmlspecialchars($_POST['position']); }

  $result = update_territory($territory);

  if($result === true) {
    redirect_to('show.php?id=' . urlencode($territory['id']));
  } else {
    $errors = $result;
  }
}
?>
<?php $page_title = 'Staff: Edit Territory ' . htmlspecialchars($territory['name']); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="../states/show.php?id=<?php echo urlencode($_GET['id']); ?> ">Back to State Details</a><br />

  <h1>Edit Territory: <?php echo htmlspecialchars($territory['name']); ?></h1>

  <!-- TODO add form -->
  <?php echo display_errors($errors); ?>
  <form action="edit.php?id=<?php echo urlencode($territory['id']); ?>" method="post">
    Name:<br />
    <input type="text" name="name" value="<?php echo htmlspecialchars($territory['name']); ?>" /><br />
    Position:<br />
    <input type="text" name="position" value="<?php echo htmlspecialchars($territory['position']); ?>" /><br />
    <!--Hidden State Id: -->
    <input type="hidden" name="state_id" value="<?php echo htmlspecialchars($territory['state_id']); ?>" /><br />
    <br />
    <input type="submit" name="submit" value="Update"  />
  </form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
