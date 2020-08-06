<?php

/**
  * this pape is for just a tv application,
  * just in case you want people too see with
  * their eyes and not their hands.
  *
  * removed header, footer and combined
  * code in one page with no links, along
  * with a 10 min timer on the page refresh
  * for the temp sensor to get updated.
  */

try {
  //db connections
  require "../../globals.php";
  require "../../keezerdb.php";
  require "../../common.php";

  $connection = new PDO($dsn, $username, $password, $options);

  // SQL statement to get on-tap beers - ones that are not
  // kicked or kegged yet. do not use * for this as it will
  // affect the counting of $i, which is the users tap count
  $sql = "SELECT tapno,beername,abv,stylename,ibu,comments,id FROM beers WHERE 
  datekicked = '0000-00-00' && 
  datekegged != '0000-00-00'
  order by tapno ASC";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchall(PDO::FETCH_ASSOC);

} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome to <?php echo ($sitename); ?></title>
	<link rel="stylesheet" type="text/css" href="<?=($color); ?>.css">

	<?php // specific header refresh every 10min for temp ?>
	<meta http-equiv="refresh" content="600">
</head>

<body padding:0;  margin: 0; >
<br/>
<div style="text-align:center;">
<b>
      <span style="font-size:26pt; "><?php echo ($sitename); ?>
      <span style="font-size:24pt align="right"; ">

<?php // these variables come from the globals.php page ?>
<?php
if ($temperature) {
    echo "   --   ${temp}&deg";
} else {
    echo "\n";
}
?></span></div></b>

<div style="text-align:center;">

<table cellpadding="3" cellspacing="1" style="box-sizing: border-box; valign: top; position:relative; display: inline-table; width:90%; border: 1px solid; table-layout: fixed; ">
<h2></h2>

	<tr>
	<?php
	//Start with one tap
	$i= "1";
	
	//loop through based on global tap quantity 
	while($i <= $tapcount) {

	//Loop until all qty of taps can be selected
	?>

	<td>
	<div style="text-align:center; font-size:18pt; ">
       	Tap #<?=$i;?><br/>
       	</div>

        <div style="text-align:center;">
	  <span style="font-size:12pt; ">
		<?php 
		foreach ($result as $row) :
		  if ($row["tapno"] != $i) {
		    // keep this to nothing or other items
		    // in the array will match it and duplicate
		    echo "";
		  } else {
			// just add fields as needed below to show in tap list
			// if more area is desired for more taps, remove the
			// comments echo escape row
			echo "<b>";
			echo escape($row["beername"]);
			echo "</b><br/>";
		    	echo "ABV %: ";echo escape($row["abv"]);echo " -- IBU: ";echo escape($row["ibu"]);
			echo "<br/>";
			echo "<br/>";
		    	echo "Style Name: <br/>";echo escape($row["stylename"]);
			echo "<br/>";
			echo "<br/>";
		    	echo "Comments: <br/>";echo escape($row["comments"]);
			echo "<br/>";
		}
		endforeach;
		?>
	  </span>
        </div>

	</td>
	<?php
	//not require updates outside of global
	$i++;
	}
	?>
	</tr>

</table>

</div>
<br/>
<div style="text-align:center;">
	<?php // these variables come from the globals.php page ?>
	<?php echo ($sitename); ?> -- V:<a href="./admin/"><?php echo ($version); ?></a><br/>
</div>
<br/>
</body>
</html>
