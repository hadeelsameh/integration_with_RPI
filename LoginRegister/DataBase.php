<?php

require "DataBaseConfig.php";

class DataBase
{
    public $connect;
    public $data;
    private $sql;
    protected $servername;
    protected $username;
    protected $password;
    protected $databasename;

    public function __construct()
    {
        $this->connect = null;
        $this->data = null;
        $this->sql = null;
        $dbc = new DataBaseConfig();
        $this->servername = $dbc->servername;
        $this->username = $dbc->username;
        $this->password = $dbc->password;
        $this->databasename = $dbc->databasename;
    }

    function dbConnect()
    {
        $this->connect = mysqli_connect($this->servername, $this->username, $this->password, $this->databasename);
        return $this->connect;
    }

    function prepareData($data)
    {
        return mysqli_real_escape_string($this->connect, stripslashes(htmlspecialchars($data)));
    }

    function logIn($table, $username, $password)
    {
        $username = $this->prepareData($username);
        $password = $this->prepareData($password);
        $this->sql = "select * from " . $table . " where username = '" . $username . "'";
        $result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) != 0) {
            $dbusername = $row['username'];
            $dbpassword = $row['password'];
            if ($dbusername == $username && password_verify($password, $dbpassword)) {
                $login = true;
            } else $login = false;
        } else $login = false;

        return $login;
    }

    function signUp($table, $ssn, $speciality, $username, $password)
    {
        $ssn = $this->prepareData($ssn);
        $username = $this->prepareData($username);
        $password = $this->prepareData($password);
        $speciality = $this->prepareData($speciality);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $this->sql =
            "INSERT INTO " . $table . " (username,ssn, password, speciality) VALUES ('" . $ssn . "','" . $username . "','" . $password . "','" . $speciality . "')";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }


    function retrivepatient($table, $id)
    {
        $id = $this->prepareData($id);
        $response = array();
        $this->sql = "select * from " . $table . " where id = '" . $id . "'";
        $result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);
        if ($result &&  isset($row['id'])) {
            header("Content-Type: JSON");
            $i=0;
            //while($row = mysqli_fetch_assoc($result)){
                $response[$i]['id']=$row['id'];
                $response[$i]['name']=$row['name'];
                $response[$i]['gender']=$row['gender'];
                $response[$i]['age']=$row['age'];
                $response[$i]['heartrate']=$row['heartrate'];
                $response[$i]['temprature']=$row['temprature'];
                $response[$i]['spo']=$row['spo'];
                $response[$i]['bloodglucose']=$row['bloodglucose'];
                $response[$i]['status']=$row['status'];
                $response[$i]['doctornotes']=$row['doctornotes'];
                //$i++;
                echo json_encode($response ,JSON_PRETTY_PRINT);
                //return $response;}
        }  
    }


    function retrivepatientunder($drusername)
    {
        $drusername = $this->prepareData($drusername);
        $response = array();
        $this->sql = $sql ="select * from patients join treatedby join doctors where patients.id = patientid && doctors.id = doctorid && username ='" . $drusername . "'";
        $result = mysqli_query($this->connect, $this->sql);
        if ($result && mysqli_num_rows($result)!=0) {
            header("Content-Type: JSON");
            $i=0;
            while($row = mysqli_fetch_assoc($result)){
                $response[$i]['id']=$row['patientid'];
                $response[$i]['name']=$row['name'];
                $response[$i]['gender']=$row['gender'];
                $response[$i]['age']=$row['age'];
                $response[$i]['heartrate']=$row['heartrate'];
                $response[$i]['temprature']=$row['temprature'];
                $response[$i]['spo']=$row['spo'];
                $response[$i]['bloodglucose']=$row['bloodglucose'];
                $response[$i]['status']=$row['status'];
                $response[$i]['doctornotes']=$row['doctornotes'];
                $i++;
                
                //return $response;
            }
            echo json_encode($response ,JSON_PRETTY_PRINT);

        }  
        
    }


    function retrivepatientunderstatus($drusername)
    {
        $drusername = $this->prepareData($drusername);
        $response = array();
        $status ="normal";
        $this->sql = $sql ="select * from patients join treatedby join doctors where patients.id = patientid && doctors.id = doctorid && username ='" . $drusername . "' && status ='" . $status . "'";
        $result = mysqli_query($this->connect, $this->sql);
        if ($result && mysqli_num_rows($result)!=0) {
            header("Content-Type: JSON");
            $i=0;
            while($row = mysqli_fetch_assoc($result)){
                $response[$i]['id']=$row['patientid'];
                $response[$i]['name']=$row['name'];
                $response[$i]['gender']=$row['gender'];
                $response[$i]['age']=$row['age'];
                $response[$i]['heartrate']=$row['heartrate'];
                $response[$i]['temprature']=$row['temprature'];
                $response[$i]['spo']=$row['spo'];
                $response[$i]['bloodglucose']=$row['bloodglucose'];
                $response[$i]['status']=$row['status'];
                $response[$i]['doctornotes']=$row['doctornotes'];
                $i++;
                
                //return $response;
            }
            echo json_encode($response ,JSON_PRETTY_PRINT);

        }  
        
    }



    function retrivepatientcomingvisits($drusername ,$patientid)
    {
        $drusername = $this->prepareData($drusername);
        $patientid = $this->prepareData($patientid);
        $response = array();
        $day = date("Y-m-d");
        $time =date('h:i:s');
        $this->sql = $sql="select  patients.spo,
                                   patients.heartrate,
                                   patients.temprature,
                                   patients.bloodglucose,
                                   patients.name,
                                   patients.age,
                                   patients.id,
                                   visit.day,
                                   visit.time,
                                   visit.isvideocall
                            from patients
                            join treatedby treat ON patients.id = treat.patientid
                            join doctors ON doctors.id = treat.doctorid
                            join visitstimetable visit ON visit.patientid = patients.id
                            and username ='" . $drusername . "'
                            and visit.day >='" . $day . "'
                            and visit.time >='" . $time . "'
                            and visit.patientid ='". $patientid . "' ";
        $result = mysqli_query($this->connect, $this->sql);
        if ($result && mysqli_num_rows($result)!=0) {
            header("Content-Type: JSON");
            $i=0;
            while($row = mysqli_fetch_assoc($result)){
                $response[$i]['id']=$row['id'];
                $response[$i]['name']=$row['name'];
                $response[$i]['day']=$row['day'];
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


    function addnewvisit($day , $time , $id , $isvideocall)
    {
        $day = $this->prepareData($day);
        $time = $this->prepareData($time);
        $id = $this->prepareData($id);
        $isvideocall = $this->prepareData($isvideocall);
        $table = "visitstimetable";
        $this->sql ="INSERT INTO " . $table . " (patientid,day, time, isvideocall) VALUES ('" . $id . "','" . $day . "','" . $time . "','" . $isvideocall . "')";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }


    function editvisit($day , $time , $id ,$isvideocall)
    {
        $day = $this->prepareData($day);
        $time = $this->prepareData($time);
        $id = $this->prepareData($id);
        $isvideocall = $this->prepareData($isvideocall);
        
        $this->sql ="update visitstimetable  set isvideocall='" . $isvideocall . "' where patientid='" . $id . "' && day='" . $day . "' && time='" . $time . "'";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }


    function editnote($id ,$drnote)
    {
        $id = $this->prepareData($id);
        $drnote = $this->prepareData($drnote);
        $this->sql ="update patients  set doctornotes='" . $drnote . "' where id='" . $id . "'";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }

    

    function update_vs($id ,$temprature , $spo ,$heartrate)
    {
        $id = $this->prepareData($id);
        $temprature = $this->prepareData($temprature);
        $spo = $this->prepareData($spo);
        $heartrate = $this->prepareData($heartrate);
        $this->sql ="update patients  set temprature='" . $temprature . "', spo='" . $spo . "',heartrate='" . $heartrate . "' where id='" . $id . "'";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }



    function retrivepatients($d)
    {
        $d = $this->prepareData($d);
        $response = array();
        $this->sql = "SELECT * FROM patients";
        $result = mysqli_query($this->connect, $this->sql);
        if ($result &&  mysqli_num_rows($result)!=0) {
            header("Content-Type: JSON");
            $i=0;
            while($row = mysqli_fetch_assoc($result)){
                $response[$i]['id']=$row['id'];
                $i++;
            }
            echo json_encode($response ,JSON_PRETTY_PRINT);
        }  
    }


    function retrivepatientvisits($patientid)
    {
        date_default_timezone_set('EET');
        $patientid = $this->prepareData($patientid);
        $response = array();
        $day = date("Y-m-d");
        $time =date('h:i:s');
        $this->sql = $sql="select  patients.spo,
                                   patients.heartrate,
                                   patients.temprature,
                                   patients.bloodglucose,
                                   patients.name,
                                   patients.age,
                                   patients.id,
                                   visit.day,
                                   visit.time,
                                   visit.isvideocall
                            from patients
                            join treatedby treat ON patients.id = treat.patientid
                            join doctors ON doctors.id = treat.doctorid
                            join visitstimetable visit ON visit.patientid = patients.id
                            and visit.day ='" . $day . "'
                            and visit.time >= '" . $time . "'
                            and visit.patientid ='". $patientid . "' ";
        $result = mysqli_query($this->connect, $this->sql);
        if ($result && mysqli_num_rows($result)!=0) {
            header("Content-Type: JSON");
            $i=0;
            while($row = mysqli_fetch_assoc($result)){
                $response[$i]['time']=$row['time'];
                $response[$i]['isvideocall']=$row['isvideocall'];
                $i++;
            }
            echo json_encode($response ,JSON_PRETTY_PRINT);   
        } 
    }


    function getbed($id)
    {
        $id = $this->prepareData($id);
        $response = array();
        $this->sql = "SELECT * FROM bed WHERE id = '" . $id . "' ";
        $result = mysqli_query($this->connect, $this->sql);
        if ($result &&  mysqli_num_rows($result)!=0) {
            header("Content-Type: JSON");
            $i=0;
            while($row = mysqli_fetch_assoc($result)){
                $response[$i]['color']=$row['color'];
                $response[$i]['roomid']=$row['roomid'];
                $i++;
            }
            echo json_encode($response ,JSON_PRETTY_PRINT);
        }  
    }

      
}
?>
