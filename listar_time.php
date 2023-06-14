<?php
include_once("layout/head.php");
$id_per = $_SESSION['id'];

?>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Lista de Pokemon</h3>
              </div>
            </div>

            <div class="clearfix"></div>
            <?php
            mandaProPc();
            ?>
            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    
                    <!--<ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>-->
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_content">
                    <table class="table table-hover">
                    <h2>XP.share</h2>

                    <!--barra para o xp caompartilhado-->
                    <form action="listar_time.php" method="POST">
                        <div class="input-group">
                            <input type="text" class="form-control" name="xpgeral" placeholder="Xp compartilhado">

                            <span class="input-group-btn">
                            <input class="btn btn-secondary" type="submit"></input>
                            </span>
                        </div>
                    </form>
                    </table>

                      <main>
                          <section class="timepoke">
                            <!--lucario <a href="editar_usuarios.php?id='.$linha['id_poke'].'"> <img src="images/lapis.png" height="18px" width="18px"></a>
                            <a href="listar_time.php?del=user&id='.$linha['id_poke'].'">🖥️</a>-->
                            <article>
                              
                              <?php
                              $id=0;
                              xpshere();
                              $sql = "SELECT * FROM poke p LEFT JOIN evs ev ON ev.id_poke= p.id_poke where p.status=1 and p.id_per=$id_per ORDER BY p.ami DESC";
                              $result = mysqli_query($_SESSION['conexao'],$sql);

                              while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){

                                $nome= trim(strtolower($linha['nome']));
                                $shiny= strtolower($linha['shyni']);

                                if($linha['regiao']  == 'paldeia'){
                                  $imagem='<a href="https://pokemondb.net/pokedex/'.$nome.'"><img src="https://img.pokemondb.net/sprites/scarlet-violet/'.$shiny.'/'.$nome.'.png" alt="'.$nome.'"></a>';
                                }else{
                                  $imagem='<a href="https://pokemondb.net/pokedex/'.$nome.'" target="_blank"><img src="https://img.pokemondb.net/sprites/home/'.$shiny.'/'.$nome.'.png" alt="'.$nome.'"></a>';
                                }
                                
                                $id++;

                                echo'
                                  <div  class="pokeimg">';?><button onclick="toggleVisibility('elemento<?php echo $id ?>')">Mostrar/Ocultar</button><br> <?php
                                  echo '<a href="https://bulbapedia.bulbagarden.net/wiki/Experience" target="_blank">XP: '.$linha['xp'].'</a></br>';
                                  echo'
                                    '.$imagem.'

                                    <h3>'.trim(ucfirst($nome)).'</h3>

                                    <div id="elemento'.$id.'">
                                      <a class="link_icon" href="editar_usuarios.php?'.md5($linha['nome']).'&'.md5($linha['shyni']).'&id='.$linha['id_poke'].'"><i class="fa fa-edit"></i></a>

                                      <a class="link_icon" href="listar_time.php?'.md5($linha['nome']).'&'.md5($linha['shyni']).'&del=user&id='.$linha['id_poke'].'">🖥️</a>

                                      <p><strong>Lv:</strong> '.$linha['lv'].' <br/>
                                      <strong>Habilit:</strong> '.$linha['hab'].' <br/> 
                                      <strong>Nature:</strong> '.$linha['nature'].'
                                      <ul class="pokestatus">
                                          <li>Hp: '.$linha['hp'] + $linha['ev_hp'] .'</li>
                                          <li>Atk: '.$linha['atk'] + $linha['ev_atk'].' </li>
                                          <li>Def: '.$linha['def'] + $linha['ev_def'].'</li>
                                          <li>Esp.Atk: '.$linha['satk'] + $linha['ev_satk'].'</li>
                                          <li>Esp.Def: '.$linha['sdef'] + $linha['ev_sdef'] * 0.1.'</li>
                                          <li>Speed: '.$linha['speed'] + $linha['ev_speed'].'</li>
                                          
                                          <li>Amizade: '.$linha['ami'].'</li>
                                      </ul>
                                      <p><strong>Moves:</strong> '.$linha['moves'].'</p> <br>
                                    </div>

                                  </div>';
                                }
                                ?>
                            </article><!--<li>Deslocamento: '.$linha['desloc'].'</li>-->
                          </section>
                      </main>

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