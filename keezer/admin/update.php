<?php

/**
  * List all users with a link to edit
  */

try {
  require "../../../globals.php";
  require "../../../keezerdb.php";
  require "../../../common.php";

  $connection = new PDO($dsn, $username, $password, $options);

  // select all beers by order assumed to be date brewed 
  // most recent on the top
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

<h2>Update a beer</h2>

<div style="text-align:center;">
<table align="center">
  <thead>
    <tr>
      <th>Beer Name</th>
      <th>&nbsp</th>
      <th>Date Brewed</th>
      <th>&nbsp</th>
      <th>Date Kegged (Tap#)</th>
      <th>&nbsp</th>
      <th>Date Kicked</th>
      <th>&nbsp</th>
      <th>Edit</th>
    </tr>
  </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
      <tr>
        <td><?php echo escape($row["beername"]); ?></td>
        <td>&nbsp</td>
        <td><?php echo escape($row["datebrewed"]); ?></td>
        <td>&nbsp</td>
        <td><?php echo escape($row["datekegged"]); ?> (#<?php echo escape($row["tapno"]); ?>)</td>
        <td>&nbsp</td>
        <td><?php echo escape($row["datekicked"]); ?></td>
        <td>&nbsp</td>
        <td><a href="update-beer.php?id=<?php echo escape($row["id"]); ?>">Edit</a></td>
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
