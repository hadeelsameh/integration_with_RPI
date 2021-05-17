<?php
//adding new visit time for specific patient
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['patientid']) && isset($_POST['day']) && isset($_POST['time']) && isset($_POST['isvideocall'])) {
    if ($db->dbConnect()) {
        if ($db->addnewvisit($_POST['day'], $_POST['time'], $_POST['patientid'], $_POST['isvideocall'])) {
            echo "Visit added successfully";
        } else echo "adding Failed (This date and time is not available)";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>