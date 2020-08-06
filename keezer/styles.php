
<?php

/**
  * List all users with a link to edit
  */

try {
  //db connections
  require "../../globals.php";
  require "../../keezerdb.php";
  require "../../common.php";

  $connection = new PDO($dsn, $username, $password, $options);

  // this is for users to understand what styles may be on tap
  // for other styles, you can use decimals or revise what was 
  // provided. not many visitor users will understand the sours
  // imperial what-whos-its and such, so keeping it simple
  $sql = "SELECT * FROM stylelist order by stylecolor ASC";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>

<?php require "header.php"; ?>

<div style="text-align:center;">
<table cellpadding="3" cellspacing="1"  style="box-sizing: border-box; vertical-align: bottom; position:relative; display: inline-table; width:90%; background:none; border: 1px solid; table-layout: fixed; ">
	<tr>
		<td width="100%" height="438px" style="vertical-align: top; overflow:hidden; ">
<div style="text-align:center;">

<h2>Which beer style to select?</h2>

<table cellpadding="3" cellspacing="1"  style="box-sizing: border-box; vertical-align: bottom; position:relative; display: inline-table; width:90%; height:228px; border: 1px solid; table-layout: fixed; ">
<tr>
  <thead>
    <tr>
      <td>&nbsp</td>
      <th>Style Name (#)</th>
      <th>Style Color No.</th>
      <th>IBU Range</th>
      <th>Style Comments</th>
      <th>&nbsp</th>
    </tr>
  </thead>
   <tbody>
<?php foreach ($result as $row) : ?>
      <td>&nbsp</td>
      <?php 
	// this is a simple query result to show
	// users how to implement new functions
	// while allowing some browsing content 
	// for visitors. 
      ?>	
      <td><center><a href="styletypes.php?stylecolor=<?php echo escape($row["stylecolor"]); ?>"><?php echo escape($row["stylename"]); ?><br/>(<?php echo escape($row["stylecolor"]); ?>)</a></center></td>
      <td style="vertical-align: center; background-color:#<?php echo escape($row["htmlcolor"]); ?>; "></td>
      <td><center><?php echo escape($row["iburange"]); ?></center></td>
      <td><?php echo escape($row["stylecomment"]); ?></td>
      <th>&nbsp</th></tr>
      <?php endforeach; ?>
      <td>&nbsp</td>
   </tbody>
</table>
<br/><br/>
</table>  
</div>

<?php require "footer.php"; ?>
