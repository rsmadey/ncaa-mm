<?php

include_once 'config.inc';


function safe_input($input){
    $dbhandle = mysqli_connect(HOSTNAME,MYSQL_USERNAME, MYSQL_PASSWORD,DBNAME) or die("Unable to connect");
    if(false)
    {
        $input = strip_tags(trim($input));
    }
    $safe_input = mysqli_real_escape_string($dbhandle,trim($input));
    $safe_input = trim($input);
    return $safe_input;
}

function database_query($query)
{
    $dbhandle = mysqli_connect(HOSTNAME,MYSQL_USERNAME, MYSQL_PASSWORD,DBNAME) or die("Unable to connect");
    $response = mysqli_query($dbhandle, $query);
//    $rows = mysqli_fetch_row($response);
    mysqli_close($dbhandle);

    return $response;
}

function runMySQLStatement($query)
{
    $dbhandle = mysqli_connect(HOSTNAME,MYSQL_USERNAME, MYSQL_PASSWORD,DBNAME) or die("Unable to connect");
    if(mysqli_query($dbhandle, $query)==1)
    {
	return true;
    }else{
	return false;
    }
}

function getTeamID($team_name){
    $query = "SELECT id FROM team WHERE name = '$team_name'";
    $response = database_query($query);
    $row = mysqli_fetch_row($response);
    return $row[0];
}


?>
