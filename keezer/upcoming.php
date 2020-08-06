<?php

/**
  * show upcoming beers
  * you have to plan in advance for this functionality
  */

try {
  // db connections
  require "../../globals.php";
  require "../../keezerdb.php";
  require "../../common.php";

  $connection = new PDO($dsn, $username, $password, $options);

  // select all beers where date brewed is in future from today
  // this means that you may be planning beers for users to look
  // forward to seeing, but the date brewed date is in future
  $sql = "SELECT * FROM beers WHERE datebrewed >= DATE(NOW()) order by datebrewed ASC";

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

<h2>Upcoming Beers</h2>

<table cellpadding="3" cellspacing="1"  style="box-sizing: border-box; vertical-align: bottom; position:relative; display: inline-table; width:90%;  border: 1px solid; table-layout: fixed; ">
<tr>
  <thead>
    <tr>
      <th>Beer Name</th>
      <th>Estimated Brew Day</th>
      <th>Comments</th>
      <th>Style Name</th>
    </tr>
  </thead>
   <tbody>
    <tr>
     <?php foreach ($result as $row) : ?>
        <td><a href="beer-detail.php?id=<?php echo escape($row["id"]); ?>"><?php echo escape($row["beername"]); ?></a></td>
        <td><?php echo escape($row["datebrewed"]); ?></td>
        <td><?php echo escape($row["comments"]); ?></td>
        <td><?php echo escape($row["stylename"]); ?></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>
		</td>
	</tr>
</table>   
</center>
   </div>

<?php include "footer.php"; ?>