    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <!--<a class="navbar-brand" href="#pablo">Dashboard</a>-->
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>
      <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Adicionar Empresa</h5>
              </div>
              <div class="card-body">
                <form id="formulario" method='post' action='' class="validate-form" autocomplete="off">
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                        <label>Nome fantasia</label>
                        <input name="nomeFantasia" type="text" class="form-control" placeholder="Nome fantasia / Apelido" >
                      </div>
                    </div>
                    <!--<div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="Username" value="michael23">
                      </div>
                    </div>-->
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">E-mail</label>
                        <input name="email" type="text" class="form-control" placeholder="E-mail">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                        <label>CNAE - Atividade Principal</label>
                        <input name="cnae" type="text" class="form-control" placeholder="CNAE">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Atividades secundárias (CNAES)</label>
                        <input name="cnaeSec" type="text" class="form-control" placeholder="CNAES separados por ;" >
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                        <label>Quantidade de colaboradores</label>
                        <input name="qtdColaboradores" type="number" class="form-control" placeholder="Quantidade de empregados" >
                      </div>
                    </div>
                    <div class="form-group col-md-6 pl-1">
                    <label for="inputState">Estado</label>
                    <select id="uf" name="uf" class="form-control">
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                    </select>
                  </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Telefone</label>
                        <input name="telefone" type="text" class="form-control" onkeypress="MascaraTelefone(formulario.telefone);" maxlength="14" placeholder="(DDD)####-####">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Celular</label>
                        <input name="celular" type="text" class="form-control" onkeypress="MascaraTelefone(formulario.celular);" maxlength="14" placeholder="(DDD)####-#####">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                          CADASTRAR
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
                <a href="<?=base_url("dokuwiki")?>" target="_blank">Acesse a documentação</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>