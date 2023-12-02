<?php

session_start();

if(isset($_SESSION["owner"]) && isset($_SESSION["username"]) && !isset($_SESSION["joiner"])){
    header("location: room.php");
}
else{
    session_unset();
    session_destroy();
}
// print_r($_SESSION)

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Chat Room | Home</title>
    <!-- icon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- css -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/c4f948f6a1.js" crossorigin="anonymous"></script>
    
</head>

<body>
    <div class="container">
        <div class="navigation">
            <div class="logo">
                <b><a href="/">Chat Room</a></b>
            </div>
            <div class="links">
                <ul>
                    <li><a href="/" class="active">Home</a></li>
                    <li><a href="/">About</a></li>
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
        <!-- chat login  -->
        <div class="chatRoom">
            <div class="chat">
                <h1 class="heading">Welcome To Chat Room</h1>

                <div class="create_room">
                    <h2 class="heading">Create Room</h2>
                    <table>
                        <tr>
                            <td>Enter Owner Name:</td>
                            <td><input type="text" maxlength="10"></td>
                        </tr>
                        <tr>
                            <td>Enter UserName/id Name:</td>
                            <td><input type="text"maxlength="20"></td>
                        </tr>
                        <tr>
                            <td>Create Room Password:</td>
                            <td><input type="password" maxlength="20"></td>
                        </tr>
                    </table>
                    <button class="create-room-btn">Create Room</button>
                </div>

                <div class="create_room join_room">
                    <h2 class="heading">Join Room</h2>
                    <table>
                        <tr>
                            <td>Enter Your Name:</td>
                            <td><input type="text" maxlength="10"></td>
                        </tr>
                        <tr>
                            <td>Enter Room Id:</td>
                            <td><input type="text" maxlength="20"></td>
                        </tr>
                        <tr>
                            <td>Enter Room Password:</td>
                            <td><input type="password" maxlength="20"></td>
                        </tr>
                    </table>
                    <button class="create-room-btn">Join Room</button>
                </div>
            </div>
            <div class="show-img" id="show-img-dom">
                <img class="back-img" src="./Images/back-img-friends.png">
                <img class="friends-gorup" src="./Images/friends-group.png">
            </div>
        </div>

        <!-- footer -->
        <div class="footer">
            <div class="social-links">
                <p class="footer-heading">Get Contect With Us Social Network:</p>
                <div class="links">
                    <a href="/"><i class="fa-brands fa-facebook"></i></a>
                    <a href="/"><i class="fa-brands fa-twitter"></i></a>
                    <a href="/"><i class="fa-brands fa-youtube"></i></a>
                    <a href="/"><i class="fa-brands fa-google"></i></a>
                    <a href="/"><i class="fa-brands fa-instagram"></i></a>
                    <a href="/"><i class="fa-brands fa-github"></i></a>
                </div>
            </div>
            <div class="web-details">
                <div class="company-details">
                    <span class="heading">Company Name</span>
                    <p class="content">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto aliquam
                        excepturi id rerum iure voluptatibus numquam nisi impedit laudantium veritatis reprehenderit
                        dolor sed, maiores expedita quam officia aperiam eum earum?</p>
                </div>
                <div class="company-products">
                    <span class="heading">Products</span>
                    <ul>
                        <li><a href="/">Product 1</a></li>
                        <li><a href="/">Product 2</a></li>
                        <li><a href="/">Product 3</a></li>
                        <li><a href="/">Product 4</a></li>
                    </ul>
                </div>
                <div class="useful-links">
                    <span class="heading">Useful Links</span>
                    <ul>
                        <li><a href="/">You Account</a></li>
                        <li><a href="/">Cart</a></li>
                        <li><a href="/">Your History</a></li>
                        <li><a href="/">Log Out</a></li>
                    </ul>
                </div>
                <div class="contect-us">
                    <span class="heading">Contect Us</span>
                    <ul>
                        <li><a href="/"><i class="fa-solid fa-location-dot"></i><span>New Mumbai,NM 34233,IN</span></a>
                        </li>
                        <li><a href="/"><i class="fa-solid fa-envelope"></i><span>info@example.com</span></a></li>
                        <li><a href="/"><i class="fa-solid fa-phone"></i><span>+91 1234567890</span></a></li>
                        <li><a href="/"><i class="fa-solid fa-globe"></i><span>+1 1234567890</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright-details">
                © 2022 Copyright: chatroom.com
            </div>
        </div>
    </div>
    <!-- javascript  -->
    <script src="./js/script.js"></script>
</body>

</html>