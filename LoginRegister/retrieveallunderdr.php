<?php
// retrive all patients that are being treated by dr username (saved from login activity)
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['username'])) {
    if ($db->dbConnect()) {
        if ($response = $db->retrivepatientunder($_POST['username'])) {
            echo  $response;
        } //else echo "cannot find patient";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>