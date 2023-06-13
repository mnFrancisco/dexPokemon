<?php
include_once("layout/head.php");
$servername = "localhost";
$username = "root";
$password = "";
$banco = "rpg";
$id = $_SESSION['id'];
$msg ='';
// Create connection
$conn = new mysqli($servername, $username, $password, $banco);

// Check connection
if ($conn->connect_error) {
  die("Erro: " . $conn->connect_error);
}else{
  
    if(isset($_POST['nome']) != null){
        $nome = strtolower($_POST['nome']);
    
        if($nome == 'mimikyu'){
            $nome = 'mimikyu-disguised';
        } elseif($nome == 'giratina'){
            $nome = 'giratina-altered';
        }
    
        // Faz a chamada da API do Pokémon
        $api_url = "https://pokeapi.co/api/v2/pokemon/".$nome;
    
        $response = file_get_contents($api_url);
        $pokemon_data = json_decode($response, true);
    
        // Extrai os dados do Pokémon da resposta da API
    
        // Obtém os tipos do pokemon
        $tipos_do_pokemon = [];
        foreach ($pokemon_data['types'] as $tipo) {
            $tipos_do_pokemon[] = $tipo['type']['name'];
        }
    
        $tipo = implode(", ", $tipos_do_pokemon);
    
        // Pega os status dos pokemon
        $hp = $pokemon_data['stats'][0]['base_stat'];
        $atk = $pokemon_data['stats'][1]['base_stat'];
        $satk = $pokemon_data['stats'][3]['base_stat'];
        $def = $pokemon_data['stats'][2]['base_stat'];
        $sdef = $pokemon_data['stats'][4]['base_stat'];
        $speed = $pokemon_data['stats'][5]['base_stat'];
    
        $t_type = $_POST['t_type'];
        $lv = $_POST['lv'];
        $regiao = $_POST['regiao'];
        $hab = $_POST['hab'];
        $nature = $_POST['nature'];
        $xp = $_POST['xp'];
        $ami = $_POST['ami'];
        $moves = $_POST['moves'];
        //$tcap = $_POST['tcap'];
        //$desloc = floor($speed / 10);
        $shiny = $_POST['shiny'];

        if ($nature == 'serious') {
            $speed= $speed + $speed * 0.1;
        }
        if ($nature == 'bashful') {
            $satk= $satk+ $satk * 0.1;
        }
        if ($nature == 'docile') {
            $def= $def + $def *0.1;
        }
        if ($nature == 'hardy') {
            $atk= $atk + $atk * 0.1;
        }
        if ($nature == 'quirky') {
            $sdef=$sdef + $sdef * 0.1;

        }
        //Condição para não roda a API direto
        if($nature == 'serious' && $nature == 'bashful' && $nature == 'docile' && $nature == 'hardy' && $nature == 'quirky') {

            echo '';

        }else{
            // pega os dados da nature
            $api_link = "https://pokeapi.co/api/v2/nature/".strtolower($_POST['nature']);
            $response = file_get_contents($api_link);
            $dados_nature = json_decode($response, true);
      
            $nature_name= $dados_nature['name'];
            $increased_stat = $dados_nature["increased_stat"]["name"];
            $decreased_stat = $dados_nature["decreased_stat"]["name"];
      
            // calculo da nature Naughty/safadinho
            if($nature_name == 'naughty'){
                if($increased_stat == 'attack'){
                    $atk = $atk + $atk * 0.1;
                }if($decreased_stat == 'special-defense'){
                    $sdef = $sdef - $sdef * 0.1;
                }
            }
            // calculo da nature lonely/solitario
            if($nature_name == 'lonely'){
                if($increased_stat == 'attack'){
                    $atk = $atk + $atk * 0.1;
                }if($decreased_stat == 'defense'){
                    $def = $def - $def *0.1;
                }
            }
            // calculo da nature brave/valente
            if($nature_name == 'brave'){
                if($increased_stat == 'attack'){
                    $atk = $atk + $atk *0.1;
                }if($decreased_stat == 'speed'){
                    $speed = $speed - $speed * 0.1;
                }
            }
            // calculo da nature adamant
            if($nature_name == 'adamant'){
                if($increased_stat == 'attack'){
                    $atk = $atk + $atk * 0.1;
                }if($decreased_stat == 'special-attack'){
                    $satk = $satk - $satk * 0.1;
                }
            }
            // calculo da nature bold
            if($nature_name == 'bold'){
                if($increased_stat == 'defense'){
                    $def = $def + $def * 0.1;
                }if($decreased_stat == 'attack'){
                    $atk = $atk - $atk * 0.1;
                }
            }
            // calculo da nature relaxed/relaxado
            if($nature_name == 'relaxed'){
                if($increased_stat == 'defense'){
                    $def = $def + $def * 0.1;
                }if($decreased_stat == 'speed'){
                    $speed = $speed - $speed * 0.1;
                }
            }
            // calculo da nature impish
            if($nature_name == 'impish'){
                if($increased_stat == 'defense'){
                    $def = $def + $def * 0.1;
                }if($decreased_stat == 'special-attack'){
                    $satk = $satk - $satk * 0.1;
                }
            }
            // calculo da nature lax
            if($nature_name == 'lax'){
                if($increased_stat == 'defense'){
                    $def = $def + $def * 0.1;
                }if($decreased_stat == 'special-defense'){
                     $sdef = $sdef - $sdef * 0.1;
                }
            }
            // calculo da nature timid/timido
            if($nature_name == 'timid'){
                if($increased_stat == 'speed'){
                    $speed = $speed + $speed * 0.1;
                }if($decreased_stat == 'attack'){
                    $atk = $atk - $atk * 0.1;
                }
            }
            // calculo da nature hasty/apresado
            if($nature_name == 'hasty'){
                if($increased_stat == 'speed'){
                    $speed = $speed + $speed * 0.1;
                }if($decreased_stat == 'defense'){
                    $def = $def - $def * 0.1;
                }
            }
            // calculo da nature jolly/
            if($nature_name == 'jolly'){
                if($increased_stat == 'speed'){
                    $speed = $speed + $speed * 0.1;
                }if($decreased_stat == 'special-attack'){
                    $satk = $satk - $satk * 0.1;
                }
            }
            // calculo da nature naive/
            if($nature_name == 'naive'){
                if($increased_stat == 'speed'){
                    $speed = $speed + $speed * 0.1;
                }if($decreased_stat == 'special-defense'){
                    $sdef = $sdef - $sdef * 0.1;
                }
            }
            // calculo da nature modest/modesto
            if($nature_name == 'modest'){
                if($increased_stat == 'special-attack'){
                    $satk = $satk + $satk * 0.1;
                }if($decreased_stat == 'attack'){
                    $atk = $atk - $atk * 0.1;
                }
            }
            // calculo da nature mild/
            if($nature_name == 'mild'){
                if($increased_stat == 'special-attack'){
                    $satk = $satk + $satk * 0.1;
                }if($decreased_stat == 'defense'){
                    $def = $def - $def * 0.1;
                }
            }
            // calculo da nature quiet/
            if($nature_name == 'quiet'){
                if($increased_stat == 'special-attack'){
                    $satk = $satk + $satk * 0.1;
                }if($decreased_stat == 'speed'){
                    $speed = $speed - $speed * 0.1;
                }
            }
            // calculo da nature rash/
            if($nature_name == 'rash'){
                if($increased_stat == 'special-attack'){
                    $satk = $satk + $satk * 0.1;
                }if($decreased_stat == 'special-defense'){
                    $sdef = $sdef - $sdef * 0.1;
                }
            }
            // calculo da nature calm/
            if($nature_name == 'calm'){
                if($increased_stat == 'special-defense'){
                    $sdef = $sdef + $sdef * 0.1;
                    
                }if($decreased_stat == 'attack'){
                    $atk = $atk - $atk * 0.1;
                    
                }
            }
            // calculo da nature gentle/
            if($nature_name == 'gentle'){
                if($increased_stat == 'special-defense'){
                    $sdef = $sdef + $sdef * 0.1;
                
                }if($decreased_stat == 'defense'){
                    $def = $def - $def * 0.1;
                    
                }
            }
            // calculo da nature sassy/
            if($nature_name == 'sassy'){
                if($increased_stat == 'special-defense'){
                    $sdef = $sdef + $sdef * 0.1;
                
                }if($decreased_stat == 'speed'){
                    $speed = $speed - $speed * 0.1;
                    
                }
            }
            // calculo da nature careful/
            if($nature_name == 'careful'){
                if($increased_stat == 'special-defense'){
                    $sdef = $sdef + $sdef * 0.1;
                    
                }if($decreased_stat == 'special-attack'){
                    $satk = $satk - $satk * 0.1;
                    
                }
            }
        }

        $sqlM = "INSERT INTO poke (id_per, nome, tipo, regiao, hab, nature, xp, lv, hp, atk, satk, def, sdef, speed, ami, moves, shyni, t_type) 
        VALUES ($id, '$nome', '$tipo', '$regiao', '$hab', '$nature', $xp, $lv, $hp, $atk, $satk, $def, $sdef, $speed, $ami, '$moves','$shiny', '$t_type')";
    
        if ($conn->query($sqlM) === TRUE) {
            $msg = $nome." Registrado com sucesso!\n";
        } else {
            $msg = "Erro ao cadastrar o Pokémon. Verifique se as informações estão corretas!";
        }
    
        echo $msg;
    }
    


    $conn->close();

}
 
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
    
    
        <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12  ">
                    <?php echo $msg;?>
                    <div class="x_panel">
                        
                        <div class="x_title">
                        <h2>Novo Pokemon</h2>
                        <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                        <div class="x_content">
                            <form enctype="multipart/form-data" action="novo_poke.php" method="post" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nome<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="nome" id="last-name" required="required" class="form-control">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Tera type<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="t_type" id="last-name" required="required" class="form-control">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Habilit<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="hab" id="last-name" required="required" class="form-control">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nature<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="nature" id="last-name" required="required" class="form-control" placeholder="em inglês">
                                    </div>
                                </div>
                                
              

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nivel<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="number" name="lv" id="last-name" required="required" class="form-control">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Xp<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="number" name="xp" id="last-name" required="required" class="form-control">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Amizade<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="number" name="ami" id="last-name" required="required" class="form-control">
                                    </div>
                                </div>         

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Região<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="regiao" id="last-name" required="required" class="form-control" placeholder="Preencher só se for de Paldeia ">
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Moves<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="moves" id="last-name" required="required" class="form-control">
                                    </div>
                                </div>

                                <!--<div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Tipo de captura<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="select2_group form-control" name="tcap">
                                            <option value="Pokebola" name="cap">Pokebola</option>
                                            <option value="Recompensa" name="cap">Recompensa</option>
                                            <option value="Presente" name="cap">Presente</option>
                                            <option value="Ovo" name="cap">Ovo</option>
                                            <option value="Focil" name="cap">Focil</option>
                                        </select>
                                    </div>
                                </div>-->

                                <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Normal<span class="required">*</span>
                                    </label>
                                    <div class="col-md-2 col-sm-2">
                                        <input type="checkbox" name="shiny" id="last-name" class="form-control" value="normal">
                                    </div>

                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Shyni<span class="required">*</span>
                                    </label>
                                    <div class="col-md-3 col-sm-3 ">
                                        <input type="checkbox" name="shiny" id="last-name" class="form-control" value="shiny">
                                    </div>
                                </div>
                                
                                <div class="ln_solid"></div>
                                <div class="item form-group">
                                    <div class="col-md-6 col-sm-6 offset-md-3">
                                        <input type="submit" value="Enviar" class="btn btn-success">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<?php
include_once("layout/footer.php");
?>