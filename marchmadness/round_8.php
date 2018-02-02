    <table class="round" style="witdh=80%">
        <tr>
            <th class="division">
                <h4>East</h4>
                <?php

                for($x=1;$x<=1;$x++){
                        echo "<div><select id='e".$x."a'>";
                        foreach($teams as $team){
                            if($team == $games_team_name[4]['e'.$x.'a'][0]){
                                $selected = ' selected';
                            }else{
                                $selected = '';
                            }
                            echo "<option id='e".$x."a' value='$team'".$selected.">".$team."</option>";
                        }
                        echo "</select><button onclick='setWinner(\"e$x\",\"a\",4);'>winner</button>".
                            "<select id='e".$x."b' selected='"."'>";
                        foreach($teams as $team){
                            if($team == $games_team_name[4]['e'.$x.'b'][0]){
                                $selected = ' selected';
                            }else{
                                $selected = '';
                            }

                            echo "<option id='e".$x."b' value='$team'".$selected.">".$team."</option>";
                        }

                        echo "</select><button onclick='setWinner(\"e$x\",\"b\",4);'>winner</button>".
                            "<button onclick='setWinner(\"e$x\", \"null\",4);'>no winner</button>".
                            "<br><button onclick=\"saveGame('2018','e$x','4',document.getElementById('e".$x."a').value,document.getElementById('e".$x."b').value,'NULL');\">save</button>".
                            "</div></br>";
                }
                ?>
            </th>
            <th class="division">
                <h4>Midwast</h4>
                <?php

                for($x=1;$x<=1;$x++){
                        echo "<div><select id='m".$x."a'>";
                        foreach($teams as $team){
                            if($team == $games_team_name[4]['m'.$x.'a'][0]){
                                $selected = ' selected';
                            }else{
                                $selected = '';
                            }
                            echo "<option id='m".$x."a' value='$team'".$selected.">".$team."</option>";
                        }
                        echo "</select><button onclick='setWinner(\"m$x\",\"a\",4);'>winner</button>".
                            "<select id='m".$x."b' selected='"."'>";
                        foreach($teams as $team){
                            if($team == $games_team_name[4]['m'.$x.'b'][0]){
                                $selected = ' selected';
                            }else{
                                $selected = '';
                            }

                            echo "<option id='m".$x."b' value='$team'".$selected.">".$team."</option>";
                        }

                        echo "</select><button onclick='setWinner(\"m$x\",\"b\",4);'>winner</button>".
                            "<button onclick='setWinner(\"m$x\", \"null\",4);'>no winner</button>".
                            "<br><button onclick=\"saveGame('2018','m$x','4',document.getElementById('m".$x."a').value,document.getElementById('m".$x."b').value,'NULL');\">save</button>".
                            "</div></br>";
                }
                ?>
            </th>
        </tr>
        <tr>
            <th class="division">
                <h4>West</h4>
                <?php

                for($x=1;$x<=1;$x++){
                        echo "<div><select id='w".$x."a'>";
                        foreach($teams as $team){
                            if($team == $games_team_name[4]['w'.$x.'a'][0]){
                                $selected = ' selected';
                            }else{
                                $selected = '';
                            }
                            echo "<option id='w".$x."a' value='$team'".$selected.">".$team."</option>";
                        }
                        echo "</select><button onclick='setWinner(\"w$x\",\"a\",4);'>winner</button>".
                            "<select id='w".$x."b' selected='"."'>";
                        foreach($teams as $team){
                            if($team == $games_team_name[4]['w'.$x.'b'][0]){
                                $selected = ' selected';
                            }else{
                                $selected = '';
                            }

                            echo "<option id='w".$x."b' value='$team'".$selected.">".$team."</option>";
                        }

                        echo "</select><button onclick='setWinner(\"w$x\",\"b\",4);'>winner</button>".
                            "<button onclick='setWinner(\"w$x\", \"null\",4);'>no winner</button>".
                            "<br><button onclick=\"saveGame('2018','w$x','4',document.getElementById('w".$x."a').value,document.getElementById('w".$x."b').value,'NULL');\">save</button>".
                            "</div></br>";
                }
                ?>
            </th>
            <th class="division">
                <h4>South</h4>
                <?php

                for($x=1;$x<=1;$x++){
                        echo "<div><select id='s".$x."a'>";
                        foreach($teams as $team){
                            if($team == $games_team_name[4]['s'.$x.'a'][0]){
                                $selected = ' selected';
                            }else{
                                $selected = '';
                            }
                            echo "<option id='s".$x."a' value='$team'".$selected.">".$team."</option>";
                        }
                        echo "</select><button onclick='setWinner(\"s$x\",\"a\",4);'>winner</button>".
                            "<select id='s".$x."b' selected='"."'>";
                        foreach($teams as $team){
                            if($team == $games_team_name[4]['s'.$x.'b'][0]){
                                $selected = ' selected';
                            }else{
                                $selected = '';
                            }

                            echo "<option id='s".$x."b' value='$team'".$selected.">".$team."</option>";
                        }

                        echo "</select><button onclick='setWinner(\"s$x\",\"b\",4);'>winner</button>".
                            "<button onclick='setWinner(\"s$x\", \"null\",4);'>no winner</button>".
                            "<br><button onclick=\"saveGame('2018','s$x','4',document.getElementById('s".$x."a').value,document.getElementById('s".$x."b').value,'NULL');\">save</button>".
                            "</div></br>";
                }
                ?>
            </th>
        </tr>
    </table>
 
