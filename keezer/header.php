<!DOCTYPE html>
<html>
<head>
	<title>Welcome to <?php echo ($sitename); ?></title>
	<link rel="stylesheet" type="text/css" href="<?=($color); ?>.css">
</head>

<body padding:0;  margin: 0; >
<br/>
<div style="text-align:center;">
<table cellpadding="3" cellspacing="1"  style="box-sizing: border-box; vertical-align: bottom; position:relative; display: inline-table; width:90%; height:100px; background:none; border: 1px solid; table-layout: fixed; ">
	<tr>
		<td width="90%" height="86px" style="vertical-align: top; overflow:hidden; ">
    <div style="text-align:center;">
      <span style="font-size:26pt; ">Welcome to <br/>
      <span style="font-size:26pt; "><b><?php echo ($sitename); ?></b></span>
    </div>
		</td>
		<td width="15%" height="100px" rowspan="2" style="vertical-align: top; overflow:hidden; ">
    <div style="text-align:center;">
      <span style="font-size:24pt; "><br/>
<?php // these variables come from the globals.php page ?>
<?php
if ($temperature) {
    echo "${temp}&deg";
} else {
    echo "\n";
}
?>
</span><br/>
      </div>
		</td>
	</tr>

<tr>
<td width="90%" height="12px" style="vertical-align: top; overflow:hidden; ">
    <div style="text-align:center;">
      <a href="./">Home</a>  |  <a href="./history.php">History</a>  |  <a href="./upcoming.php">Upcoming</a>  |  <a href="./styles.php">Style List</a>
    </div>
</td>
</tr>
</table>
</div>
<br/>