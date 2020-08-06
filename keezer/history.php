<?php

/**
  * List all beers that haven't kicked yet
  */

try {
  require "../../globals.php";
  require "../../keezerdb.php";
  require "../../common.php";

  $connection = new PDO($dsn, $username, $password, $options);

  // select history of all where the date kicked is not equal to zero
  $sql = "SELECT * FROM beers WHERE datekicked != '0000-00-00' order by datebrewed DESC";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();

} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>

<?php include "header.php"; ?>

<div style="text-align:center;">
<table cellpadding="3" cellspacing="1"  style="box-sizing: border-box; vertical-align: bottom; position:relative; display: inline-table; width:90%; background:none; border: 1px solid; table-layout: fixed; ">
	<tr>
		<td width="100%" height="438px" style="vertical-align: top; overflow:hidden; ">
<div style="text-align:center;">

<h2>Beer History</h2>

<table cellpadding="3" cellspacing="1"  style="box-sizing: border-box; vertical-align: bottom; position:relative; display: inline-table; width:90%; height:228px; border: 1px solid; table-layout: fixed; ">
<tr>
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
    <tr>
     <?php 
	// adjust these rows and results for available space
	// the comments being removed can gain a lot of space
	// but make sure to echo a row or &nbsp
    ?>
     <?php foreach ($result as $row) : ?>
        <td><a href="beer-detail.php?id=<?php echo escape($row["id"]); ?>"><?php echo escape($row["beername"]); ?></a></td>
        <td><?php echo escape($row["abv"]); ?></td>
        <td><?php echo escape($row["comments"]); ?></td>
        <td><?php echo escape($row["datebrewed"]); ?></td>
        <td><?php echo escape($row["stylename"]); ?></td>
      </tr>
    <?php endforeach; ?>
      <td>&nbsp</td>
   </tbody>
</table>
<br/><br/>
</table>  
</div>

<?php require "footer.php"; ?>
