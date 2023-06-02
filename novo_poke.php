<?php
include_once("layout/head.php");
$servername = "localhost";
$username = "root";
$password = "";
$banco = "rpg";
$id = $_SESSION['id'];

// Create connection
$conn = new mysqli($servername, $username, $password, $banco);

// Check connection
if ($conn->connect_error) {
  die("Erro: " . $conn->connect_error);
}else{
  
  if(isset($_POST['nome']) != null){
        $nome = strtolower($_POST['nome']);

        if($nome == 'mimikyu'){
            $nome= 'mimikyu-disguised';
        }elseif($nome == 'giratina'){
            $nome= 'giratina-altered';
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

        $tipo=implode(", ", $tipos_do_pokemon);

        //Pega os status dos pokemon
        
        $hp = $pokemon_data['stats'][0]['base_stat'];
        $atk = $pokemon_data['stats'][1]['base_stat'];
        $satk = $pokemon_data['stats'][2]['base_stat'];
        $def = $pokemon_data['stats'][3]['base_stat'];
        $sdef = $pokemon_data['stats'][4]['base_stat'];
        $speed = $pokemon_data['stats'][5]['base_stat'];
        
        //$t_type= $_POST['t_type'];
        $lv = $_POST['lv'];
        $regiao= $_POST['regiao'];
        $hab = $_POST['hab'];
        $nature = $_POST['nature'];
        $xp = $_POST['xp'];
        $ami = $_POST['ami'];
        $moves = $_POST['moves'];
        //$tcap = $_POST['tcap'];
        $desloc = floor($speed/10);
        $shiny = $_POST['shiny'];
        $pt_nat =  $_POST['lv'] * 1;
        

        $sqlM = "INSERT INTO poke (id_per,nome,tipo, regiao,  hab, nature, pt_nat,xp, lv, hp, atk, satk, def, sdef, speed, ami,moves, desloc,shyni)
        VALUES ($id,'$nome','$tipo','$regiao','$hab', '$nature', $pt_nat,$xp, $lv, $hp, $atk, $satk, $def, $sdef, $speed, $ami ,'$moves', $desloc,'$shiny')";

        if ($conn->query($sqlM) === TRUE) {
        echo "Dados inseridos com sucesso!";  
        echo $nome;
        } else {
        echo "Erro ao cadastrar!";
        }
    
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

                                <!--<div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Tera type<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" name="t_type" id="last-name" required="required" class="form-control">
                                    </div>
                                </div>-->

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
                                        <input type="text" name="regiao" id="last-name" required="required" class="form-control" placeholder="Bota só se for de paldeia ">
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