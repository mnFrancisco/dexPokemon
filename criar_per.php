<?php
include_once("layout/head.php");
?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>
            <?php
              $user=buscausuario();
              $id_per = $_SESSION['id'];
              
              //personagem
              if(isset($_FILES['uploaded_file'])) {
                $path = "images/perfil/";
              
                $nome = $_FILES['uploaded_file']['name'];
              
                $extensao = strrchr($nome,'.');
              
                $novonome = md5(microtime()) . $extensao;
              
                $path = $path.$novonome;
                
                $tam_img = $_FILES['uploaded_file']['size'];
              
                $sql_foto = "INSERT INTO tbl_fotos (id_per,nome_foto, nomemd5_foto,tamanho_foto, status_fotos) VALUES ($id_per,'$nome','$novonome', '$tam_img', 1)";
                $roda_query = mysqli_query($con, $sql_foto);
              
                if($roda_query && move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
                    echo "O arquivo ". basename($nome) . " foi enviado com sucesso!";
                } else {
                    echo "Houve um erro ao enviar seu arquivo!";
                }
              }
              
              if(isset($_POST['idade']) != ''){  
                $nome = $user['nome'];
                $idade = $_POST['idade'];
                $id_treiner = $_POST['id_trei'];
                $regiao = $_POST['regiao'];
                $cidade = $_POST['cidade'];
                $insig = $_POST['insig'];
                $mundial = $_POST['mundial'];
                $pt_mundial = $_POST['pt_mundial'];
                $peso = $_POST['peso'];
                $altura = $_POST['altura'];
                $dex = $_POST['dex'];
                $mt = $_POST['mt'];
          
                $sqlM = "INSERT INTO persona (id_per,nomeper,idade,id_trei,regiao,cidade,insig,pt_mundial,mundial,peso,altura)
                VALUES ($id_per,'$nome','$idade','$id_treiner','$regiao','$cidade','$insig','$mundial','$pt_mundial','$peso','$altura')";
                $roda_sql=mysqli_query($_SESSION['conexao'],$sqlM);
              
                if($roda_sql){
                  echo '';
                }else{
                  echo '';
                }
              }
            ?>
            
            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Criar Ficha</h2>
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
                      <?php
                        //A pagina começa aqui

                      ?>
                      <div class="x_panel">
                        
                        <div class="x_content" style="display: block;">
                          <br>
                          <form action="criar_per.php" method="POST" id="demo-form2" enctype="multipart/form-data" class="form-horizontal form-label-left" >
                            <!--Topico do Trinador -->>
                            <h2>Personagem</h2>

                            <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Imagem<span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 ">
                                <input type="file" id="first-name" name="uploaded_file">
                              </div>
                            </div>
                            
                            <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nome do personagem<span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="first-name" class="form-control " name="nomeper"  value="<?php echo $user['nome']; ?>">
                              </div>
                            </div>


                            <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Região <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="last-name" name="regiao" required="required" class="form-control">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Cidade <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="last-name" name="cidade" required="required" class="form-control">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Idade <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="last-name" name="idade" required="required" class="form-control">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Peso <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="last-name" name="peso" required="required" class="form-control">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Altura <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="last-name" name="altura" required="required" class="form-control">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">ID. de Trinador</label>
                              <div class="col-md-6 col-sm-6 ">
                                <input id="middle-name" class="form-control" type="text" name="id_trei">
                              </div>
                            </div>

                            <div class="item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Metodo de Treinamento<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <select class="select2_group form-control" name="mt">
                                            <option value="emcorajador" name="mt">Emcorajador</option>
                                            <option value="ofensivo" name="mt">Ofensivo</option>
                                            <option value="resistente" name="mt">Resistente</option>
                                            <option value="estrategico" name="mt">Estrategico</option>
                                            <option value="protetor" name="mt">Protetor</option>
                                            <option value="agil" name="mt">Agil</option>
                                        </select>
                                    </div>
                                </div>
                            <!--Topico do Trinador -->

                            <!--Topico das comquistas -->
                            
                            <div class="item form-group">
                              <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Insignias</label>
                              <div class="col-md-6 col-sm-6 ">
                                <input id="middle-name" class="form-control" type="text" name="insig">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Torneios</label>
                              <div class="col-md-6 col-sm-6 ">
                                <input id="middle-name" class="form-control" type="text" name="torneios">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Dex</label>
                              <div class="col-md-6 col-sm-6 ">
                                <input id="middle-name" class="form-control" type="text" name="dex">
                              </div>
                            </div>
                            <!--Topico das comquistas -->

                            <!--Topico do mundial -->
                            <div class="item form-group">
                              <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Ranking Mundial</label>
                              <div class="col-md-6 col-sm-6 ">
                                <input id="middle-name" class="form-control" type="text" name="mundial">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Pontuação Mundial</label>
                              <div class="col-md-6 col-sm-6 ">
                                <input id="middle-name" class="form-control" type="text" name="pt_mundial">
                              </div>
                            </div>
                            <!--Topico do mundial -->


                            <div class="ln_solid"></div>

                            <div class="item form-group">

                              <div class="col-md-6 col-sm-6 offset-md-3">
                                
                                <button type="submit" class="btn btn-success">Salvar</button>
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
        <!-- /page content -->

<?php
include_once("layout/footer.php");
?>