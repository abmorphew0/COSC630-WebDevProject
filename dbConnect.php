<?php
function OpenCon()
 {
    $dbhost = "138.88.73.64:3306";
    $dbuser = "amorphew";
    $dbpass = "Climatal11!";
    $db = "amorphew";
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

    return $conn;
 }

function CloseCon($conn)
 {
    $conn -> close();
 }
?>
