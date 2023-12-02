<?php
sleep(5);
// error_reporting(0);

// connect to database
require "./connect.php";

// allowed links 
$allowedLinks = ["http://localhost/chatroom/room"];
// echo $_SERVER["HTTP_REFERER"];

// user requested url
if (isset($_SERVER["HTTP_REFERER"])) {
    // echo "welcome";    
    // user othorized side 
    if (in_array($_SERVER["HTTP_REFERER"], $allowedLinks)) {

        $postData = file_get_contents('php://input');
        // print_r($postData);

        // json to assoc
        $postData = json_decode($postData, true);

        // print_r($postData["message"]);
        $message = $postData["message"];

        // geting user name and userid 
        session_start();

        // geting user name 
        $username = ($_SESSION["username"]);

        $sql = 'SELECT * FROM `newchat` WHERE userid="' . $username . '";';

        $result = mysqli_query($con, $sql);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                // chiking ho is owner of room 
                //  sending message 
                $sql = 'SELECT * FROM `chats` WHERE userid="' . $username . '";';

                $result = mysqli_query($con, $sql);

                $allData = mysqli_fetch_all($result, MYSQLI_ASSOC);
               
                print_r(json_encode($allData,true));

            } else {
                echo '{
                    "errors": [{
                        "status": 404,
                        "title": "Error",
                        "details": "Chat Room Is Not Exiest"
                    }]
                }';
                exit;
            }
        } else {
            echo '{
                "errors": [{
                    "status": 404,
                    "title": "Error",
                    "details": "We Faild To load You Chat.  reload the page"
                }]
            }';
            exit;
        }
    } else {
        echo '{
            "errors": [{
                "status": 404,
                "title": "Error",
                "details": "File Not Found ):"
            }]
        }';
        exit;
    };
} else {
    echo '{
        "errors": [{
            "status": 404,
            "title": "Error",
            "details": "File Not Found ):"
        }]
    }';
    exit;
}
