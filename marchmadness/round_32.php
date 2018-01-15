 <table class="round" style="witdh=80%">
        <tr>
            <th class="division">
                <h4>East</h4>
                <?php

                for($x=1;$x<=4;$x++){
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

                for($x=1;$x<=4;$x++){
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

                for($x=1;$x<=4;$x++){
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

                for($x=1;$x<=4;$x++){
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

