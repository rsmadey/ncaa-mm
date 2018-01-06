<?php
session_start();
if(!isset($_SESSION['username']))
{
    header("Location: login.php");
}
$_SESSION['username'];
$_SESSION['id'];
$_SESSION['first_name'];
$_SESSION['last_name'];
$_SESSION['permissions'];




?>


<html>
<h1> log in successful</h1>
<?php
if($_SESSION['username']=='ie'){
	echo "<p>hello bob</p>";
}
echo "<p>".$_SESSION['username']
. $_SESSION['id'][0]. "\n"
. $_SESSION['first_name']
. $_SESSION['last_name']
. $_SESSION['permissions']. "<\p>";
?>
<button onclick="location.href='logout.php';"> logout</button>

</html>
