

<div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Alterar Senha</h5>
              </div>
              <div class="card-body">
                <form id="formulario" method='post' action='' class="validate-form" autocomplete="off">
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group <?=$alert ?? ''?>" data-validate = "<?=$mensagem ??''?>">
                        <label>Nova Senha</label>
                        <input name="senha" type="password" class="form-control" placeholder="********" minlength="6">
                      </div>
                    </div>
                    <input name="empId" type="hidden" class="form-control" value="<?=$this->session->userdata('cont_id')?>"  required>
                    <div class="col-md-6 pl-1">
                      <div class="form-group <?=$alert ?? ''?>" data-validate = "<?=$mensagem ??''?>">
                        <label for="exampleInputEmail1">Confirmar Senha</label>
                        <input name="confirmarSenha" type="password" class="form-control" placeholder="********" minlength="6" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                          ALTERAR
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
                Preencha uma senha segura.
                  <br> Não esqueça de preencher a mesma senha nos dois campos
                  <br> para o sistema validar!
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