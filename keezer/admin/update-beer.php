<?php
/**
  * Use an HTML form to edit an entry in the
  * beer table.
  */

  require "../../../globals.php";
  require "../../../keezerdb.php";
  require "../../../common.php";;

if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $beer =[
      "id"          => $_POST['id'],
      "beername"    => $_POST['beername'],
      "abv"         => $_POST['abv'],
      "datebrewed"  => $_POST['datebrewed'],
      "ibu"         => $_POST['ibu'],
      "comments"    => $_POST['comments'],
      "stylename"   => $_POST['stylename'],
      "stylecolor"  => $_POST['stylecolor'],
      "datekegged"  => $_POST['datekegged'],
      "datekicked"  => $_POST['datekicked'],
      "tapno"       => $_POST['tapno']
    ];

    $sql = "UPDATE beers
            SET id = :id,
              beername = :beername,
              abv = :abv,
              datebrewed = :datebrewed,
              ibu = :ibu,
              comments = :comments,
              stylename = :stylename,
              stylecolor = :stylecolor,
              datekegged = :datekegged,
              datekicked = :datekicked,
              tapno = :tapno
            WHERE id = :id";

  $statement = $connection->prepare($sql);
  $statement->execute($beer);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}

if (isset($_GET['id'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];

    $sql = "SELECT * FROM beers WHERE id = :id";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $beer = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
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

<h2>Edit a beer</h2>
<br/>

<?php if (isset($_POST['submit']) && $statement) : ?>
  <i><?php echo escape($_POST['beername']); ?> successfully updated.</i><br/>
<?php endif; ?>

<form method="post">
    <?php foreach ($beer as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label><br/>
      <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?> <?php echo ($key === 'tapno' ? 'readonly' : null); ?>><br/><br/><?php $tap= ($key === 'tapno' ? $value : $value); ?>
    <?php endforeach; ?>
  <label for="tapno">Change Tap:</label><br/>
  <select name="tapno" >
	<?php
	// lock the tap number above as read only
	// the allow the taps below to lock user input

	// Start with one tap
	$i= "0";

	//loop through based on global tap quantity 
	while($i <= $tapcount) {

		  if ($tap != $i) {
		    // keep this to nothing or other items
		    // in the array will match it and duplicate
		    $s = "";
		   } else {
		    $s = "selected ";
		}
	// Print numbers and loop until all qty of taps can be selected
	?>
         <option value="<?=$i;?>" <?=$s;?>>Tap #<?=$i;?></option>
   <?php
   // not require updates outside of global
   $i++;
  }
  ?>
   </select>

<br/><br/>
    <input type="submit" name="submit" value="Submit">
</form>
<br/>
<a href="index.php">Back to admin home</a>
<br/><br/>
</span>
    </div>
		</td>
	</tr>
</table>

<?php include "footer.php"; ?>
