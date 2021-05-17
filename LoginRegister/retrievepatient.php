<?php
//retrive patient given his id
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['id'])) {
    if ($db->dbConnect()) {
        if ($response = $db->retrivepatient("patients", $_POST['id'])) {
            echo  $response;
        } //else echo "cannot find patient";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>