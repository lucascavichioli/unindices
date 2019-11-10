<div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Dados Cadastrais</h5>
              </div>
              <div class="card-body">
                <form id="formulario" method='post' action='' class="validate-form" autocomplete="off">
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Contabilidade / Contador</label>
                        <input name="nome" type="text" class="form-control" placeholder="" value="<?=$cont_nome ?? ''?>" readonly>
                      </div>
                    </div>
                    <input name="contId" type="hidden" class="form-control" value="<?=$this->session->userdata('cont_id');?>" >
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">E-mail</label>
                        <input name="email" type="email" class="form-control <?=$alert ?? ''?>" data-validate="Digite um e-mail válido" placeholder="E-mail" value="<?=$cont_email ?? ''?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>CNPJ / CRC</label>
                        <input id="card" name="card" type="text" class="form-control" placeholder="CNPJ / CRC" value="<?=$cont_crc ?? $cont_rec_cnpj?>" readonly>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Responsável</label>
                        <input name="responsavel" type="text" class="form-control" placeholder="Responsável" value="<?=$cont_responsavel ?? ''?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Telefone</label>
                        <input name="telefone" type="text" class="form-control" onkeypress="MascaraTelefone(formulario.telefone);" maxlength="14" placeholder="(DDD)####-####" value="<?=$cont_telefone ?? ''?>">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Celular</label>
                        <input name="celular" type="text" class="form-control" onkeypress="MascaraTelefone(formulario.celular);" maxlength="14" placeholder="(DDD)####-#####" value="<?=$cont_telefone2 ?? ''?>">
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