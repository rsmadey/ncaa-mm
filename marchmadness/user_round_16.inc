<?php
foreach($games_team_name[3] as $key => $game){
    if($team == $games_team_name[1]['e'.$x.'a']){
	    $selected = ' selected';
    }else{
	    $selected = '';
    }
    echo "<div><select id='$key'>";
    echo "<option value='".$game[$key.'a']."'>".$game[$key.'a']."</option>";
    echo "<option value='".$game[$key.'b']."'>".$game[$key.'b']."</option>";
    echo "</select>";
    echo "<button onclick=\"savePick('2018','$key',document.getElementById('$key').value,'3');\">save</button>";
    echo "</div></br>";
}
?>

