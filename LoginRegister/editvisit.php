<?php
//edit visit videocall option for specific patient

require "DataBase.php";
$db = new DataBase();
if (isset($_POST['patientid']) && isset($_POST['day']) && isset($_POST['time']) && isset($_POST['isvideocall'])) {
    if ($db->dbConnect()) {
        if ($db->editvisit($_POST['patientid'] ,$_POST['day'] ,$_POST['time'] , $_POST['isvideocall'])) {
            echo "Visit edited successfully";
        } else echo "editting Failed";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>