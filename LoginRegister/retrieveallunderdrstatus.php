<?php
// retrive all patients that are being treated by dr username (saved from login activity) and their status is danger
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['username'])) {
    if ($db->dbConnect()) {
        if ($response = $db->retrivepatientunderstatus($_POST['username'])) {
            echo  $response;
        } //else echo "cannot find patient";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>