<?php
//manda o pokemon do time para o pc 
function mandaProPc(){
  if(isset($_GET['del']) == 'user'){
    $sql="UPDATE poke SET status = 0 WHERE id_poke = ".$_GET['id'];
    $resp_sql = mysqli_query($_SESSION['conexao'],$sql);
    if($resp_sql){
      echo'<div class="alert alert-info alert-dismissible " role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      <strong>Sucesso!</strong> Pokemon enviado para o PC !
      </div>';
    }else{
      echo'<div class="alert alert-warning alert-dismissible " role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      <strong>Erro !</strong> Não é possivel enviar o pokemo para o PC !!!!.
      </div>';
    }
  }
}
//manda o pokemon do pc para o time
function mandaProTime(){
  if(isset($_GET['del']) == 'user'){
    $sql="UPDATE poke SET status = 1 WHERE id_poke = ".$_GET['id'];
    $resp_sql = mysqli_query($_SESSION['conexao'],$sql);
    if($resp_sql){
      echo'<div class="alert alert-info alert-dismissible " role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      <strong>Sucesso!</strong> Pokemon enviado para o PC !
      </div>';
    }else{
      echo'<div class="alert alert-warning alert-dismissible " role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      <strong>Erro !</strong> Não é possivel enviar o pokemo para o PC !!!!.
      </div>';
    }
  }
}

//distribui a xp pro time inteiro
function xpshere(){
  $id_per = $_SESSION['id'];
  $sql = "SELECT * from poke WHERE status = 1 and id_per=$id_per ORDER BY poke.ami DESC";
  $result = mysqli_query($_SESSION['conexao'],$sql);
  while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    if(!empty($_POST['xpgeral'])){
      if($linha['xpshare']==1){
        if($linha['crescimento'] == 'slow'){
          $nome=$linha['nome'];
          $xp_final= $linha['xp'] + ($_POST['xpgeral'] /3);

          $xp_sql = "UPDATE poke SET xp=$xp_final where xpshare=1 and status=1 and nome='$nome'";
          $rst = mysqli_query($_SESSION['conexao'],$xp_sql);
          
        }if($linha['crescimento'] ==  'medium slow'){
          $nome=$linha['nome'];
          $xp_final= $linha['xp'] + ($_POST['xpgeral'] /2);

          $xp_sql = "UPDATE poke SET xp=$xp_final where xpshare=1 and status=1 and nome='$nome'";
          $rst = mysqli_query($_SESSION['conexao'],$xp_sql);
          
        }if($linha['crescimento'] ==  'medium fast'){
          $nome=$linha['nome'];
          $xp_final= $linha['xp'] + $_POST['xpgeral'];

          $xp_sql = "UPDATE poke SET xp=$xp_final where xpshare=1 and status=1 and nome='$nome'";
          $rst = mysqli_query($_SESSION['conexao'],$xp_sql);
          
        }if($linha['crescimento'] ==  'fast'){
          $nome=$linha['nome'];
          $xp_final= $linha['xp'] + ($_POST['xpgeral'] *2) ;

          $xp_sql = "UPDATE poke SET xp=$xp_final where xpshare=1 and status=1 and nome='$nome'";
          $rst = mysqli_query($_SESSION['conexao'],$xp_sql);
          if($rst){
            echo 'isjifnsifadbnisnd';
          }else{
            echo 'ajsndasnfmsa';
          }
          
        }
      }
    }
  }
}

