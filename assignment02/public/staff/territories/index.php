<?php require_once('../../../private/initialize.php'); ?>

<?php $page_title = 'Staff: Territories'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="../index.php">Back to Menu</a><br />

  <h1>Tarritories</h1>

  <a href="new.php">Add a Territory</a><br />
  <br />

  <?php
    $territory_result = find_all_territories();

    echo "<table id=\"states\" style=\"width: 500px;\">";
    echo "<tr>";
    echo "<th>Name</th>";
    echo "<th>State ID</th>";
    echo "<th>Position</th>";
    echo "<th></th>";
    echo "</tr>";
    while($territory = db_fetch_assoc($territory_result)) {
      echo "<tr>";
      echo "<td>" . htmlspecialchars($territory['name']) . "</td>";
      echo "<td>" . htmlspecialchars($territory['state_id']) . "</td>";
      echo "<td>" . htmlspecialchars($territory['position']) . "</td>";
      echo "<td>";
      echo "<a href=\"show.php?id=".urlencode($territory['id'])."\">Show</a>";
      echo "</td>";
      echo "<td>";
      echo "<a href=\"edit.php?id=".urlencode($territory['id'])."\">Edit</a>";
      echo "</td>";
      echo "</tr>";
    } // end while $states
    db_free_result($territory_result);
    echo "</table>"; // #states
  ?>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
