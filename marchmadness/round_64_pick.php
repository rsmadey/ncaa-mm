<?php
echo '<table class="round">';
echo '<thead><tr><th></th>';
foreach($players as $player){
    echo "<th class='rotate'><div><span>".$player[0]." ".$player[1]."</span></div></th>";
}
echo '</tr>';
foreach($set_games[1] as $key => $game){
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
