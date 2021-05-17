<?php
date_default_timezone_set('EET');
// retrive all upcoming today visits for patient id 
require "DataBase.php";
$db = new DataBase();
$data = json_decode(file_get_contents('php://input'), true);
    if ($db->dbConnect()) {
        if ($response = $db->verifypatient($data['day'],$data['time'],$data['patientid'])) {
            echo "verified successfully";
        } else echo "Faild";
    } else echo "Error: Database connection";
?>