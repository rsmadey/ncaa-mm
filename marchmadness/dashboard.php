<?php
include_once 'utils.inc';

session_start();
if(!isset($_SESSION['username']))
{
    header("Location: login.php");
}

/*
$_SESSION['username'];
$_SESSION['id'];
$_SESSION['first_name'];
$_SESSION['last_name'];
$_SESSION['permissions'];
*/

if(isset($_POST['updatePick'])){
    $user_id = $_SESSION['id'];


    $game_id = safe_input($_POST['game']);
    $pick = safe_input($_POST['pick']);
    $pick = getTeamID($pick);

    $query = "INSERT IGNORE INTO pick (user_id,game_id,team_id,year) VALUES ('$user_id', '$game_id','$pick',2018) ON DUPLICATE KEY UPDATE team_id='$pick'";
    if(runMySQLStatement($query)){
        echo 'success';
    }else{
        echo 'failed';
    }
exit;
}
$query_team_names = "SELECT id, name FROM team";
$teamNames_response = database_query($query_team_names);
$teamNames = array();
while($row = mysqli_fetch_assoc($teamNames_response)){
    $teamNames[$row['id']] = $row['name'];
}

$_SESSION['id'] = 1;

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


<div class="tab">
  <button class="tablinks" onclick="openCity(event, '64')">round of 64</button>
  <button class="tablinks" onclick="openCity(event, '32')">round of 32</button>
  <button class="tablinks" onclick="openCity(event, 'discusion')">Discussion board</button>
</div>
<div id="64" class="userTab">
    <h3> round of 64</h3>
                <h4>East</h4>
                <?php
		foreach($games_team_name[1] as $key => $game){
		    if($team == $games_team_name[1]['e'.$x.'a']){
			$selected = ' selected';
		    }else{
			$selected = '';
		    }
		    echo "<div><select id='$key'>";
		    echo "<option value='".$game[$key.'a']."'>".$game[$key.'a']."</option>";
		    echo "<option value='".$game[$key.'b']."'>".$game[$key.'b']."</option>";
		    echo "</select>";
		    echo "<button onclick=\"savePick('2018','$key',document.getElementById('$key').value);\">save</button>";
		}
		    echo "</div></br>";
                ?>
</div>
<div id="32" class="userTab">
    <h3> round of 32</h3>
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
</body>
</html>
