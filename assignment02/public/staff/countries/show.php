<?php require_once('../../../private/initialize.php'); ?>

<?php
if(!isset($_GET['id'])) {
  redirect_to('index.php');
}
$id = htmlspecialchars($_GET['id']);
$country_result = find_country_by_id($id);
// No loop, only one result
$country = db_fetch_assoc($country_result);
?>

<?php $page_title = 'Staff: country of ' . htmlspecialchars($country['name']); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to Countries List</a><br />

  <h1>Country: <?php echo htmlspecialchars($country['name']); ?></h1>

  <?php
    echo "<table id=\"country\">";
    echo "<tr>";
    echo "<td>Name: </td>";
    echo "<td>" . htmlspecialchars($country['name']) . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Code: </td>";
    echo "<td>" . htmlspecialchars($country['code']) . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Country ID: </td>";
    echo "<td>" . htmlspecialchars($country['id']) . "</td>";
    echo "</tr>";
    echo "</table>";
?>
    <br />
    <a href="edit.php?id=<?php echo urlencode($country['id']); ?>">Edit</a><br />
    <hr />

    <h2>States</h2>
    <br />
    <a href="../states/new.php?id=<?php echo urlencode($country['id']); ?>">Add a State</a><br />

<?php
    $state_result = find_states_for_country_id(htmlspecialchars($country['id']));

    echo "<ul id=\"states\">";
    while($state = db_fetch_assoc($state_result)) {
      echo "<li>";
      echo "<a href=\"../states/show.php?id=" .urlencode($state['id'])."\">";
      echo htmlspecialchars($state['name']);
      echo "</a>";
      echo "</li>";
    } // end while $states
    db_free_result($state_result);
    echo "</ul>"; // #states

    db_free_result($country_result);
  ?>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
