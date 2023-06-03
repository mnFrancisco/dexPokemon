<?php
include_once("layout/head.php");

$fichaPer=fichaPer();
contaSatus();

?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <!--lugar para os tipos de capturas -->

                  <div class="x_content">
                      <div class="col-md-12 col-sm-12 ">
                      <div class="x_panel">
                        <div class="x_title">
                          <!--Titulo-->
                          <h1>Perfil de Treinador</h1>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <div class="col-md-3 col-sm-3  profile_left">
                            <div class="profile_img">
                              <div id="crop-avatar">
                                <!-- Current avatar -->
                                <p class="per"><?php echo fichaFoto()?></p>
                              </div>
                            </div>
                            <?php 
                              if($fichaPer == false){
                                echo '<strong><big>Crie seu perfil <a href="criar_per.php">aqui</a></big></strong>';exit();
                              }?>
                            <h3><i class="fa fa-map-marker user-profile-icon"></i><?php echo $fichaPer['regiao'].', '.$fichaPer['cidade']?></h3>

                            <div class="clearfix"></div>
                            
                            <!-- start skills -->
                            <h3>Info.Adicional:</h3>
                            
                            <ul class="list-unstyled user_data">
                              <?php  ?>
                              <li>Montaria</li>
                              <li>Psquico</li>
                              <li>Mercador</li>
                            </ul>
                            <!-- end of skills -->

                          </div>
                          <div class="col-md-9 col-sm-9 ">
                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                              <section class="treinador">
                                <h2>Treinador-lv:1</h2>
                                <h3>M.T:<?php echo $fichaPer['mtrei']; ?></h3>

                                <ul>
                                  <li>Nome: <?php echo $fichaPer['nomeper'] ;?></li>
                                  <li>Idade: <?php echo $fichaPer['idade'] ;?> anos</li>
                                  <li>Altura: <?php echo $fichaPer['altura'];?> cm</li>
                                  <li>Peso: <?php echo $fichaPer['peso'] ;?>kg</li>
                                  <li>Id.Treinador: <?php echo $fichaPer['id_trei']?></li> 
                                </ul>
                              </section>
                              
                              <article class="tb-responsiva">
                                <!--Personagem-->
                                <section>
                                  <h3>Status:</h3>
                                <ul class="list-unstyled user_data">
                                    <li>Hp: <?php echo $fichaPer['hp'].'<a href="perfil.php?hp_mais='.$fichaPer['id_persona'].'"> + </a> 
                                    <a href="perfil.php?hp_menos='.$fichaPer['id_persona'].'"> - </a>';?></li>

                                    <li>Stamina: <?php echo $fichaPer['stamina'].'<a href="perfil.php?stamina_mais='.$fichaPer['id_persona'].'"> + </a> 
                                    <a href="perfil.php?stamina_menos='.$fichaPer['id_persona'].'"> - </a>';?></li>

                                    <li>Determinação: <?php echo $fichaPer['determinacao'].'<a href="perfil.php?desloc_mais='.$fichaPer['id_persona'].'"> + </a> 
                                    <a href="perfil.php?desloc_menos='.$fichaPer['id_persona'].'"> - </a>';?></li>

                                  </ul>
                                </section>
                                
                                <section class="cont">
                                  <h3>Comquistas:</h3>
                                  <ul class="list-unstyled user_data">
                                    <li>Insignias:<?php echo $fichaPer['insig']; ?></li>
                                    <li>Torneios:<?php echo $fichaPer['torneios']; ?></li>
                                    <li>Contest:<?php echo $fichaPer['contest']; ?></li>
                                  </ul>
                                </section>

                                <section class="cont">
                                  <h3>Mundial:</h3>
                                  <ul class="list-unstyled user_data">
                                    <li>Ranking: <?php echo $fichaPer['mundial']; ?></li>
                                    <li>Pontuação: <?php echo $fichaPer['pt_mundial']; ?></li>
                                  </ul>
                                </section>

                              </article>
                              
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
          </div>
        </div>
        <!-- /page content -->

<?php
include_once("layout/footer.php");
?>