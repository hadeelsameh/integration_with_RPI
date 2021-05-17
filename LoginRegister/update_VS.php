<?php
//edit visit videocall option for specific patient

require "DataBase.php";
$db = new DataBase();
#if (isset($_POST['patientid']) && isset($_POST['day']) && isset($_POST['time']) && isset($_POST['isvideocall'])) {
$data = json_decode(file_get_contents('php://input'), true);
#print_r($data);
    if ($db->dbConnect()) {
        if ($db->update_vs($data['patientid'] ,$data['temprature'],$data['spo'],$data['heartrate'])) {
            echo 'successfully updated';
        } else echo "editting Failed";
    } else echo "Error: Database connection";
#} else echo "All fields are required";
?>