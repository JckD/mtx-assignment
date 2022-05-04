<?php 

$host = "localhost";
$user = "root";
$pw = 'admin';
$dbname = 'timelineweather';

//Connect to DB
$con = mysqli_connect($host, $user, $pw, $dbname);

//Get request method
$method = $_SERVER['REQUEST_METHOD'];

//Close connection if failed
if(!$con) {
    die("Connection failed: " .mysqli_connect_error());
}


//Switch case for requested method
switch($method) {
    case 'POST':
        $UserName = $_POST["UserName"];
        $SpecifiedDate = $_POST["SpecifiedDate"];
        $LatLon= $_POST["LatLon"];
        $ResDateTime = $_POST["ResDateTime"];
        $ResConditions = $_POST["ResConditions"];
        $ResDescription = $_POST["ResDescription"];
        $ResIcon = $_POST["ResIcon"];
        $ResSunrise = $_POST["ResSunrise"];
        $ResSunset = $_POST["ResSunset"];
        $ResTempmax = $_POST["ResTempmax"];
        $ResTempmin = $_POST["ResTempmin"];
        $ResDew = $_POST["ResDew"];
        $ResHumidity = $_POST["ResHumidity"];
        $ResPressure = $_POST["ResPressure"];
        $ResWindspeed = $_POST["ResWindspeed"];
        $ResVisibility = $_POST["ResVisibility"];

        $sql = "INSERT INTO weather_info ( UserName, SpecifiedDate, LatLon, ResDateTime, ResConditions, ResDescription, ResIcon, ResSunrise, 
                                            ResSunset, 
                                            ResTempmax,
                                            ResTempmin, 
                                            ResDew,
                                            ResHumidity, 
                                            ResPressure,
                                            ResWindspeed, 
                                            ResVisibility)
                                           values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";
        $prep = $con->prepare($sql);
        
        $prep->bind_param("ssssssssssssssss", $UserName , $SpecifiedDate, $SpecifiedDate,
                                                            $ResDateTime,
                                                            $ResCondition,
                                                            $ResDescription,
                                                            $ResIcon,
                                                            $ResSunrie,
                                                            $ResSunset,
                                                            $ResTempmax,
                                                            $ResTempmin, 
                                                            $ResDew,
                                                            $ResHumidity,
                                                            $ResPressure, 
                                                            $ResWindspeed,
                                                            $ResVisibility );

        
        break;

    case 'GET':
        
        $sql = "SELECT * FROM weather_info";
        break;


    case 'DELETE':
        //get id from delete request URL 
        $id = $_GET['id'];

        $sql = 'DELETE FROM weather_info WHERE id ="'. $id. '"';
        break;
}

//run SQL statement
if($method == 'POST') {
    $prep->execute();

    http_response_code(200);
} else {
    $result = mysqli_query($con, $sql);

    if(!$result) {

        die(mysqli_error($con));
    }
}





// if method is get Echo the result
if($method == 'GET') {
    echo '[';
    for ($i = 0; $i<mysqli_num_rows($result) ; $i++) {
        echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
    }
    echo ']';
    //echo json_encode($result);
}

$con->close();