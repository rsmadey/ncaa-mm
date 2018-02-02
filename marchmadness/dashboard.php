<?php
include_once 'utils.inc';

session_start();
if(!isset($_SESSION['username']))
{
    header("Location: login.php");
}

$query = "SELECT round,began FROM round WHERE year = 2018";
$response = database_query($query);
$rounds = array();
while($row = mysqli_fetch_assoc($response)){
    $rounds[$row['round']] = $row['began'];
}


/*
$_SESSION['username'];
$_SESSION['id'];
$_SESSION['first_name'];
$_SESSION['last_name'];
$_SESSION['permissions'];
*/
$user_id = $_SESSION['id'];

if(isset($_POST['updatePick'])){

    $game_id = safe_input($_POST['game']);
    $pick = safe_input($_POST['pick']);
    $pick = getTeamID($pick);
    $round = safe_input($_POST['round']);

    $open_round_query = "SELECT began FROM round WHERE year=2018 AND round = $round";
    $response = database_query($open_round_query);
    $row = mysqli_fetch_row($response);
    if($row[0] == 0){
        $query = "INSERT IGNORE INTO pick (user_id,game_id,team_id,round,year) VALUES ('$user_id', '$game_id','$pick','$round',2018) ON DUPLICATE KEY UPDATE team_id='$pick'";
	echo $query;
        if(runMySQLStatement($query)){
            echo 'success';
        }else{
            echo 'failed';
        }
    }
    exit;
}
$query_team_names = "SELECT id, name FROM team";
$teamNames_response = database_query($query_team_names);
$teamNames = array();
while($row = mysqli_fetch_assoc($teamNames_response)){
    $teamNames[$row['id']] = $row['name'];
}


$query_games = "SELECT round, game_id, favorite_id, underdog_id FROM game WHERE year = '2018'";
$games_response = database_query($query_games);


$games_team_names = array();

while($row = mysqli_fetch_assoc($games_response)){
        $game_id_f = $row['game_id']."a";
        $game_id_u = $row['game_id']."b";
        $games_team_name[$row['round']][$row['game_id']][$game_id_f] = $teamNames[$row['favorite_id']];
        $games_team_name[$row['round']][$row['game_id']][$game_id_u] = $teamNames[$row['underdog_id']];
}
$query_picks = "SELECT round, game_id, pick FROM pick WHERE user_id='".$_SESSION['id']."' and year = 2018";
$picks_response = database_query($query_games);

while($row = mysqli_fetch_assoc($picks_response)){
    
}

?>


<html>
<head>
    <meta content="text/html"; charset="UTF-8" />
    <link rel="stylesheet" href="css/dashboard.css">
    <script src="javascript/dashboard.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>

</head>
<body>
<h1> March Madness 2018</h1>
<?php
if($_SESSION['username']=='ie'){
	echo "<p>hello bob</p>";
}
?>
<div class="bar" id="toolbar">
<button onclick="location.href='logout.php';"> logout</button>
<?php
if($_SESSION['permissions'] > 0){
    echo "<a href=admin.php>admin page</a>";
}
?>
</div>

<div class="tab-block" id="user-tabs">
<div class="tab">
  <button class="tablinks" onclick="openTab(event, '64')">round of 64</button>
<?php echo ($rounds[1])?'<button class="tablinks" onclick="openTab(event, \'64picks\')">round of 64 picks</button>':"";?>
  <button class="tablinks" onclick="openTab(event, '32')">round of 32</button>
<?php echo ($rounds[2])?'<button class="tablinks" onclick="openTab(event, \'32picks\')">round of 32 picks</button>':"";?>
  <button class="tablinks" onclick="openTab(event, '16')">round of 16</button>
<?php echo ($rounds[3])?'<button class="tablinks" onclick="openTab(event, \'16picks\')">round of 16 picks</button>':"";?>
  <button class="tablinks" onclick="openTab(event, '8')">round of 8</button>
<?php echo ($rounds[4])?'<button class="tablinks" onclick="openTab(event, \'8picks\')">round of 8 picks</button>':"";?>
  <button class="tablinks" onclick="openTab(event, '4')">round of 4</button>
<?php echo ($rounds[5])?'<button class="tablinks" onclick="openTab(event, \'4picks\')">round of 4 picks</button>':"";?>
  <button class="tablinks" onclick="openTab(event, 'discusion')">Discussion board</button>
</div>
<div id="64" class="userTab">
    <h3> round of 64</h3>
                <h4>East</h4>
		<?php include 'user_round_64.inc';?>
</div>
<div id="64picks" class="userTab">
    <h3> round of 64 picks</h3>
	    <?php ($rounds[1])?include 'round_32_pick.php':''?>

</div>
<div id="32" class="userTab">
    <h3> round of 32</h3>
		<?php include 'user_round_32.inc';?>
</div>
<div id="32picks" class="userTab">
    <h3> round of 32 picks</h3>
	    <?php ($rounds[2])?include 'round_32_pick.php':''?>

</div>
<div id="16" class="userTab">
    <h3> round of 16</h3>
		<?php include 'user_round_16.inc';?>
</div>
<div id="16picks" class="userTab">
    <h3> round of 16 picks</h3>
	    <?php ($rounds[3])?include 'round_32_pick.php':''?>
	    <?php include 'round_16_pick.php';?>

</div>
<div id="8" class="userTab">
    <h3> round of 8</h3>
		<?php include 'user_round_8.inc';?>
</div>
<div id="8picks" class="userTab">
    <h3> round of 8 picks</h3>
	    <?php ($rounds[4])?include 'round_32_pick.php':''?>
	    <?php include 'round_8_pick.php';?>

</div>
<div id="4" class="userTab">
    <h3> round of 4</h3>
</div>
<div id="4picks" class="userTab">
    <h3> round of 4 picks</h3>
	    <?php ($rounds[5])?include 'round_32_pick.php':''?>

</div>
<div id="discusion" class="userTab">
    <h3> discusion board</h3>
<table class="round" style="witdh=80%">
        <tr>
            <th class="division">
            </th>
	    <th class="division">
                <h4>Midwest</h4>
            </th>
        </tr>
        <tr>
            <th class="division">
                <h4>West</h4>
            </th>
            <th class="division">
                <h4>South</h4>
            </th>
        </tr>
    </table>

</div>
</div>
</body>
</html>
