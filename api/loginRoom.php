<?php
// error_reporting(0);

// connect to database
require "./connect.php";

// allowed links 
$allowedLinks = ["http://localhost/chatroom/"];
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

        $joiner_name = $postData["joiner_name"];
        $username = $postData["username"];
        $password = $postData["password"];

        // print_r($joiner_name);
        // print_r($username);
        // print_r($password);

        if (strlen($joiner_name) >= 2 && strlen($username) >= 5 && strlen($password) >= 6) {
            // SQL RECOURD CHECK
            $sql = "SELECT * FROM `newchat` WHERE userid='" . $username . "' AND password='" . $password . "';";
            
            $result = mysqli_query($con, $sql);

            if ($result) {
                $rows = mysqli_num_rows($result);
                if ($rows == 1) {
                    $room_details = mysqli_fetch_assoc($result);
                    // print_r($room_details);

                    $room_owner = $room_details["ownername"];
                    $room_username = $room_details["userid"];
                    $room_password = $room_details["password"];
                    
                    session_start();
                    // setting_session
                    $_SESSION["joiner"] = $joiner_name;
                    $_SESSION["owner"] = $room_owner;
                    $_SESSION["username"] = $room_username;

                    echo '{
                        "errors": [{
                            "status": 200,
                            "title": "Success",
                            "details": "You Are Succesfuly Login"
                        }]
                    }';
                    exit;


                } else {
                    echo '{
                    "errors": [{
                        "status": 402,
                        "title": "Error",
                        "details": "Chat Romm Not Exist Check UserName And Password"
                    }]
                }';
                    exit;
                }
            } else {
                echo '{
                "errors": [{
                    "status": 402,
                    "title": "Falied",
                    "details": "We Falied To Login Into Chat Room"
                }]
                }';
                exit;
            };
        }
        else {
            echo '{
            "errors": [{
                "status": 304,
                "title": "Error",
                "details": "Fill All Blanks ):"
            }]
        }';
            exit;
        };
    } 
    else {
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