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

//busca metodo de treinamento
function mt($linha){
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM persona where id_per=$id";
    $result = mysqli_query($_SESSION['conexao'],$sql);
    $persona = mysqli_fetch_array($result, MYSQLI_ASSOC);

  //Encorajador
  if($persona['mtrei'] == 'Emcorajador' && $linha['nome'] == 'lucario'){
    $linha['hp'] = $linha['hp'] + $linha['lv'] * 2;
    return $linha['hp'];
  }elseif($persona['mtrei'] != 'Emcorajador'){
    return $linha['hp'];
  }
  else{
    $linha['hp'] = $linha['hp'] + $linha['lv'] * $persona['nv_treinador'];
    return $linha['hp'];
  }

  
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

//Insert na tabela evs 
function insertEvs($id){

  $sql_select = "SELECT id_poke FROM evs";
  $roda = mysqli_query($_SESSION['conexao'], $sql_select);
  $linha = mysqli_fetch_array($roda, MYSQLI_ASSOC);

  $id = mysqli_real_escape_string($_SESSION['conexao'], $id);

  if ($linha['id_poke'] == $id) {
    // Código quando o id já existe
  } else {
    $sql_insert = "INSERT INTO evs (id_poke) VALUES ($id)";
    $roda_sql = mysqli_query($_SESSION['conexao'], $sql_insert);
  }


};

//tipo de captura
/*$tcap_pokebola = '';
$tcap_presente = '';
$tcap_reconpensa = '';
$tcap_ovo = '';
$tcap_focil = '';
if($linha['tcap'] == 'Pokebola'){
  $tcap_pokebola = 'selected';
}elseif($linha['tcap'] == 'Presente'){
  $tcap_presente = 'selected';
}elseif($linha['tcap'] == 'Recompensa'){
  $tcap_reconpensa = 'selected';
}elseif($linha['tcap'] == 'Ovo'){
  $tcap_ovo = 'selected';
}else{
  $tcap_focil = 'selected';
}*/

//CARRO FAV
      /*$tcap_pokebola = '';
      $tcap_presente = '';
      $tcap_reconpensa = '';
      $tcap_ovo = '';
      $tcap_focil = '';
      if($linha['tcap'] == 'Pokebola'){
        $tcap_pokebola = 'selected';
      }elseif($linha['tcap'] == 'Presente'){
        $tcap_presente = 'selected';
      }elseif($linha['tcap'] == 'Recompensa'){
        $tcap_reconpensa = 'selected';
      }elseif($linha['tcap'] == 'Ovo'){
        $tcap_ovo = 'selected';
      }else{
        $tcap_focil = 'selected';
      }*/
?>