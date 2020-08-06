<?php

// update to your keezer's name
// can edit header.php if you 
// aren't welcoming. hahaha
$sitename = "Keezer Kiosk";


// designed for 2-8 taps
// if you go over, pull the comments 
// from the index.php page for room
$tapcount = "6";


// revise on major updates
// make sure to communicate cool new 
// functions for everyone to use
$version = "1.0";


// what color do you want (selects "color".css for swapping colors)
// so copy the white.css or black.css file to alter your configuration.
// the default installation only comes with "white" and "black".
// for editing in header.php it uses this as the .css file name
$color = "white";


// the following is the last part, the temp sensor
// please see the info on the README.txt file
// before hacking on this very effective code
// PICK (F) or (C) at the bottom of this function!

exec('modprobe w1-gpio');
exec('modprobe w1-therm');

$base_dir = '/sys/bus/w1/devices/';
$device_folder = glob($base_dir . '28*')[0];
$device_file = $device_folder . '/w1_slave';

$data = file($device_file, FILE_IGNORE_NEW_LINES);

$temperature = null;
if (preg_match('/YES$/', $data[0])) {
    if (preg_match('/t=(\d+)$/', $data[1], $matches, PREG_OFFSET_CAPTURE)) {
        $temperature = $matches[1][0] / 1000;
	$temp_c = round($temperature);
        $temp_f = round($temperature * 9 / 5 + 32);

	// change this to temp_c or temp_f for correct regional output
	// $temp is echoed on header.php files
	$temp = $temp_f;
    }
}
?>
