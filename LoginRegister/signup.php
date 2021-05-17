<?php
require "DataBase.php";
$db = new DataBase();
if (isset($_POST['ssn']) && isset($_POST['speciality']) && isset($_POST['username']) && isset($_POST['password'])) {
    if ($db->dbConnect()) {
        if ($db->signUp("doctors", $_POST['ssn'], $_POST['speciality'], $_POST['username'], $_POST['password'])) {
            echo "Sign Up Success";
        } else echo "Sign up Failed (This username is aready teaken)";
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>
