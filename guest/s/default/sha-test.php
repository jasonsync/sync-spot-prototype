<?php

$input = "test";
// Hash password for DB insert
$password_hash = password_hash($input, PASSWORD_BCRYPT);
// $stmt = $mysqli->prepare("INSERT INTO user SET name=?, email=?, password_hash=?, verification_token=?");
// $stmt->bind_param("ssss", $name, $email, $password_hash, $verification_token);
// $stmt->execute();
echo $password_hash;

 ?>
