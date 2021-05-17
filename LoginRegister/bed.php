<?php
// retrive bed details for patient id
require "DataBase.php";
$db = new DataBase();
$data = json_decode(file_get_contents('php://input'), true);

    if ($db->dbConnect()) {
        if ($response = $db->getbed($data['id'])) {
            echo  $response;
        } else echo $response;
    } else echo "Error: Database connection";

?>