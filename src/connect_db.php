<?php

require('config.php');

$connect = mysqli_connect($dbhost, $dbuser, $dbpasswd, $dbname)
or die("Connection failed: " . mysqli_connect_error());

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS ".TBLNAME." (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name_film VARCHAR(50) NOT NULL,
year_film VARCHAR(50) NOT NULL,
isActive TINYINT(1) default 1,
data_add varchar(35) NOT NULL
)";

mysqli_query($connect, $sql) or die("Error creating table: " . mysqli_error($connect));