<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])){
  redirect_to('index.php');
}else{
  $id = htmlspecialchars($_GET['id']);
}
$countries_result = find_country_by_id($id);
// No loop, only one result
$country = db_fetch_assoc($countries_result);

$errors = array();

if(is_post_request()) {


  if(isset($_POST['name'])) { $country['name'] = htmlspecialchars($_POST['name']); }
  if(isset($_POST['code'])) { $country['code'] = htmlspecialchars($_POST['code']); }

  $result = update_country($country);

  if($result === true) {
    redirect_to('show.php?id=' . urlencode($country['id']));
  } else {
    $errors = $result;
  }
}

?>
<?php $page_title = 'Staff: Edit Country ' . htmlspecialchars($country['name']); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to Counturies List</a><br />

  <h1>Edit Country: <?php echo htmlspecialchars($country['name']); ?></h1>
  <?php echo display_errors($errors); ?>

  <!-- TODO add form -->
  <form action="edit.php?id=<?php echo urlencode($country['id']); ?>" method="post">
    Name:<br />
    <input type="text" name="name" value="<?php echo htmlspecialchars($country['name']); ?>" /><br />
    Code:<br />
    <input type="text" name="code" value="<?php echo htmlspecialchars($country['code']); ?>" /><br />

    <br />
    <input type="submit" name="submit" value="Update"  />
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
