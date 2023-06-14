<?php
include_once("layout/head.php");
$msg='';
$con=mysqli_connect("localhost","root","","rpg");

if (mysqli_connect_errno()) {
  echo "Erro ao conectar ao banco: " . mysqli_connect_error();
  exit();
}else{
  
  if(isset($_GET['id'])){ // RECEBE DADOS VIA GET
    $normal=' ';
    $shyni=' ';
    $id = $_GET['id'];

    insertEvs($id);

    $sql= "SELECT * FROM poke p LEFT JOIN evs ev ON ev.id_poke = $id where p.id_poke=$id";
    $r_sql=mysqli_query($con,$sql);
    $linha = mysqli_fetch_array($r_sql,MYSQLI_ASSOC);

    if($linha['shyni'] == 'shiny'){
      $shyni = 'checked';
    }elseif($linha['shyni']=='normal'){
      $normal= 'checked';
    }


  }else{ // ENVIA DADOS VIA POST
      $id = $_POST['id']; //OCULTO
      $nome = $_POST['nome'];
      $t_type = $_POST['t_type'];
      $hab = $_POST['hab'];
      $nature = $_POST['nature'];
      $lv = $_POST['lv'];
      $xp = $_POST['xp'];
      $hp = $_POST['hp'];
      $atk = $_POST['atk'];
      $satk = $_POST['satk'];
      $def = $_POST['def'];
      $sdef = $_POST['sdef'];
      $speed = $_POST['speed'];
      $ami = $_POST['ami'];
      $moves = $_POST['moves'];
      $shyni = $_POST['shiny'];

      $sql = "UPDATE poke SET nome='$nome',
      t_type = '$t_type',
      hab = '$hab',
      nature = '$nature', 
      xp = $xp, 
      lv = $lv, 
      hp = $hp, 
      atk = $atk, 
      satk = $satk, 
      def = $def, 
      sdef = $sdef, 
      speed = $speed, 
      ami = $ami, 
      moves = '$moves',
      shyni = '$shyni' WHERE id_poke = $id";
      $result = mysqli_query($con,$sql);

      if($result){// Update da tabela Evs
      $ev_hp = $_POST['ev_hp'];
      $ev_atk = $_POST['ev_atk'];
      $ev_def = $_POST['ev_def'];
      $ev_satk = $_POST['ev_satk'];
      $ev_sdef = $_POST['ev_sdef'];
      $ev_speed = $_POST['ev_speed'];
      
      $sql_ev = "UPDATE evs SET ev_hp=$ev_hp, ev_atk=$ev_atk, ev_def=$ev_def, ev_satk=$ev_satk, ev_sdef=$ev_sdef, ev_speed=$ev_speed WHERE id_poke = $id";
      $roda_sql = mysqli_query($con,$sql_ev);}

      //Verifica e da o feedack 
      if($result && $roda_sql){
        $msg = '<div class="alert alert-info alert-dismissible " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>Sucesso!</strong> Pokemon enviado para o PC !
        </div>';
      }else{
        $msg = '<div class="alert alert-warning alert-dismissible " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>Erro !</strong> Não é possivel enviar o pokemo para o PC !!!!.
        </div>';
      }
      
      $sql = "SELECT * FROM poke p LEFT JOIN evs ev ON ev.id_poke = $id where p.id_poke=$id";
      $result_2 = mysqli_query($con,$sql);
      $linha = mysqli_fetch_array($result_2, MYSQLI_ASSOC);

      $normal=' ';
      $shyni=' ';
      
      if($linha['shyni'] == 'shiny'){
        $shyni = 'checked';
      }elseif($linha['shyni']=='normal'){
        $normal= 'checked';
      }
    }
  }
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Editar</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <?php echo $msg; ?>
                  <div class="x_content">
                  <div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
                  
								<div class="x_content">
								<br>
                
								<form action="editar_usuarios.php" method="post" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                  <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <!--Nome-->
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nome:<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="first-name" name="nome" value="<?php echo $linha['nome']; ?>" required="required" class="form-control parsley-error" data-parsley-id="5"><ul class="parsley-errors-list filled" id="parsley-id-5"></ul>
											</div>
									  </div>

                    <!--Nome-->
                  <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tera Type:<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="first-name" name="t_type" value="<?php echo $linha['t_type']; ?>" required="required" class="form-control parsley-error" data-parsley-id="5"><ul class="parsley-errors-list filled" id="parsley-id-5"></ul>
											</div>
									</div>

                    <!--Habilit-->
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Habilit: <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="last-name" name="hab" value="<?php echo $linha['hab']; ?>" required="required" class="form-control parsley-error" data-parsley-id="7"><ul class="parsley-errors-list filled" id="parsley-id-7"></ul>
											</div>
										</div>

                    <!--Nature-->
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Nature: <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="last-name" name="nature" value="<?php echo $linha['nature']; ?>" required="required" class="form-control parsley-error" data-parsley-id="7"><ul class="parsley-errors-list filled" id="parsley-id-7"></ul>
											</div>
										</div>

                    <!--Xp-->
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Xp: <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="last-name" name="xp" value="<?php echo $linha['xp']; ?>" required="required" class="form-control parsley-error" data-parsley-id="7"><ul class="parsley-errors-list filled" id="parsley-id-7"></ul>
											</div>
										</div>

                    <!--Lv-->
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Lv: <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="last-name" name="lv" value="<?php echo $linha['lv']; ?>" required="required" class="form-control parsley-error" data-parsley-id="7"><ul class="parsley-errors-list filled" id="parsley-id-7"></ul>
											</div>
										</div>

                    <!--HP-->
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Hp: <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" id="last-name" name="hp" value="<?php echo $linha['hp']; ?>" required="required" class="form-control parsley-error" data-parsley-id="7"><ul class="parsley-errors-list filled" id="parsley-id-7"></ul>
											</div>

                      <!--Evs do HP-->
                      <label class="col-form-label col-md-1 col-sm-1 label-align" for="last-name">Ev: <span class="required">*</span>
											</label>
                      <div class="col-md-1 col-sm-1 ">
												<input type="number" id="last-name" name="ev_hp" value="<?php echo $linha['ev_hp']; ?>" required="required" class="form-control parsley-error" data-parsley-id="7"><ul class="parsley-errors-list filled" id="parsley-id-7">
											</div>
										</div>

                    <!--atk-->
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Atk: <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" id="last-name" name="atk" value="<?php echo $linha['atk']; ?>" required="required" class="form-control parsley-error" data-parsley-id="7"><ul class="parsley-errors-list filled" id="parsley-id-7"></ul>
											</div>
                      
                      <!--Evs do atk-->
                      <label class="col-form-label col-md-1 col-sm-1 label-align" for="last-name">Ev: <span class="required">*</span>
											</label>
                      <div class="col-md-1 col-sm- ">
												<input type="number" id="last-name" name="ev_atk" value="<?php echo $linha['ev_atk']; ?>" required="required" class="form-control parsley-error" data-parsley-id="7"><ul class="parsley-errors-list filled" id="parsley-id-7"></ul>
											</div>
										</div>

                    <!--Sp.atk-->
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Sp.atk: <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" id="last-name" name="satk" value="<?php echo $linha['satk']; ?>" required="required" class="form-control parsley-error" data-parsley-id="7"><ul class="parsley-errors-list filled" id="parsley-id-7"></ul>
											</div>

                      <!--Evs do sp.atk-->
                      <label class="col-form-label col-md-1 col-sm-1 label-align" for="last-name">Ev: <span class="required">*</span>
											</label>
                      <div class="col-md-1 col-sm-1 ">
												<input type="number" id="last-name" name="ev_satk" value="<?php echo $linha['ev_satk']; ?>" required="required" class="form-control parsley-error" data-parsley-id="7"><ul class="parsley-errors-list filled" id="parsley-id-7">
											</div>
										</div>

                    <!--Def-->
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Def: <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" id="last-name" name="def" value="<?php echo $linha['def']; ?>" required="required" class="form-control parsley-error" data-parsley-id="7"><ul class="parsley-errors-list filled" id="parsley-id-7"></ul>
											</div>

                      <!--Evs do def-->
                      <label class="col-form-label col-md-1 col-sm-1 label-align" for="last-name">Ev: <span class="required">*</span>
											</label>
                      <div class="col-md-1 col-sm-1 ">
												<input type="number" id="last-name" name="ev_def" value="<?php echo $linha['ev_def']; ?>" required="required" class="form-control parsley-error" data-parsley-id="7"><ul class="parsley-errors-list filled" id="parsley-id-7">
											</div>
										</div>

                    <!--Sp.Def-->
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Sp.def: <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" id="last-name" name="sdef" value="<?php echo $linha['sdef']; ?>" required="required" class="form-control parsley-error" data-parsley-id="7"><ul class="parsley-errors-list filled" id="parsley-id-7"></ul>
											</div>

                      <!--Evs do sp.def-->
                      <label class="col-form-label col-md-1 col-sm-1 label-align" for="last-name">Ev: <span class="required">*</span>
											</label>
                      <div class="col-md-1 col-sm-1 ">
												<input type="number" id="last-name" name="ev_sdef" value="<?php echo $linha['ev_sdef']; ?>" required="required" class="form-control parsley-error" data-parsley-id="7"><ul class="parsley-errors-list filled" id="parsley-id-7">
											</div>
										</div>

                    <!--Speed-->
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Speed: <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" id="last-name" name="speed" value="<?php echo $linha['speed']; ?>" required="required" class="form-control parsley-error" data-parsley-id="7"><ul class="parsley-errors-list filled" id="parsley-id-7"></ul>
											</div>

                      <!--Evs da Speed-->
                      <label class="col-form-label col-md-1 col-sm-1 label-align" for="last-name">Ev: <span class="required">*</span>
											</label>
                      <div class="col-md-1 col-sm-1 ">
												<input type="number" id="last-name" name="ev_speed" value="<?php echo $linha['ev_speed']; ?>" required="required" class="form-control parsley-error" data-parsley-id="7"><ul class="parsley-errors-list filled" id="parsley-id-7">
											</div>

										</div>

                    <!--Amizade-->
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Amizade: <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="number" id="last-name" name="ami" value="<?php echo $linha['ami']; ?>" required="required" class="form-control parsley-error" data-parsley-id="7"><ul class="parsley-errors-list filled" id="parsley-id-7"></ul>
											</div>
										</div>

                    <!--Muvs-->
                    <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Muvs: <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="last-name" name="moves" value="<?php echo $linha['moves']; ?>" required="required" class="form-control parsley-error" data-parsley-id="7"><ul class="parsley-errors-list filled" id="parsley-id-7"></ul>
											</div>
										</div>

                    <!--Shiny-->
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Shiny<span class="required">*</span>
                        </label>
                        <div class="col-md-2 col-sm-2">
                            <input type="radio" name="shiny" id="last-name"  class="form-control" value="shiny" <?php echo $shyni; ?>>
                        </div>
                    
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Normal<span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3 ">
                            <input type="radio" name="shiny" id="last-name"  class="form-control" value="normal" <?php echo $normal; ?>>
                        </div>
                    </div>

										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
                        <input type="submit" value="Atualizar" class="btn btn-success">
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
    </div>
  </div>
</div>
        <!-- /page content -->

<?php
include_once("layout/footer.php");
?>