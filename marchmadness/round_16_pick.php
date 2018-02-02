<?php
include_once 'utils.inc';
$round = '3';

$query_games = "SELECT round, game_id, favorite_id, underdog_id FROM game WHERE year = '2018' AND round = $round";
$games_response = database_query($query_games);

$set_games = array();
while($row = mysqli_fetch_assoc($games_response)){
        $game_id_f = $row['game_id']."a";
        $game_id_u = $row['game_id']."b";
        $set_games[$row['round']][$row['game_id']][$game_id_f] = $teamNames[$row['favorite_id']];
        $set_games[$row['round']][$row['game_id']][$game_id_u] = $teamNames[$row['underdog_id']];
}
$query_picks = "SELECT user_id, game_id, team_id FROM pick WHERE year = 2018 AND round = $round";
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


echo '<table class="round">';
echo '<thead><tr><th></th>';
foreach($players as $player){
    echo "<th class='rotate'><div><span>".$player[0]." ".$player[1]."</span></div></th>";
}
echo '</tr>';
foreach($set_games[3] as $key => $game){
    echo '<tr>';
    echo "<th><span>".$game[$key."a"]."</span></th>";
    foreach($players as $player_key => $player){
	if($teamNames[$player_picks[$player_key][$key]] == $game[$key."a"]){
	echo "<th>X</th>";
	}else{
	    echo "<th></th>";
	}
    }
    echo '</tr>';
    echo '<tr>';
    echo "<th>".$game[$key."b"]."</th>";
    foreach($players as $player_key => $player){
	if($teamNames[$player_picks[$player_key][$key]] == $game[$key."b"]){
	echo "<th>X</th>";
	}else{
	    echo "<th></th>";
	}
    }
    echo '</tr>';
}
echo '</table>';
?>
