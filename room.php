<?php

require "./api/connect.php";
session_start();
// print_r($_SESSION);

// global variabels 
global $room_owner;
global $room_username;
global $room_password;

if (!isset($_SESSION["owner"]) || !isset($_SESSION["username"])) {
    // go to logout page 
    header("location: ./api/clearSession.php");
    // exit
} else {
    if (isset($_SESSION["owner"]) && isset($_SESSION["username"])) {
        // cheaking room exist in server 
        $owner = $_SESSION["owner"];
        $username = $_SESSION["username"];


        $sql = 'SELECT * FROM `newchat` WHERE ownername="' . $owner . '" AND userid="' . $username . '";';

        $result = mysqli_query($con, $sql);

        $room_num = (mysqli_num_rows($result));

        // if room not exist logout 
        if ($room_num == "0") {
            // print_r("exit");
            header("location: ./api/clearSession.php");
            exit;
        } else {
            // owner and username global 
            $room_owner = $_SESSION["owner"];
            $room_username = $_SESSION["username"];
            $room_password = (mysqli_fetch_assoc($result)["password"]);
            // print_r($_SESSION);
            // print_r("welcome");
        };
    };
};

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Chat Room | <?php echo $room_owner ?></title>
    <!-- icon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- css -->
    <link rel="stylesheet" href="./css/room.css">
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/c4f948f6a1.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    if(!isset($_SESSION['joiner'])){
        echo '<input type="hidden" id="myName" value="'.$room_owner.'(HOST)">' ;
    }
    else{
        echo '<input type="hidden" id="myName" value="'.$_SESSION['joiner'].'">';
    }
    ?>
        <div class="container">
            <div class="navigation">
                <div class="logo">
                    <b><a href="/">Chat Room</a></b>
                </div>
                <div class="links">
                    <ul>
                        <li><a href="./">Home</a></li>
                        <li><a href="/" class="active">Room</a></li>
                        <li><a href="/">Cart</a></li>
                        <li><a href="/">Services</a></li>
                    </ul>
                    <div class="darkModeFuture">
                        <i class="fa-solid fa-sun" onclick="Dark_Mode(this)"></i>
                    </div>
                </div>
                <!-- toggle navbar  -->
                <div class="toggleButton" onclick="navbarToggle()">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="toggleLinks" id="toggleButton">
                    <div class="toggleButton2">
                        <i class="fa-solid fa-bars" onclick="navbarToggle()"></i>
                    </div>
                    <ul>
                        <li><a href="/" class="active">Home</a></li>
                        <li><a href="/">About</a></li>
                        <li><a href="/">Cart</a></li>
                        <li><a href="/">Services</a></li>
                        <i class="fa-solid fa-sun" onclick="Dark_Mode(this)"> : Dark Mode</i>
                    </ul>
                </div>
            </div>
            <!-- message box  -->
            <div class="message-box">
                <div class="massagebox">
                    <div class="details">
                        <span>Success :</span><span>You Room Created Successfuly</span>
                    </div>
                    <div class="closeBtn">
                        <button><i class="fa-solid fa-xmark"></i></button>
                    </div>
                </div>
            </div>
            <!-- chating box -->

            <div class="chating-box">
                <h1 class="heading">Room Ownaer <?php echo $room_owner ?></h1>
                <h2 class="info">Share Room <button onclick="copyLink()" style="background: var(--primery-color);"><a class="info copyid" style="text-decoration: none;color: var(--light);"><?php echo "id:- " . $room_username . ",pass:- " . $room_password . "" ?> </a><i class="fa-solid fa-copy" style="cursor: pointer;"></i></button></h2>
                <p class="info">You're now chatting with bhavesh rahul shubhm....</p>

                <div class="chating_is">
                    <ul id="chating_box">

                    </ul>
                </div>
            </div>
            <div class="chat-area">
                <div class="button1">
                    <button id="logout_btn_exit">
                        <p>Esc</p>
                        <p>Exit</p>
                    </button>
                </div>
                <div class="textarea">
                    <textarea id="chating_value" maxlength="50"></textarea>
                </div>
                <div class="button2">
                    <button id="send_chatBtn">
                        <p>Enter</p>
                        <p>Send</p>
                    </button>
                </div>
            </div>
        </div>
        <script src="./js/room.js"></script>
</body>

</html>