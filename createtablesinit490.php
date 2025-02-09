#!/usr/bin/php
<?php

$mydb = new mysqli('127.0.0.1','bobby','12345','it490');

if ($mydb->errno != 0)
{
        echo "failed to connect to database: ". $mydb->error . PHP_EOL;
        exit(0);
}

echo "successfully connected to database".PHP_EOL;


$query = "create table if not exists user_login(
	user_id int primary key auto_increment,
	f_name varchar(255) not null,
	l_name varchar(255) not null,
	email varchar(255) not null unique,
	password varchar(255) not null,
	created_at timestamp default current_timestamp
	)";
if ( $mydb->query($query)== TRUE){
	echo "table created succesfully";
} else {
	echo "Error: " . $mydb->error;
}

?>
