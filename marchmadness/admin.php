<?php
include_once 'utils.inc';



session_start();
if($_SESSION['permissions']<1)
{
    header("Location: dashboard.php");
}
$_SESSION['username'];
$_SESSION['id'];
$_SESSION['first_name'];
$_SESSION['last_name'];
$_SESSION['permissions'];

$query = "SELECT name FROM team";
$response = database_query($query);
while($row = mysqli_fetch_row($response)){
	$teams[]= $row[0];

}

$query = "SELECT round,began FROM round WHERE year = 2018";
$response = database_query($query);
$rounds = array();
while($row = mysqli_fetch_assoc($response)){
    $rounds[$row['round']] = $row['began'];
}

if(isset($_POST['startRound'])){
    $roundStart = safe_input($_POST['startRound']);
    $round = safe_input($_POST['round']);
    $query = "INSERT IGNORE INTO round (year, round, began) VALUES ('2018', $round, $roundStart) ON DUPLICATE KEY UPDATE began = $roundStart";
    runMySQLStatement($query);
    exit;
}

if(isset($_POST['setWinner'])){
    $winner = safe_input($_POST['winner']);
    $game = safe_input($_POST['game']);
    $round = safe_input($_POST['round']);


    $game_number = substr($game,1,2);
    if($game_number % 2 !=0){
	    $game_number++;
    }
    $game_number = $game_number / 2;
    $next_game = substr($game,0,1) . $game_number;


    if($winner != 'a' && $winner != 'b' && $winner != 'null' ){
	exit;
    }else if($winner == 'a'){
	$query = "SELECT favorite_id FROM game WHERE year='2018' and game_id = '$game' and round = '$round'";
	$response = database_query($query);
	$row = mysqli_fetch_row($response);
	$winner_id = $row[0];
        $query1 = "UPDATE game SET winner = '$winner_id' WHERE game_id = '$game' and round = '$round'";
    }else if($winner == 'b'){
	$query = "SELECT underdog_id FROM game WHERE year='2018' and game_id = '$game' and round = '$round'";
	$response = database_query($query);
	$row = mysqli_fetch_row($response);
	$winner_id = $row[0];
	$query = "SELECT favorite_id FROM game WHERE year='2018' and game_id = '$game' and round = '$round'";
        $query1 = "UPDATE game SET winner = '$winner_id' WHERE game_id = '$game' and round = '$round'";
	$game_number = substr($game,1,2);
    }else{
        $query1 = "UPDATE game SET winner = NULL WHERE game_id = '$game' and round = '$round'";
    }


    if(substr($game,1,2) % 2 !=0){
	$query2 = "INSERT IGNORE INTO game (year,round,game_id,favorite_id) VALUES ('2018', $round+1, '$next_game', '$winner_id') ON DUPLICATE KEY UPDATE favorite_id='$winner_id'";
    }else{
	$query2 = "INSERT IGNORE INTO game (year,round,game_id,underdog_id) VALUES ('2018', $round+1, '$next_game', '$winner_id') ON DUPLICATE KEY UPDATE underdog_id='$winner_id'";
    }
    runMySQLStatement($query1);
    runMySQLStatement($query2);
    exit;

}

if(isset($_POST['updateGame'])){
    $favorite_name = safe_input($_POST['favorite']);
    $underdog_name = safe_input($_POST['underdog']);
    $year = safe_input($_POST['year']);
    $round = safe_input($_POST['round']);
    $game = safe_input($_POST['game']);
    $winner = safe_input($_POST['winner']);
    $favorite_id = getTeamID($favorite_name);
    $underdog_id = getTeamID($underdog_name);

    $query = "INSERT IGNORE INTO game (year,round,game_id,favorite_id, underdog_id) VALUES ('$year', $round, '$game', '$favorite_id', '$underdog_id') ON DUPLICATE KEY UPDATE favorite_id='$favorite_id', underdog_id='$underdog_id', winner= $winner";
	echo $query;
    if(runMySQLStatement($query)){
	echo 'success';
    }else{
	echo 'failed';
    }
exit;
}
$query_games = "SELECT round, game_id, favorite_id, underdog_id FROM game WHERE year = '2018'";
$query_team_names = "SELECT id, name FROM team";
$games_response = database_query($query_games);
$teamNames_response = database_query($query_team_names);
$games_team_name = array();
$teamNames= array();
while($row = mysqli_fetch_assoc($teamNames_response)){
    $teamNames[$row['id']] = $row['name'];
}

