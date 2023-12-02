<?php
error_reporting(0);

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

        $owner = $postData["owner"];
        $username = $postData["username"];
        $password = $postData["password"];

        // print_r($owner);
        // print_r($username);
        // print_r($password);

        if (strlen($owner) >= 2 && strlen($username) >= 5 && strlen($password) >= 6) {


            // SQL RECOURD CHECK
            $sql = "SELECT * FROM `newchat` WHERE userid='" . $username . "';";

            $result = mysqli_query($con, $sql);

            if ($result) {
                $rows = mysqli_num_rows($result);
                if ($rows == 0) {
                    $sql = "INSERT INTO `newchat` (`id`, `ownername`, `userid`, `password`, `time`) VALUES (NULL, '" . $owner . "', '" . $username . "', '" . $password . "', current_timestamp()); ";

                    $result = mysqli_query($con, $sql);

                    if ($result) {
                        echo '{
                            "errors": [{
                                "status": 200,
                                "title": "Success",
                                "details": "We Successfuly To Create Room"
                            }]
                        }';

                        session_start();
                        session_unset();

                        $_SESSION["owner"] = $owner;
                        $_SESSION["username"] = $username;
                        exit;
                    } else {
                        echo '{
                            "errors": [{
                                "status": 402,
                                "title": "Falied",
                                "details": "We Falied To Create Room"
                            }]
                        }';
                        exit;
                    }
                } else {
                    echo '{
                    "errors": [{
                        "status": 402,
                        "title": "Username Falied",
                        "details": "UserName Alerady Exist"
                    }]
                }';
                    exit;
                }
            } else {
                echo '{
                "errors": [{
                    "status": 402,
                    "title": "Falied",
                    "details": "We Falied To Create Room"
                }]
                }';
                exit;
            };
        } else {
            echo '{
            "errors": [{
                "status": 304,
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
