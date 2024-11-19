<?php

$con = mysqli_connect("db", "user", "user_password", "my_database");
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
