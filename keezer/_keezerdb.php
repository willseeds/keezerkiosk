<?php

/**
  * Configuration for keezer database connection
  */

$host       = "localhost"; 	// dont change if local
$username   = "x";		// mysql login name allowing select, revise, edit, delete
$password   = "x";	// password for mysql login name
$dbname     = "keezer"; 	// the database where your keezer info is stored
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );