<?php
// header('Content-type:application/json;charset=utf-8');
session_start();

// validate request
// $request = require(__DIR__.'/../../common/validate_json_request.php'); // return json request, or json "error":"..."


// error_reporting(0);
require(__DIR__.'/../../../config.php');
// require(__DIR__.'/../../../mail.php');
require(__DIR__.'/../../../db.php'); // creates database connection $mysqli
require(__DIR__.'/../logout/index.php'); // make sure the user is logged out
require_once(__DIR__.'/../../../lib/random.php');


if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_POST['name']) || $_POST['name'] == '') {
    $data = ['error'=> true, 'errorMsg'=>'Name is missing.'];
    return json_encode($data);
    exit();
}

if (!isset($_POST['phone']) || $_POST['phone'] == '') {
    $data = ['error'=> true, 'errorMsg'=>'Phone number is missing.'];
    return json_encode($data);
    exit();
}
// Exit and return error if email is not passed in request json body
if (!isset($_POST['email']) || $_POST['email'] == '') {
    $data = ['error'=> true, 'errorMsg'=>'Email address missing.'];
    return json_encode($data);
    exit();
}
if (!isset($_POST['password']) || $_POST['password'] == '') {
    $data = ['error'=> true, 'errorMsg'=>'Password missing.'];
    return json_encode($data);
    exit();
}
if (!isset($_POST['confirm_password']) || $_POST['confirm_password'] == '') {
    $data = ['error'=> true, 'errorMsg'=>'Password confirmation is missing.'];
    return json_encode($data);
    exit();
}
// if (!isset($_POST['register_captcha_response_token'])) {
//     $data = ['error'=> true, 'errorMsg'=>'Captcha not solved.'];
//     echo json_encode($data);
//     exit();
// }

if ($_POST['password'] != $_POST['confirm_password']) {
    $data = ['error'=> true, 'errorMsg'=>'Passwords do not match.'];
    return json_encode($data);
    exit();
}


$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);

// Exit and return error if email is not valid
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $data = ['error'=> true, 'errorMsg'=>'Invalid email address.'];
    return json_encode($data);
    exit();
}

// Exit and return error if password is not valid
// Validate password strength
// $uppercase = preg_match('@[A-Z]@', $request['password']);
// $lowercase = preg_match('@[a-z]@', $request['password']);
// $number    = preg_match('@[0-9]@', $request['password']);
// $specialChars = preg_match('@[^\w]@', $request['password']);

if (/*!$uppercase || !$lowercase || !$number || !$specialChars || */strlen($_POST['password']) < 8) {
    $data = ['error'=> true, 'errorMsg'=>'Password must be at least 8 characters in length'];
    return json_encode($data);
    exit();
}

// Exit and return error if email address is already taken
$stmt = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$stmt -> close();
if ($result->num_rows === 1) {
    $data = ['error'=> true, 'errorMsg'=>'Email address already registered.'];
    return json_encode($data);
    exit();
}
// Exit and return error if email address is already taken
$stmt = $mysqli->prepare("SELECT id FROM users WHERE phone = ?");
$stmt->bind_param("s", $phone_number);
$stmt->execute();
$result = $stmt->get_result();
$stmt -> close();
if ($result->num_rows === 1) {
    $data = ['error'=> true, 'errorMsg'=>'Phone number already registered.'];
    return json_encode($data);
    exit();
}

// Hash password for DB insert
$password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
$stmt = $mysqli->prepare("INSERT INTO users SET name=?, surname=?, email=?, phone=?, identity_number=?, password_hash=?");
$stmt->bind_param("ssssss", $name, $surname, $email, $phone_number, $id_number, $password_hash);
$stmt->execute();

if (isset($stmt->insert_id)) {
    $user_id = $stmt->insert_id;
    $stmt->close();

    // send verification email to user
    // $emailSent = sendVerificationEmail($email, $verification_token);
    $_SESSION['user_id'] = $user_id;
    $_SESSION['email'] = $email;
    $data = ['registered'=> true];
    return json_encode($data);
    exit();
}