while($row = mysqli_fetch_assoc($games_response)){
	$game_id_f = $row['game_id']."a";
	$game_id_u = $row['game_id']."b";
	$games_team_name[$row['round']][$game_id_f] = array($teamNames[$row['favorite_id']],$row['favorite_id']);
	$games_team_name[$row['round']][$game_id_u] = array($teamNames[$row['underdog_id']],$row['underdog_id']);
}

?>


<html>
<head>
    <meta content="text/html"; charset="UTF-8" />
    <link rel="stylesheet" href="css/admin.css">
    <script src="javascript/admin.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
</head>
<body>
<div class="bar" id="toolbar">
<button onclick="location.href='logout.php';"> logout</button>
<?php
if($_SESSION['permissions'] > 0){
    echo "<a href=dashboard.php>user page</a>";
}
?>
</div>


<div class="tab">
  <button class="tablinks" onclick="openCity(event, '64')">round of 64</button>
  <button class="tablinks" onclick="openCity(event, '64picks')">round of 64 picks</button>
  <button class="tablinks" onclick="openCity(event, '32')">round of 32</button>
  <button class="tablinks" onclick="openCity(event, '32picks')">round of 32 picks</button>
  <button class="tablinks" onclick="openCity(event, '16')">round of 16</button>
  <button class="tablinks" onclick="openCity(event, '16picks')">round of 16 picks</button>
  <button class="tablinks" onclick="openCity(event, '8')">round of 8</button>
  <button class="tablinks" onclick="openCity(event, '8picks')">round of 8 picks</button>
  <button class="tablinks" onclick="openCity(event, '4')">final 4</button>
  <button class="tablinks" onclick="openCity(event, 'discusion')">Discussion board</button>
</div>
<div id="64" class="userTab" style="width=80%">
    <h3> round of 64</h3>
    <?php include 'round_64.php'; ?>
</div>
<div id="64picks" class="userTab" style="width=80%">
    <h3> round of 64</h3>
    <div>
    <input type="checkbox" id="round1start" <?php echo ($rounds[1])?"checked=true":"";?>/>
    <button onclick='saveRound("1");'>Round has Started</button>
    </div>
    <?php
	include 'round_64_pick.php';
    ?>
</div>
<div id="32" class="userTab">
    <h3> round of 32</h3>
    <?php include 'round_32.php'; ?>
</div>
<div id="32picks" class="userTab" style="width=80%">
    <h3> round of 32</h3>
    <div>
    <input type="checkbox" id="round2start"  <?php echo ($rounds[2])?"checked=true":"";?>/>
    <button onclick='saveRound("2");'>Round has Started</button>
    </div>
    <?php
	include 'round_32_pick.php';
    ?>
</div>
<div id="16" class="userTab">
    <h3> round of 16</h3>
    <?php include 'round_16.php'; ?>
</div>
<div id="16picks" class="userTab" style="width=80%">
    <h3> round of 16</h3>
    <div>
    <input type="checkbox" id="round3start"  <?php echo ($rounds[3])?"checked=true":"";?>/>
    <button onclick='saveRound("3");'>Round has Started</button>
    </div>
    <?php
	include 'round_16_pick.php';
    ?>
</div>
<div id="8" class="userTab">
    <h3> round of 8</h3>
    <?php include 'round_8.php'; ?>
</div>
<div id="8picks" class="userTab" style="width=80%">
    <h3> round of 8</h3>
    <div>
    <input type="checkbox" id="round4start"  <?php echo ($rounds[4])?"checked=true":"checked=false";?>/>
    <button onclick='saveRound("4");'>Round has Started</button>
    </div>
    <?php
	include 'round_8_pick.php';
    ?>
</div>
<div id="4" class="userTab">
    <h3> round of 4</h3>
    <?php include 'round_4.php'; ?>
</div>
<div id="discusion" class="userTab">
    <h3> discusion board</h3>
</div>
</body>
</html>
