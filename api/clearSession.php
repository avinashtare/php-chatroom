<?php
session_start();

// go to home page 
header("location: ../");

require "./connect.php";

if (isset($_SESSION["owner"]) && isset($_SESSION["username"]) && !isset($_SESSION["joiner"])) {
    $owner = $_SESSION["owner"];
    $username = $_SESSION["username"];

    // delete server room data 
    $sql = 'DELETE FROM `newchat` WHERE userid="' . $username . '" AND ownername = "' . $owner . '";';

    $result = mysqli_query($con, $sql);

    // deleting all chat data

    $sql = 'DELETE FROM `chats` WHERE userid="' . $username . '";';

    $result = mysqli_query($con, $sql);
}
session_unset();
session_destroy();

header("location: ../");
