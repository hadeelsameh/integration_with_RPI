<?php

function retrivevisits($drusername ,$patientid)
    {
        $drusername = $this->prepareData($drusername);
        $patientid = $this->prepareData($patientid);
        $response = array();
        $day = date("Y-m-d");
        $time =date('h:i:s');
        $this->sql = $sql="select visitstimetable.patientid,
                            visitstimetable.time,
                            visitstimetable.isvideocall,
                            visitstimetable.ind,
                            bed.color,
                            bed.roomid
                            from visitstimetable JOIN bed 
                            on visitstimetable.patientid = bed.id 
                            where day = '" . $day . "' &&  time >= " . $drusername . "' ";
        $result = mysqli_query($this->connect, $this->sql);
        if ($result && mysqli_num_rows($result)!=0) {
            header("Content-Type: JSON");
            $i=0;
            while($row = mysqli_fetch_assoc($result)){
                //$response[$i]['patientid']=$row['patientid'];
                //$response[$i]['name']=$row['name'];
                //$response[$i]['day']=$row['day'];
                //$response[$i]['age']=$row['age'];
                //$response[$i]['heartrate']=$row['heartrate'];
                //$response[$i]['temprature']=$row['temprature'];
                //$response[$i]['spo']=$row['spo'];
                //$response[$i]['bloodglucose']=$row['bloodglucose'];
                $response[$i]['time']=$row['time'];
                $response[$i]['isvideocall']=$row['isvideocall'];
                $i++;
                //return $response;
            }
            echo json_encode($response ,JSON_PRETTY_PRINT);
            
        } 
        
    }


function hi($drusername)
    {
        $drusername = $this->prepareData($drusername);
        $response = array();
        $day="2021-05-16";
        $drusername="07:50:00";
        $this->sql = $sql ="select visitstimetable.patientid,
        visitstimetable.time,
        visitstimetable.isvideocall,
        bed.color,
        bed.roomid
        from visitstimetable JOIN bed 
        on visitstimetable.patientid = bed.id 
        where day = '" . $day . "' &&  time >= " . $drusername . "'";
        $result = mysqli_query($this->connect, $this->sql);
        if ($result && mysqli_num_rows($result)!=0) {
            header("Content-Type: JSON");
            $i=0;
            while($row = mysqli_fetch_assoc($result)){
                $response[$i]['id']=$row['patientid'];
                //$response[$i]['name']=$row['name'];
                //$response[$i]['gender']=$row['gender'];
                //$response[$i]['age']=$row['age'];
                //$response[$i]['heartrate']=$row['heartrate'];
                //$response[$i]['temprature']=$row['temprature'];
                //$response[$i]['spo']=$row['spo'];
                //$response[$i]['bloodglucose']=$row['bloodglucose'];
                $response[$i]['color']=$row['color'];
                $response[$i]['time']=$row['time'];
                $i++;
                
                //return $response;
            }
            echo json_encode($response ,JSON_PRETTY_PRINT);

        }  
        
    }
?>