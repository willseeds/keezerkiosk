<?php

/**
  * Delete a beer without a warning
  */

  require "../../../globals.php";
  require "../../../keezerdb.php";
  require "../../../common.php";

if (isset($_GET["id"])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $id = $_GET["id"];

    // without warning, it does what you think it does
    // maybe in the future, ill put a prompt, but then
    // again, thats why it should be behind a passwd. 
    $sql = "DELETE FROM beers WHERE id = :id";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

try {
  $connection = new PDO($dsn, $username, $password, $options);

  // if no selection to delete, show the beer list
  $sql = "SELECT * FROM beers order by datebrewed DESC";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
      
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>

<?php include "header.php"; ?>

<br/>
<div style="text-align:center;">
<table cellpadding="3" cellspacing="1"  style="box-sizing: border-box; vertical-align: bottom; position:relative; display: inline-table; width:90%; height:450px; background:none; border: 1px solid; table-layout: fixed; ">
	<tr>
	<td width="100%" height="450px" style="vertical-align: top; overflow:hidden; ">
    <div style="text-align:center;">
<span>

<h2>Delete a beer</h2>
<div style="text-align:center;">

<div style="text-align:center;">
<table align="center">
  <thead>
    <tr>
    <tr>
      <th>Beer Name</th>
      <th>&nbsp</th>
      <th>Date Brewed</th>
      <th>&nbsp</th>
      <th>Date Kegged</th>
      <th>&nbsp</th>
      <th>Date Kicked</th>
      <th>&nbsp</th>
      <th>Delete</th>
    </tr>
    </tr>
  </thead>
  <tbody>

    <?php foreach ($result as $row) : ?>
      <tr>
        <td><?php echo escape($row["beername"]); ?></td>
        <td>&nbsp</td>
        <td><?php echo escape($row["datebrewed"]); ?></td>
        <td>&nbsp</td>
        <td><?php echo escape($row["datekegged"]); ?></td>
        <td>&nbsp</td>
        <td><?php echo escape($row["datekicked"]); ?></td>
        <td>&nbsp</td>
	<?php // placeholder for javascript prompt warning in future ?>
      <td><a href="delete.php?id=<?php echo escape($row["id"]); ?>">Delete</a></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<br/>
<a href="index.php">Back to admin home</a>

</span><br/><br/>
    </div>
		</td>
	</tr>
</table>

<?php include "footer.php"; ?>