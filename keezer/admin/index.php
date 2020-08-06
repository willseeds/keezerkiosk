<?php

/**
  * List all users with a link to edit
  */

try {
  require "../../../globals.php";
  require "../../../keezerdb.php";
  require "../../../common.php";

  $connection = new PDO($dsn, $username, $password, $options);

  // just show all the beers by order of date kegged
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
<table cellpadding="3" cellspacing="1"  style="box-sizing: border-box; vertical-align: bottom; position:relative; display: inline-table; width:90%; background:none; border: 1px solid; table-layout: fixed; ">
	<tr>
	<td width="100%" style="vertical-align: top; overflow:hidden; ">
    <div style="text-align:center;">
<span>

<h2>Beer Admin Home</h2>

<table>
  <thead>
    <tr>
      <th>&nbsp</th>
      <th>&nbsp</th>
      <th>Beer Name</th>
      <th>Date Brewed</th>
      <th>Date Kegged</th>
      <th>Comments</th>
      <th>Style Name</th>
      <th>&nbsp</th>
      <th>&nbsp</th>
    </tr>
  </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
      <tr>
        <td>&nbsp</td>
        <td>&nbsp</td>
        <td><a href="update-beer.php?id=<?php echo escape($row["id"]); ?>"><?php echo escape($row["beername"]); ?></a></td>
        <td><?php echo escape($row["datebrewed"]); ?></td>
        <td><?php echo escape($row["datekegged"]); ?></td>
        <td><?php echo escape($row["comments"]); ?></td>
        <td><?php echo escape($row["stylename"]); ?></td>
        <td>&nbsp</td>
        <td>&nbsp</td>
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<br/>
</span>
    </div>
		</td>
	</tr>
</table>

<?php include "footer.php"; ?>
