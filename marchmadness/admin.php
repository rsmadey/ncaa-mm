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
	$games_team_name[$row['round']][$game_id_f] = $teamNames[$row['favorite_id']];
	$games_team_name[$row['round']][$game_id_u] = $teamNames[$row['underdog_id']];
}

$query_users = "SELECT id,username, first_name, last_name FROM user";
$users_response = database_query($query_users);

$query_games = "SELECT round, game_id, favorite_id, underdog_id FROM game WHERE year = '2018'";
$games_response = database_query($query_games);

$set_games = array();

while($row = mysqli_fetch_assoc($games_response)){
        $game_id_f = $row['game_id']."a";
        $game_id_u = $row['game_id']."b";
        $set_games[$row['round']][$row['game_id']][$game_id_f] = $teamNames[$row['favorite_id']];
        $set_games[$row['round']][$row['game_id']][$game_id_u] = $teamNames[$row['underdog_id']];
}
$query_picks = "SELECT user_id, game_id, team_id FROM pick WHERE year = 2018";
$picks_response = database_query($query_picks);
$player_picks = array();
while($row = mysqli_fetch_assoc($picks_response)){
    $player_picks[$row['user_id']][$row['game_id']] = $row['team_id'];
}
$query_users = "SELECT id, username,first_name, last_name FROM user";
$users_response = database_query($query_users);
$players = array();
while($row = mysqli_fetch_assoc($users_response)){
    $players[$row['id']][0]=$row['username'];
    $players[$row['id']][1]=$row['first_name'];
    $players[$row['id']][2]=$row['last_name'];
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
  <button class="tablinks" onclick="openCity(event, 'discusion')">Discussion board</button>
</div>
<div id="64" class="userTab" style="width=80%">
    <h3> round of 64</h3>
    <table class="round" style="witdh=80%">
	<tr>
	    <th class="division">
		<h4>East</h4>
		<?php
		
		for($x=1;$x<=8;$x++){
			echo "<div><select id='e".$x."a'>";
			foreach($teams as $team){
			    if($team == $games_team_name[1]['e'.$x.'a']){
				$selected = ' selected';
			    }else{
				$selected = '';
			    }
			    echo "<option id='e".$x."a' value='$team'".$selected.">".$team."</option>";
			}
			echo "</select><input type='radio' name='e'>".
			    "<select id='e".$x."b' selected='"."'>";
			foreach($teams as $team){
			    if($team == $games_team_name[1]['e'.$x.'b']){
				$selected = ' selected';
			    }else{
				$selected = '';
			    }

			    echo "<option id='e".$x."b' value='$team'".$selected.">".$team."</option>";
			}
			    	
			echo "</select><input type='radio' name='e".$x."'>".
			    "<button onclick=\"saveGame('2018','e".$x."','1',document.getElementById('e".$x."a').value,document.getElementById('e".$x."b').value,'NULL');\">save</button>".
			    "<button onsubmit='clearoptions(e".$x.");'>clear</button>".
			    "</div></br>";
		}
		?>
	    </th>
	    <th class="division">
		<h4>Midwest</h4>
		<?php
		
		for($x=1;$x<=8;$x++){
			echo "<div><select id='m".$x."a'>";
			foreach($teams as $team){
			    if($team == $games_team_name[1]['m'.$x.'a']){
				$selected = ' selected';
			    }else{
				$selected = '';
			    }
			    echo "<option id='m".$x."a' value='$team'".$selected.">".$team."</option>";
			}
			echo "</select><input type='radio' name='m'>".
			    "<select id='m".$x."b' selected='"."'>";
			foreach($teams as $team){
			    if($team == $games_team_name[1]['m'.$x.'b']){
				$selected = ' selected';
			    }else{
				$selected = '';
			    }

			    echo "<option id='m".$x."b' value='$team'".$selected.">".$team."</option>";
			}
			    	
			echo "</select><input type='radio' name='m".$x."'>".
			    "<button onclick=\"saveGame('2018','m".$x."','1',document.getElementById('m".$x."a').value,document.getElementById('m".$x."b').value,'NULL');\">save</button>".
			    "<button onsubmit='clearoptions(m".$x.");'>clear</button>".
			    "</div></br>";
		}
		?>
	    </th>
	</tr>
	<tr>
	    <th class="division">
		<h4>West</h4>
		<?php
		
		for($x=1;$x<=8;$x++){
			echo "<div><select id='w".$x."a'>";
			foreach($teams as $team){
			    if($team == $games_team_name[1]['w'.$x.'a']){
				$selected = ' selected';
			    }else{
				$selected = '';
			    }
			    echo "<option id='w".$x."a' value='$team'".$selected.">".$team."</option>";
			}
			echo "</select><input type='radio' name='w'>".
			    "<select id='w".$x."b' selected='"."'>";
			foreach($teams as $team){
			    if($team == $games_team_name[1]['w'.$x.'b']){
				$selected = ' selected';
			    }else{
				$selected = '';
			    }

			    echo "<option id='w".$x."b' value='$team'".$selected.">".$team."</option>";
			}
			    	
			echo "</select><input type='radio' name='w".$x."'>".
			    "<button onclick=\"saveGame('2018','w".$x."','1',document.getElementById('w".$x."a').value,document.getElementById('w".$x."b').value,'NULL');\">save</button>".
			    "<button onsubmit='clearoptions(e".$x.");'>clear</button>".
			    "</div></br>";
		}
		?>
	    </th>
	    <th class="division">
		<h4>South</h4>
		<?php
		
		for($x=1;$x<=8;$x++){
			echo "<div><select id='s".$x."a'>";
			foreach($teams as $team){
			    if($team == $games_team_name[1]['s'.$x.'a']){
				$selected = ' selected';
			    }else{
				$selected = '';
			    }
			    echo "<option id='s".$x."a' value='$team'".$selected.">".$team."</option>";
			}
			echo "</select><input type='radio' name='s'>".
			    "<select id='s".$x."b' selected='"."'>";
			foreach($teams as $team){
			    if($team == $games_team_name[1]['s'.$x.'b']){
				$selected = ' selected';
			    }else{
				$selected = '';
			    }

			    echo "<option id='s".$x."b' value='$team'".$selected.">".$team."</option>";
			}
			    	
			echo "</select><input type='radio' name='s".$x."'>".
			    "<button onclick=\"saveGame('2018','s".$x."','1',document.getElementById('s".$x."a').value,document.getElementById('s".$x."b').value,'NULL');\">save</button>".
			    "<button onsubmit='clearoptions(e".$x.");'>clear</button>".
			    "</div></br>";
		}
		?>
	    </th>
	</tr>
    </table>

</div>
<div id="64picks" class="userTab" style="width=80%">
    <h3> round of 64</h3>
    <div>
    <input type="checkbox" id="round64start" />
    <button onclick='saveRound("64");'>Round has Started</button>
    </div>
    <?php
	include 'round_64_pick.php';
    ?>
</div>
<div id="32" class="userTab">
    <h3> round of 32</h3>
    <?php include 'round_32.php'; ?>
</div>
<div id="discusion" class="userTab">
    <h3> discusion board</h3>
</div>
</body>
</html>
