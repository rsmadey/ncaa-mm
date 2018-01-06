<?php
require_once 'config.inc';
require_once 'utils.inc';
ob_start();
session_start();
if($_SESSION['username']!=null && isset($_SESSION['username']))
{
    header("Location: dashboard.php");
}
if(isset($_POST['login']))
{
    require_once 'utils.inc';
    $response = database_query($query);
    $login_user = safe_input($_POST['luser']);
    $login_password = safe_input($_POST['lpass']);
    $query = "SELECT id,username,first_name,last_name,permissions FROM user WHERE username = '$login_user' and password = '". MD5($login_password) . "'";
    $response = database_query($query);
    if(isset($response))
    {
	$_SESSION['username']=$login_user;
	$_SESSION['id']=$response[0];
	$_SESSION['first_name']=$response[2];
	$_SESSION['last_name']=$response[3];
	$_SESSION['permissions']=$response[4];
	echo "dashboard.php";
    }else{
	echo "login.php?login=failed";
    }
    exit;
}
if(isset($_POST['createUser']))
{
    $user = safe_input($_POST['user']);
    $first = safe_input($_POST['first']);
    $last = safe_input($_POST['last']);
    $pass1 = safe_input($_POST['pass1']);
    $pass2 = safe_input($_POST['pass2']);
    if(is_null($user) ||
	is_null($first) ||
	is_null($last) ||
	is_null($pass1)){
	echo "failre";
	exit;
    }
    if($pass1 == $pass2)
    {
	$query = "INSERT INTO user (username, first_name, last_name, password) VALUE ('$user', '$first', '$last','" . md5($pass1) . "')";
	if(runMySQLStatement($query))
	{
	    echo "success";
	}else{
	    echo "failed insert";
	}
    }else{
	echo "failed password";
    }
    exit;
}
?>


<html>
<head>
    <meta content="text/html"; charset="UTF-8" />
    <link rel="stylesheet" href="css/styles.css">
    <script src="javascript/login.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
</head>
<body>
<div class="tab active">

    <div class="form">
        <h2>March Madness 2018</h2>

        <ul class="tab-switch">
            <li class="tab active"><a href="#login">Log In</a></li>
            <li class="tab"><a href="#signup">Sign Up</a></li>
        </ul>

        <div id="login">

            <h3>login</h3>

            <form method="post" id="login" onsubmit="action=login();"> 
                <input type="text" id="loginusername" placeholder="username" />
                <input type="text" id="loginpassword" placeholder="password" />
                <div>
                    <button type="submit" id="loginsubmit" class="button submit-block">enter</button>
                </div>
            </form>
	    <?php 
		if($_GET['login']=='failed')
		{
			echo '<p>login failed</p>';
		} 
	    ?>

        </div>

        <div id="signup">
            <h3>sign up</h3>
	    <?php
		if($_GET['newuser']=='success'){
		echo '<p>new user added</p>';
		}
		if($_GET['newuser']=='fpass'){
		echo '<p>passwords must match</p>';
		}
		if($_GET['newuser']=='insert'){
		echo '<p>username already taken</p>';
		}

	    ?>
            <form  method="post" id="createuser" onsubmit="action=createUser();";>
		<div>
		    <input type="text" id="firstname" placeholder="First Name"/>
		    <input type="text" id="lastname" placeholder="Last Name"/>
		</div>
                <input type="text" id="username" placeholder="username" />
                <div>
                    <input type="text" id="password" placeholder="password" />
                    <input type="text" id="password2" placeholder="retype password" />
                </div>
                <button type="submit" id="createusersubmit" class="button submit-block">enter</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
