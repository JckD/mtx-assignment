CREATE TABLE weather_info (
	id int AUTO_INCREMENT,
	UserName varchar(10),
    SpecifiedDate date,
    LatLon varchar(30),
    ResDateTime date,
    ResConditions varchar(50),
    ResDescription varchar(150),
    ResIcon varchar(50),
    ResSunrise varchar(20),
    ResSunset varchar(20),
    ResTempmax float(4),
    ResTempmin float(4),
    ResDew float(4),
    ResHumidity float(4),
    ResPressure float(4),
    ResWindspeed float(4),
    ResVisibility float(4),
    Primary Key (id)
    
)