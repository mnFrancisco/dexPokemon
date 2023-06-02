<?php
include_once("conexao.php");
$id_per = $_SESSION['id'];

$sql = "SELECT * from poke WHERE status = 1 and id_per=$id_per ORDER BY poke.ami DESC";
$result = mysqli_query($_SESSION['conexao'],$sql);
$_POST['xpgeral']=500;
while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){

    if(isset($_POST['xpgeral']) !=0){
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
          }
        }
      }
}


?>