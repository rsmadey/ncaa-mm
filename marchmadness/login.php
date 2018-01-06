<?php
require_once 'config.inc';
require_once 'utils.inc';
session_start();
if(isset($_POST['login']))
{
    $login_user = safe_input($_POST['luser']);
    $login_password = safe_input($_POST['lpass']);
    $query = "SELECT id,username,first_name,last_name,permissions FROM user WHERE username = $login_user and password = '". MD5($login_password) . "'";
    $reponse = database_query($query);
    echo $response;
//    return database_query($query);
    //if($row=mysqli_fetch_row($response) && false)
    if(false)
    {
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
    if($pass1 == $pass2)
    {
	$query = "INSERT INTO user (username, first_name, last_name, password) VALUE ($user, $first, $last," . md5($pass1) . ")";
	echo "success";
    }else{
	echo "failure";
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
            <form  method="post" id="createuser">
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
