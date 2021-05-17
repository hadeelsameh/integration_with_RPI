<?php
//edit dr notes for specific patient
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['patientid']) && isset($_POST['doctornotes']) ) {
    if ($db->dbConnect()) {
        if ($db->editnote($_POST['patientid'], $_POST['doctornotes'])) {
            echo "note editted successfully";
        } else echo "editting failed";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>