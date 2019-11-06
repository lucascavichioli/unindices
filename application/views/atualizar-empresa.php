<div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Atualizar Empresa</h5>
              </div>
              <div class="card-body">
                <form id="formulario" method='post' action='' class="validate-form" autocomplete="off">
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                        <label>Nome fantasia</label>
                        <input name="nomeFantasia" type="text" class="form-control" placeholder="Nome fantasia / Apelido" value="<?=$emp_nome ?? ''?>">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">E-mail</label>
                        <input name="email" type="text" class="form-control" placeholder="E-mail" value="<?=$emp_email ?? ''?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                        <label>CNAE - Atividade Principal</label>
                        <input id="cnae" name="cnae" type="text" class="form-control" onclick="teste()" placeholder="CNAE" value="<?=$emp_cnae ?? ''?>">
                      </div>
                    </div>

                    <div id="modalCnae" class="modal fade">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Buscar Cnaes</h4>
                          </div>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-md-6 pr-1">
                                <input type="text" name="buscar" class="form-control">
                              </div>
                              <div class="col-md-6 pr-1">
                                <a class="btn btn-default">BUSCAR<i class="fas fa-search"></i></a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Atividades secundárias (CNAES)</label>
                        <input name="cnaeSec" type="text" class="form-control" placeholder="CNAES separados por ;" value="<?=$emp_cnae_secundario ?? ''?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                        <label>Quantidade de colaboradores</label>
                        <input name="qtdColaboradores" type="number" class="form-control" placeholder="Quantidade de empregados" value="<?=$emp_qtd_emp ?? ''?>">
                      </div>
                    </div>
                    <div class="form-group col-md-6 pl-1">
                    <label for="inputState">Estado</label>
                    <input id="uf" name="uf" value="<?= $emp_uf ?? ''?>" class="form-control" readonly>
                  </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Telefone</label>
                        <input name="telefone" type="text" class="form-control" onkeypress="MascaraTelefone(formulario.telefone);" maxlength="14" placeholder="(DDD)####-####" value="<?=$emp_telefone ?? ''?>">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Celular</label>
                        <input name="celular" type="text" class="form-control" onkeypress="MascaraTelefone(formulario.celular);" maxlength="14" placeholder="(DDD)####-#####" value="<?=$emp_telefone2 ?? ''?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                          ATUALIZAR
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-user">
              <div class="image">
                <!--<img src="" alt="...">-->
              </div> 
              <div class="card-body">
                <div class="author">
                  <a href="#">
                    <!--<img class="avatar border-gray" src="" alt="...">-->
                    <h5 class="title">Ajuda</h5>
                  </a>
                  <p class="description">
                    UniIndices
                  </p>
                </div>
                <p class="description text-center">
                  Escolha um nome fantasia ou apelido para lembrar da empresa-cliente
                  <br> Não estamos interessados em saber qual é a empresa
                  <br> Ao preencha todos os dados
                </p>
              </div>
              <hr>
              <div class="button-container">
                <a href="<?=base_url("documentation/cadastroempresa.php")?>" target="_blank">Acesse a documentação</a>
              </div>
            </div>
          </div>
        </div>
      </div>