<?php
date_default_timezone_set('EET');
// retrive all upcoming today visits for patient id 
require "DataBase.php";
$db = new DataBase();
$data = json_decode(file_get_contents('php://input'), true);
    if ($db->dbConnect()) {
        if ($response = $db->retrivepatientvisits($data['id'])) {
            echo  $response;
        } else echo $response;
    } else echo "Error: Database connection";
?>