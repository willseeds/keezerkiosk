<?php

/**
  * List the beer detail info per the
  * selected GET variable.
  */

// variable used below
$getid = $_GET['id'];

try {
  //db connections
  require "../../globals.php";
  require "../../keezerdb.php";
  require "../../common.php";

  $connection = new PDO($dsn, $username, $password, $options);

  // SQL statement to fetch info based on GET variable
  $sql = "SELECT * FROM beers WHERE " . $getid . " = id";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchall(PDO::FETCH_ASSOC);

} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
  }


?>

<?php require "header.php"; ?>

<div style="text-align:center;">
<table cellpadding="3" cellspacing="1"  style="box-sizing: border-box; vertical-align: bottom; position:relative; display: inline-table; width:90%; background:none; border: 1px solid; table-layout: fixed; ">
	<tr>
		<td width="84%" height="500px" style="vertical-align: top; overflow:hidden; ">
  <div>
    <div style="text-align:center;">

<h2>Upcoming Beers</h2>

<table cellpadding="3" cellspacing="1"  style="box-sizing: border-box; vertical-align: bottom; position:relative; display: inline-table; width:90%;  border: 1px solid; table-layout: fixed; ">
<tr>
  <thead>
<?php foreach ($result as $row) : ?>
	<tr>
		<td width="25%" height="15px" style="vertical-align: top; overflow:hidden; ">
      <div>
        <span></span>
      </div>
		</td>
		<td width="25%" height="15px" style="vertical-align: top; overflow:hidden; ">
      <div>
        <span>Beer Name</span>
      </div>
		</td>
		<td width="25%" height="15px" style="vertical-align: top; overflow:hidden; ">
      <div>
        <span><?php echo escape($row["beername"]); ?></span>
      </div>
		</td>
		<td width="25%" height="15px" style="vertical-align: top; overflow:hidden; ">
      <div>
        <span></span>
      </div>
		</td>
	</tr>
	<tr>
		<td width="25%" height="15px" style="vertical-align: top; overflow:hidden; ">
      <div>
        <span></span>
      </div>
		</td>
		<td width="25%" height="15px" style="vertical-align: top; overflow:hidden; ">
      <div>
        <span></span>
      </div>
		</td>
		<td width="25%" height="15px" style="vertical-align: top; overflow:hidden; ">
      <div>
        <span></span>
      </div>
		</td>
		<td width="25%" height="15px" style="vertical-align: top; overflow:hidden; ">
      <div>
        <span><?php echo escape($row["styleno"]); ?></span>
      </div>
		</td>
	</tr>
	<tr>
		<td width="25%" height="15px" style="vertical-align: top; overflow:hidden; ">
      <div>
        <span>Style Name | Color</span>
      </div>
		</td>
		<td width="25%" height="15px" style="vertical-align: top; overflow:hidden; ">
      <div>
        <span><?php echo escape($row["stylename"]); ?> | <?php echo escape($row["stylecolor"]); ?></span>
      </div>
		</td>
		<td width="25%" height="15px" style="vertical-align: top; overflow:hidden; ">
      <div>
        <span>Date Brewed</span>
      </div>
		</td>
		<td width="25%" height="15px" style="vertical-align: top; overflow:hidden; ">
      <div>
        <span><?php echo escape($row["datebrewed"]); ?></span>
      </div>
		</td>
	</tr>
	<tr>
		<td width="25%" height="15px" style="vertical-align: top; overflow:hidden; ">
      <div>
        <span>ABV%</span>
      </div>
		</td>
		<td width="25%" height="15px" style="vertical-align: top; overflow:hidden; ">
      <div>
        <span><?php echo escape($row["abv"]); ?></span>
      </div>
		</td>
		<td width="25%" height="15px" style="vertical-align: top; overflow:hidden; ">
      <div>
        <span>Date Kegged</span>
      </div>
		</td>
		<td width="25%" height="15px" style="vertical-align: top; overflow:hidden; ">
      <div>
        <span><?php echo escape($row["datekegged"]); ?></span>
      </div>
		</td>
	</tr>
	<tr>
		<td width="25%" height="15px" style="vertical-align: top; overflow:hidden; ">
      <div>
        <span>Served On Tap</span>
      </div>
		</td>
		<td width="25%" height="15px" style="vertical-align: top; overflow:hidden; ">
      <div>
        <span><?php echo escape($row["tapno"]); ?></span>
        </div>
      </div>
		</td>
		<td width="25%" height="15px" style="vertical-align: top; overflow:hidden; ">
      <div>
        <span>Date Kicked</span>
        </div>
      </div>
		</td>
		<td width="25%" height="15px" style="vertical-align: top; overflow:hidden; ">
      <div>
        <span><?php echo escape($row["datekicked"]); ?></span>
      </div>
		</td>
	</tr>
	<td width="25%" height="15px" style="vertical-align: top; overflow:hidden; ">
      <div>
        <span></span>
      </div>
		</td>
		<td width="25%" height="15px" style="vertical-align: top; overflow:hidden; ">
      <div>
        <span></span>
      </div>
		</td>
	<tr>
		<td width="25%" height="14px" style="vertical-align: top; overflow:hidden; ">
      <div>
        <span>Comments</span>
        </div>
      </div>
		</td>
		<td width="25%" height="14px" colspan="3" style="vertical-align: top; overflow:hidden; ">
      <div>
        <span><?php echo escape($row["comments"]); ?></span>
      </div>
		</td>
	</tr>
	<?php endforeach;?>
    </table>
  </div>
</div>
<br/><br/>
</span>
    </div>
		</td>
	</tr>
</table>
<br/>

<?php include "footer.php"; ?>
