#!/usr/bin/php
<?php

$db1 = 'mysql';
$db2 = 'it490';
$mydb = new mysqli('127.0.0.1','bobby','12345','mysql');

if ($mydb->errno != 0)
{
        echo "failed to connect to database: ". $mydb->error . PHP_EOL;
        exit(0);
}

echo "successfully connected to database: ".$db1.PHP_EOL;

$checkuser = 'evan';

$nquery = "select user from user where user = ?";
$stmt = $mydb->prepare($nquery);
$stmt->bind_param("s", $checkuser);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
	echo "User: $checkuser exists\n";
} else {
        echo "User dont exist\n";
}

$mydb->close();

$mydb = new mysqli('127.0.0.1','bobby','12345','it490');

if ($mydb->errno != 0)
{
        echo "failed to connect to database: ". $mydb->error . PHP_EOL;
        exit(0);
}

echo "successfully connected to database: ".$db2.PHP_EOL;


$query = "create table if not exists user_login(
	user_id int primary key auto_increment,
	f_name varchar(255) not null,
	l_name varchar(255) not null,
	email varchar(255) not null unique,
	password varchar(255) not null,
	created_at timestamp default current_timestamp
	)";
if ( $mydb->query($query)== TRUE){
	echo "table created succesfully\n";
} else {
	echo "Error: " . $mydb->error;
}

?>
