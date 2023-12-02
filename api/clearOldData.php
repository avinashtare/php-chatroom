<?php
require "./connect.php";

// deleting 24 hour data
$sql = "DELETE FROM `newchat` WHERE (time < now() - interval 24 hour) LIMIT 50;";

$result = mysqli_query($con,$sql);
?>