<?php

/**
  * Function to query information based on
  * a parameter: in this case, location.
  *
  */

if (isset($_GET['stylecolor'])) {
  try {
  //db connections
  require "../../globals.php";
  require "../../keezerdb.php";
  require "../../common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT *
    FROM beers
    WHERE stylecolor = :stylecolor";

    $stylecolor = $_GET['stylecolor'];

    $statement = $connection->prepare($sql);
    $statement->bindParam(':stylecolor', $stylecolor, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>

<?php include "header.php"; ?>

<div style="text-align:center;">
<table cellpadding="3" cellspacing="1"  style="box-sizing: border-box; vertical-align: bottom; position:relative; display: inline-table; width:90%; background:none; border: 1px solid; table-layout: fixed; ">
	<tr>
		<td width="100%" height="438px" style="vertical-align: top; overflow:hidden; ">
<div style="text-align:center;">

<h2>History for Style #<?php echo escape($_GET['stylecolor']); ?></h2>

<table cellpadding="3" cellspacing="1"  style="box-sizing: border-box; vertical-align: bottom; position:relative; display: inline-table; width:90%; border: 1px solid; table-layout: fixed; ">
<tr>

<?php
if (isset($_GET['stylecolor'])) {
  if ($result && $statement->rowCount() > 0) { ?>
      <thead>
    <tr>
      <th>Beer Name</th>
      <th>ABV</th>
      <th>Comments</th>
      <th>Date Brewed</th>
      <th>Style Name</th>
    </tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
        <td><a href="beer-detail.php?id=<?php echo escape($row["id"]); ?>"><?php echo escape($row["beername"]); ?></a></td>
        <td><?php echo escape($row["abv"]); ?></td>
        <td><?php echo escape($row["comments"]); ?></td>
        <td><?php echo escape($row["datebrewed"]); ?></td>
        <td><?php echo escape($row["stylename"]); ?></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    <br/><br/>> No beers found for Style Color #<?php echo escape($_GET['stylecolor']); ?>.<br/><br/>
  <?php }
} ?>
<br/><br/>

<a href="styles.php">Back to Style list</a>

<br/><br/>
</table>  
</div>

<?php require "footer.php"; ?>
