<?php
session_start();
include("../includes/conn.php");

use myPHPnotes\Microsoft\Auth;
use myPHPnotes\Microsoft\Handlers\Session;
use myPHPnotes\Microsoft\Models\User;

require "../vendor/autoload.php";

// Check if the 'code' parameter is present in the request
if (!isset($_REQUEST['code'])) {
    // Handle the case when the 'code' parameter is missing
    header("Location: index.php"); // Redirect to an error page
    exit;
}

$auth = new Auth(Session::get("tenant_id"), Session::get("client_id"), Session::get("client_secret"), Session::get("redirect_uri"), Session::get("scopes"));
$tokens = $auth->getToken($_REQUEST['code']);
$accessToken = $tokens->access_token;
$auth->setAccessToken($accessToken);
$user = new User;
$_SESSION['access_token'] = $accessToken;
$untrimmed_username = $user->data->getDisplayName();

// Trim the username to be lowercase with no spaces
$_SESSION['username'] = str_replace(" ", "", strtolower($untrimmed_username));
$_SESSION['email'] = $user->data->getUserPrincipalName();

// check if user is in database

$username = $_SESSION['username'];
$email = $_SESSION['email'];

$sql = "SELECT * FROM users WHERE username = '$username' AND email = '$email'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    // if user is not in database, add user to database
    $sql = "INSERT INTO users (username, email, elo, user_type, native) VALUES ('$username', '$email', 0, 'virgin', 0)";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // if success, redirect to breakvirginity.php
        header("Location: index.php");
    } else {
        // if fail, show error
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}else{
    // if user is in database, redirect to home.php
    // get user elo and user type
    $sql = "SELECT * FROM users WHERE username = '$username' AND email = '$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $_SESSION['elo'] = $row['elo'];
    $_SESSION['user_type'] = $row['user_type'];
    header("Location: ../index.php?page=home");
}

