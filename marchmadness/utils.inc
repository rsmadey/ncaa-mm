<?php

include_once 'config.inc';


function safe_input($input){
    $dbhandle = mysqli_connect($hostname, $mysql_username, $mysqlpassword, $dbname) or die("Unable to connect");
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
    $rows = mysqli_fetch_row($response);
    mysqli_close($dbhandle);

    return $rows;
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
?>
