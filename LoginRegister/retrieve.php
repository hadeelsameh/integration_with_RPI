<?php
/////////////////Not used it was for educational purpose only
//function retrivepatients($id){
    //$data =NULL;
    $con=mysqli_connect("localhost","root",'',"healthcare");
    //$idp=mysqli_real_escape_string($con, stripslashes(htmlspecialchars($data)));
    $response = array();
    $id=8;
    $table="patients";

    //$sql = "select * from patients";
    $sql ="select * from patients join treatedby join doctors where patients.id = patientid && doctors.id = doctorid && doctorid ='" . $id . "'";
    $result =mysqli_query($con , $sql);
    
    if($result){
        header("Content-Type: JSON");
        //$i=0;
        $row = mysqli_fetch_assoc($result);

        for($i = 0; $i <=mysqli_num_rows($result) ; $i++){

            $response[$i]['id']=$row['patientid'];
            //$response[$i]['ssn']=$row['ssn'];
            $response[$i]['name']=$row['name'];
            $response[$i]['gender']=$row['gender'];
            $response[$i]['age']=$row['age'];
            $response[$i]['heartrate']=$row['heartrate'];
            $response[$i]['temprature']=$row['temprature'];
            $response[$i]['spo']=$row['spo'];
            $response[$i]['bloodglucose']=$row['bloodglucose'];
            //$response[$i]['bedid']=$row['bedid'];
            //$response[$i]['roomid']=$row['roomid'];
            $response[$i]['status']=$row['status'];
            $response[$i]['doctornotes']=$row['doctornotes'];
            //$i++;
        }
        echo json_encode($response ,JSON_PRETTY_PRINT);
        //return $response;

    } else echo 'failed ';  


//}

//$con=mysqli_connect("localhost","root",'',"healthcare");
//$data=Null;
//if($con){
  //      $idp=mysqli_real_escape_string($con, stripslashes(htmlspecialchars($data)));
    //    $result = retrivepatients($_POST['id'])
      //  echo json_encode($response ,JSON_PRETTY_PRINT);
//}
//else {
  //  echo "Database failed to connect";
//}
echo "Today is " . date("Y-m-d ") . "<br>";
echo "Today is " . date("l"). "<br>";
echo date('h:i:s A');
?>
