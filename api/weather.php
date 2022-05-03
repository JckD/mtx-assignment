<?php 

$host = "localhost";
$user = "JD";
$pw = '21stCentury';
$dbname = 'timelineweather';
$id = '';

$con = mysqli_connect($host, $user, $pw, $dbname);

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));


if(!$con) {
    die("Connection failed: " .mysqli_connect_error());
}


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
                                           values ('$UserName','$SpecifiedDate','$LatLon','$ResDateTime','$ResConditions','$ResDescription','$ResIcon','$ResSunrise','$ResSunset','$ResTempmax','$ResTempmin','$ResDew','$ResHumidity','$ResPressure','$ResWindspeed','$ResVisibility') ";
    break;

}

//run SQL statement
$result = mysqli_query($con, $sql);

if(!$result) {
    http_response_code(404);
    die(mysqli_error($con));
}

$con->close();