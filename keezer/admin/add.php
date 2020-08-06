<?php

include "../../../globals.php";

if (isset($_POST['submit'])) {
  require "../../../keezerdb.php";
  require "../../../common.php";;

  try {
    $connection = new PDO($dsn, $username, $password, $options);

    // build array for _POST beers submitted to add
    $new_beer = array(
      "beername"       => $_POST['beername'],
      "abv"            => $_POST['abv'],
      "datebrewed"     => $_POST['datebrewed'],
      "stylename"      => $_POST['stylename'],
      "ibu"            => $_POST['ibu'],
      "comments"       => $_POST['comments']
    );

    $sql = sprintf(
// insert submitted array from _POST beers into db
"INSERT INTO %s (%s) values (%s)",
"beers",
implode(", ", array_keys($new_beer)),
":" . implode(", :", array_keys($new_beer))
    );

    $statement = $connection->prepare($sql);
    $statement->execute($new_beer);
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }

}
?>

<script language = "javascript" type = "text/javascript">
function validateForm() {
  var b = document.forms["addbeer"]["beername"].value;
  var c = document.forms["addbeer"]["datebrewed"].value;
  if (b == "") {
    alert("Beer name must be filled out");
    return false;
  }
  if (c == "") {
    alert("Date Brewed must be filled out");
    return false;
  }
} 
</script>

<?php include "header.php"; ?>

<br/>
<div style="text-align:center;">
<table cellpadding="3" cellspacing="1"  style="box-sizing: border-box; vertical-align: bottom; position:relative; display: inline-table; width:90%; height:450px; background:none; border: 1px solid; table-layout: fixed; ">
	<tr>
	<td width="100%" height="450px" style="vertical-align: top; overflow:hidden; ">
    <div style="text-align:center;">
<span>

<?php if (isset($_POST['submit']) && $statement) { 
// give thanks or tell us the error ?>
  > <?php echo $_POST['beername']; ?> successfully added.
<?php } ?>

<h2>Add a beer</h2>

<p>
<form name="addbeer" onsubmit="return validateForm()" method="post">
  <label for="beername">Beer Name:</label><br/>
  <input type="text" name="beername" id="beername"><br/><br/>
  <label for="abv">ABV %:</label><br/>
  <input type="text" name="abv" id="abv"><br/><br/>
  <label for="datebrewed">Date Brewed:</label><br/>
  <input type="date" name="datebrewed" id="datebrewed"><br/><br/>
  <label for="stylename">Style Name:</label><br/>
  <input type="text" name="stylename" id="stylename"><br/><br/>
  <label for="IBU">IBU:</label><br/>
  <input type="text" name="ibu" id="IBU"><br/><br/>
  <label for="comments">Comments:</label><br/>
  <textarea rows="10" cols="60" name="comments" id="comments"></textarea><br/><br/>
<input type="submit" name="submit" value="Submit"><br/>
</form></p>

<a href="index.php">Back to admin home</a>
<br/>
<br/>
</span>
    </div>
		</td>
	</tr>
</table>

<?php include "footer.php"; ?>
