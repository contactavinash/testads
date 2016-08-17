<?php
$username = "root";
$password = "";
$hostname = "localhost"; 
$dbname = "pricenew"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password)
 or die("Unable to connect to MySQL");

//select a database to work with
$selected = mysql_select_db($dbname,$dbhandle)
  or die("Could not select database");
  
 