//pega tudo que tem aver com o usuario
function verificaficha(){
  $id = $_SESSION['id'];
    $sql = "SELECT * FROM persona p LEFT JOIN personagem d ON p.id_per = d.id where id_per=$id";
    $result = mysqli_query($_SESSION['conexao'],$sql);
    $linha = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
  if($linha != '' ){
    echo '<a class="dropdown-item"  href="perfil.php">Ver Perfil</a>';
    echo '<a class="dropdown-item"  href="editar_per.php">Editar Ficha</a>';
  }elseif($linha == 0){
    echo '';
  }
  else{
    echo '<a class="dropdown-item"  href="criar_per.php">Criar Ficha</a>';
  
  }
}
function verificamestre(){
    $id = $_SESSION['id'];
      $sql = "SELECT * FROM personagem where id=$id";
      $result = mysqli_query($_SESSION['conexao'],$sql);
      $linha = mysqli_fetch_array($result, MYSQLI_ASSOC);
      
    if($linha['id'] != 0 ){
      echo '
            <div class="menu_section">
            <ul class="nav side-menu">
              <li><a><i class="fa fa-home"></i> Pokemon <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="listar_time.php">Time</a></li>
                <li><a href="listar_pc.php">Pc</a></li>
                <li><a href="novo_poke.php">Rejistrar Pokemon</a></li>
              </ul>
            </ul>
          </div>

          <div class="menu_section">
            <ul class="nav side-menu">
              <li><a><i class="fa fa-archive"></i></i> Mochila <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="mochila.php">Itens</a></li>
                </ul>
            </ul>
          </div>
       ';
    }else{
        echo '
        <div class="menu_section">
            <ul class="nav side-menu">
              <li><a><i class="fa fa-home"></i> Funçoes <span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="ver_perfil.php">Ver Perfil de Jogadores</a></li>
              </ul>
            </ul>
          </div>

          <div class="menu_section">
            <ul class="nav side-menu">
              <li><a><i class="fa fa-archive"></i></i> NPC <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="criar_npc.php">Criar</a></li>
                  <li><a href="ver_npc.php">Ver</a></li>
                </ul>
            </ul>
          </div>
     ';
    }
    
  }


  function fichaPer(){
  $id = $_SESSION['id'];
  $sql = "SELECT * FROM persona p LEFT JOIN personagem d ON p.id_per = d.id where id_per=$id;";
  $result = mysqli_query($_SESSION['conexao'],$sql);
  $linha = mysqli_fetch_array($result, MYSQLI_ASSOC);
  return $linha;
}

function fichaFoto(){
  $id = $_SESSION['id'];
  $sql = "SELECT * FROM tbl_fotos where id_per=$id;";
  $result = mysqli_query($_SESSION['conexao'],$sql);
  $linha = mysqli_fetch_array($result, MYSQLI_ASSOC);
  
  
  if($linha != ''){
    echo '<img src="images/perfil/'.$linha['nomemd5_foto'].'" alt="..." class="img-circle profile_img">';
  }else{
    echo '<img src="images/perfil/user.png" alt="..." class="img-circle profile_img">';
  }
}

function buscausuario(){
    $id = $_SESSION['id'];
    $sql = "SELECT * from personagem WHERE id= $id";
    $result = mysqli_query($_SESSION['conexao'],$sql);
    $linha = mysqli_fetch_array($result, MYSQLI_ASSOC);
    return $linha;
}

// Valida e encerra as sessoes
function validaLogin(){

  if(isset($_SESSION['email']) == null){
  header('Location: index.php');
  }

}

function encerrarSesao(){
  if(isset($_GET['logout']) == 'sair'){

    session_start();
    $_SESSION['id'] = null;    
    $_SESSION['email'] = null; 
    session_destroy();

  }
}
//almentar  e diminuir estatus
function contaSatus(){
  // status hp mais
  if(isset($_GET['hp_mais']) == 'hp_mais'){
    $sql="SELECT hp From persona WHERE id_persona = ".$_GET['hp_mais'];
    $resp_sql = mysqli_query($_SESSION['conexao'],$sql);
    $linha=mysqli_fetch_array($resp_sql,MYSQLI_ASSOC);

    if($resp_sql){
      $menus = $linha['hp'] + 1;
      
      $menos_sql="UPDATE persona SET hp = $menus WHERE id_persona = ".$_GET['hp_mais'];
      $resposta = mysqli_query($_SESSION['conexao'],$menos_sql);

    }
  }
  // status hp menos
  if(isset($_GET['hp_menos']) == 'hp_menos'){
    $sql="SELECT hp From persona WHERE id_persona = ".$_GET['hp_menos'];
    $resp_sql = mysqli_query($_SESSION['conexao'],$sql);
    $linha=mysqli_fetch_array($resp_sql,MYSQLI_ASSOC);

    if($resp_sql){
      $menus = $linha['hp'] - 1;
      
      $menos_sql="UPDATE persona SET hp = $menus WHERE id_persona = ".$_GET['hp_menos'];
      $resposta = mysqli_query($_SESSION['conexao'],$menos_sql);
      
    }
  }
  // status estamina mais
  if(isset($_GET['stamina_mais']) == 'stamina_mais'){
    $sql="SELECT stamina From persona WHERE id_persona = ".$_GET['stamina_mais'];
    $resp_sql = mysqli_query($_SESSION['conexao'],$sql);
    $linha=mysqli_fetch_array($resp_sql,MYSQLI_ASSOC);

    if($resp_sql){
      $menus = $linha['stamina'] + 1;
      
      $menos_sql="UPDATE persona SET stamina = $menus WHERE id_persona = ".$_GET['stamina_mais'];
      $resposta = mysqli_query($_SESSION['conexao'],$menos_sql);

    }
  }
  // status estamina menos
  if(isset($_GET['stamina_menos']) == 'stamina_menos'){
    $sql="SELECT stamina From persona WHERE id_persona = ".$_GET['stamina_menos'];
    $resp_sql = mysqli_query($_SESSION['conexao'],$sql);
    $linha=mysqli_fetch_array($resp_sql,MYSQLI_ASSOC);

    if($resp_sql){
      $menus = $linha['stamina'] - 1;
      
      $menos_sql="UPDATE persona SET stamina = $menus WHERE id_persona = ".$_GET['stamina_menos'];
      $resposta = mysqli_query($_SESSION['conexao'],$menos_sql);
      
    }
  }
  // status deslocamento mais
  if(isset($_GET['desloc_mais']) == 'desloc_mais'){
    $sql="SELECT determinacao From persona WHERE id_persona = ".$_GET['desloc_mais'];
    $resp_sql = mysqli_query($_SESSION['conexao'],$sql);
    $linha=mysqli_fetch_array($resp_sql,MYSQLI_ASSOC);

    if($resp_sql){
      $menus = $linha['determinacao'] + 1;
      
      $menos_sql="UPDATE persona SET determinacao = $menus WHERE id_persona = ".$_GET['desloc_mais'];
      $resposta = mysqli_query($_SESSION['conexao'],$menos_sql);

    }
  }
  // status deslocamento menos
  if(isset($_GET['desloc_menos']) == 'desloc_menos'){
    $sql="SELECT determinacao From persona WHERE id_persona = ".$_GET['desloc_menos'];
    $resp_sql = mysqli_query($_SESSION['conexao'],$sql);
    $linha=mysqli_fetch_array($resp_sql,MYSQLI_ASSOC);

    if($resp_sql){
        $menus = $linha['determinacao'] - 1;
      
        $menos_sql="UPDATE persona SET determinacao = $menus WHERE id_persona = ".$_GET['desloc_menos'];
        $resposta = mysqli_query($_SESSION['conexao'],$menos_sql);

      } 
    }
}

//busca metodo de treinamento
function mt(){
  $id=$_SESSION['id'];
  $sql = "SELECT * from personagem WHERE id= $id";
}
function tamanhaString($sobre){
    
    echo strlen($sobre);

}

function log_erro_ALL(){
  // Check connection
  if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
  }
  error_reporting(E_ALL);// habilita todos os tipos de errors

  ini_set('ignore_repeated_errors',True);// ignora erros iguais/repetidos

  ini_set('display_errors',True);
  // TRUE-mostra os erros na tela 
  // FALSE-não msotra os erros na tela

  ini_set('log_erros',True);// inicia o log de erro

  ini_set('error_log','error.log');//cria arquivo de log de erro
}

function ar(){
  $sql = "SELECT * FROM persona p LEFT JOIN personagem d ON p.id_per = d.id where id_per=$id";
    $result = mysqli_query($_SESSION['conexao'],$sql);
    $linha = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if($linha['nature'] == 'serious'){
      $linha['speed']=$linha['speed']+$linha['lv']*1;
    }
    if($linha['nature'] =='bashful'){
        $linha['satk'] = $linha['satk']+$linha['lv']*1;
    }
    if($linha['nature'] =='docile'){
        $linha['def'] = $linha['def']+$linha['lv']*1;
    }
    if($linha['nature'] =='hardy'){
        $linha['atk'] = $linha['atk']+$linha['lv']*1;
    }
    if($linha['nature'] =='quirky'){
        $linha['sdef'] = $linha['sdef']+$linha['lv']*1;

    }if($linha['nature'] !='serious' && $linha['nature'] !='bashful' && $linha['nature'] !='docile' && $linha['nature'] !='hardy' && $linha['nature'] !='quirky'){

    }else{
      // pega os dados da nature
      $api_link = "https://pokeapi.co/api/v2/nature/".strtolower($linha['nature']);
      $response = file_get_contents($api_link);
      $dados_nature = json_decode($response, true);

      $nature_name= $dados_nature['name'];
      $increased_stat = $dados_nature["increased_stat"]["name"];
      $decreased_stat = $dados_nature["decreased_stat"]["name"];

      // calculo da nature Naughty/safadinho
      if($nature_name == 'naughty'){
          if($increased_stat == 'attack'){
          $linha['atk'] = $linha['atk']+$linha['lv']*1;
          }if($decreased_stat == 'special-defense'){
          $linha['sdef'] = $linha['sdef'] - $linha['lv']*1;
          }
      }
      // calculo da nature lonely/solitario
      if($nature_name == 'lonely'){
          if($increased_stat == 'attack'){
              $linha['atk'] = $linha['atk']+$linha['lv']*1;
          }if($decreased_stat == 'defense'){
              $linha['def'] = $linha['def'] - $linha['lv']*1;
          }
      }
      // calculo da nature brave/valente
      if($nature_name == 'brave'){
          if($increased_stat == 'attack'){
              $linha['atk'] = $linha['atk']+$linha['lv']*1;
          }if($decreased_stat == 'speed'){
              $linha['speed'] = $linha['speed'] - $linha['lv']*1;
          }
      }
      // calculo da nature adamant
      if($nature_name == 'adamant'){
          if($increased_stat == 'attack'){
              $linha['atk'] = $linha['atk']+$linha['lv']*1;
          }if($decreased_stat == 'special-attack'){
              $linha['satk'] = $linha['satk'] - $linha['lv']*1;
          }
      }
      // calculo da nature bold
      if($nature_name == 'bold'){
          if($increased_stat == 'defense'){
              $linha['def'] = $linha['def']+$linha['lv']*1;
          }if($decreased_stat == 'attack'){
              $linha['atk'] = $linha['atk'] - $linha['lv']*1;
          }
      }
      // calculo da nature relaxed/relaxado
      if($nature_name == 'relaxed'){
          if($increased_stat == 'defense'){
              $linha['def'] = $linha['def']+$linha['lv']*1;
          }if($decreased_stat == 'speed'){
              $linha['speed'] = $linha['speed'] - $linha['lv']*1;
          }
      }
      // calculo da nature impish
      if($nature_name == 'impish'){
          if($increased_stat == 'defense'){
              $linha['def'] = $linha['def']+$linha['lv']*1;
          }if($decreased_stat == 'special-attack'){
              $linha['satk'] = $linha['satk'] - $linha['lv']*1;
          }
      }
      // calculo da nature lax
      if($nature_name == 'lax'){
          if($increased_stat == 'defense'){
              $linha['def'] = $linha['def']+$linha['lv']*1;
          }if($decreased_stat == 'special-defense'){
              $linha['satk'] = $linha['satk'] - $linha['lv']*1;
          }
      }
      // calculo da nature timid/timido
      if($nature_name == 'timid'){
          if($increased_stat == 'speed'){
              $linha['speed'] = $linha['speed']+$linha['lv']*1;
          }if($decreased_stat == 'attack'){
              $linha['atk'] = $linha['atk'] - $linha['lv']*1;
          }
      }
      // calculo da nature hasty/apresado
      if($nature_name == 'hasty'){
          if($increased_stat == 'speed'){
              $linha['speed'] = $linha['speed']+$linha['lv']*1;
          }if($decreased_stat == 'defense'){
              $linha['def'] = $linha['def'] - $linha['lv']*1;
          }
      }
      // calculo da nature jolly/
      if($nature_name == 'jolly'){
          if($increased_stat == 'speed'){
              $linha['speed'] = $linha['speed']+$linha['lv']*1;
          }if($decreased_stat == 'special-attack'){
              $linha['satk'] = $linha['satk'] - $linha['lv']*1;
          }
      }
      // calculo da nature naive/
      if($nature_name == 'naive'){
          if($increased_stat == 'speed'){
              $linha['speed'] = $linha['speed']+$linha['lv']*1;
          }if($decreased_stat == 'special-defense'){
              $linha['sdef'] = $linha['sdef'] - $linha['lv']*1;
          }
      }
      // calculo da nature modest/modesto
      if($nature_name == 'modest'){
          if($increased_stat == 'special-attack'){
              $linha['satk'] = $linha['satk']+$linha['lv']*1;
          }if($decreased_stat == 'attack'){
              $linha['atk'] = $linha['atk'] - $linha['lv']*1;
          }
      }
      // calculo da nature mild/
      if($nature_name == 'mild'){
          if($increased_stat == 'special-attack'){
              $linha['satk'] = $linha['satk']+$linha['lv']*1;
          }if($decreased_stat == 'defense'){
              $linha['def'] = $linha['def'] - $linha['lv']*1;
          }
      }
      // calculo da nature quiet/
      if($nature_name == 'quiet'){
          if($increased_stat == 'special-attack'){
              $linha['satk'] = $linha['satk']+$linha['lv']*1;
          }if($decreased_stat == 'speed'){
              $linha['speed'] = $linha['speed'] - $linha['lv']*1;
          }
      }
      // calculo da nature rash/
      if($nature_name == 'rash'){
          if($increased_stat == 'special-attack'){
              $linha['satk'] = $linha['satk']+$linha['lv']*1;
          }if($decreased_stat == 'special-defense'){
              $linha['sdef'] = $linha['sdef'] - $linha['lv']*1;
          }
      }
      // calculo da nature calm/
      if($nature_name == 'calm'){
          if($increased_stat == 'special-defense'){
              $linha['sdef'] = $linha['sdef']+$linha['lv']*1;
              
          }if($decreased_stat == 'attack'){
              $linha['atk'] = $linha['atk'] - $linha['lv']*1;
              
          }
      }
      // calculo da nature gentle/
      if($nature_name == 'gentle'){
          if($increased_stat == 'special-defense'){
              $linha['sdef'] = $linha['sdef']+$linha['lv']*1;
          
          }if($decreased_stat == 'defense'){
              $linha['def'] = $linha['def'] - $linha['lv']*1;
              
          }
      }
      // calculo da nature sassy/
      if($nature_name == 'sassy'){
          if($increased_stat == 'special-defense'){
              $linha['sdef'] = $linha['sdef']+$linha['lv']*1;
          
          }if($decreased_stat == 'speed'){
              $linha['speed'] = $linha['speed'] - $linha['lv']*1;
              
          }
      }
      // calculo da nature careful/
      if($nature_name == 'careful'){
          if($increased_stat == 'special-defense'){
              $linha['sdef'] = $linha['sdef']+$linha['lv']*1;
              
          }if($decreased_stat == 'special-attack'){
              $linha['satk'] = $linha['satk'] - $linha['lv']*1;
              
          }
      }
  }
}
?>