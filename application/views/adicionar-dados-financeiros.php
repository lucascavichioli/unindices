<div class="content">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h5 class="title">Cadastro dos dados financeiros</h5>
        </div>
        <div class="card-body">
          <form id="formulario" method='post' action='' class="validate-form" >
          <input name="empId" type="hidden" class="form-control" value="<?=$id?>">
        
          <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-left"><h6>Ativos</h6></th>
                        <th class="text-center">
                          <select id="anoAnteriorMenosUm" name="anoAnteriorMenosUm" class="form-control">
                                    <option value="2018">2018</option>
                          </select>
                        </th>
                        <th class="text-center">
                          <select id="anoAnterior" name="anoAnterior" class="form-control">
                                    <option value="2019">2019</option>
                          </select>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                      <td class="text-left">Caixa e equivalentes de caixa (disponível)</td>
                      <td>                        
                        <div class="col-md-18">
                            <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                              <input name="caixaEquivalenteDeCaixa" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="Caixa e Equivalentes de caixa" >
                            </div>
                        </div>
                      </td>
                      <td>                        
                        <div class="col-md-18">
                            <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                              <input name="caixaEquivalenteDeCaixa2" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="Caixa e Equivalentes de caixa" >
                            </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Clientes</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="clientes" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="Clientes" >
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="clientes2" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="Clientes" >
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Estoques</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="estoques" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="Estoques" >
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="estoques2" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="Estoques" >
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Outros ativos circulantes</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="outrosAtivosCirculantes" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="Outros ativos circulantes" >
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="outrosAtivosCirculantes2" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="Outros ativos circulantes" >
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Ativo realizável a longo prazo</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="ativoRealizavelLongoPrazo" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="Ativo realizável a longo prazo" >
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="ativoRealizavelLongoPrazo2" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="Ativo realizável a longo prazo" >
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Investimentos</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="investimentos" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="Investimentos" >
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="investimentos2" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="Investimentos" >
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Imobilizado e intangível</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="imobilizadoIntangivel" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="Imobilizado e intangível" >
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="imobilizadoIntangivel2" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="Imobilizado e intangível" >
                          </div>
                        </div>
                      </td>
                    </tr>
                </tbody>
            </table>
          </div>
          <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-left"><h6>Passivos</h6></th>
                        <th class="text-center">
                          
                        </th>
                        <th class="text-center">
                          
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                      <td class="text-left">Fornecedores</td>
                      <td>                        
                        <div class="col-18">
                            <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                              <input name="fornecedores" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="Fornecedores" >
                            </div>
                        </div>
                      </td>
                      <td>                        
                        <div class="col-18">
                            <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                              <input name="fornecedores2" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="Fornecedores" >
                            </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Outros passivos circulantes</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="outrosPassivosCirculantes" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="" >
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="outrosPassivosCirculantes2" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="" >
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Passivo não circulante</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="passivoNaoCirculante" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="" >
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="passivoNaoCirculante2" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="" >
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Patrimônio Líquido</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="patrimonioLiquido" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="" >
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="patrimonioLiquido2" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="" >
                          </div>
                        </div>
                      </td>
                    </tr>
                </tbody>
            </table>
          </div>
          <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-left"><h6>Demonstrativo de Resultado (DRE)</h6></th>
                        <th class="text-center">
                          
                        </th>
                        <th class="text-center">
                          
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                      <td class="text-left">Receita Líquida de Vendas</td>
                      <td>                        
                        <div class="col-18">
                            <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                              <input name="receitaLiquidaVendas" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="" >
                            </div>
                        </div>
                      </td>
                      <td>                        
                        <div class="col-18">
                            <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                              <input name="receitaLiquidaVendas2" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="" >
                            </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>(-) Custo das vendas</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="custoVendas" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="" >
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="custoVendas2" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="" >
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>(-)Despesas operacionais (exceto financeiras)</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="despesasOperacionais" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="" >
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="despesasOperacionais2" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="" >
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Outras receitas operacionais (exceto financeiras)</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="outrasReceitasOperacionais" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="" >
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="outrasReceitasOperacionais2" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="" >
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>(-) Despesas financeiras</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="despesasFinanceiras" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="" >
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="despesasFinanceiras2" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="" >
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Receitas financeiras</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="receitasFinanceiras" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="" >
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="receitasFinanceiras2" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="" >
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>(-) Outras despesas</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="outrasDespesas" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="" >
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="outrasDespesas2" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="" >
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>(-) IRPJ e CSLL</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="irpjCsll" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="" >
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="irpjCsll2" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="" >
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>(-) Contribuições e participações</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="contribuicoesParticipacoes" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="" >
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="contribuicoesParticipacoes2" type="text" class="form-control" onKeyUp="maskIt(this,event,'###.###.###,##',true)" placeholder="" >
                          </div>
                        </div>
                      </td>
                    </tr>
                </tbody>
            </table>
          </div>

          <div class="row justify-content-center">  
            <div class="row">
              <div class="col-lg">
                <div class="container-login100-form-btn">
                  <button class="login100-form-btn">
                    CADASTRAR
                  </button>
                </div>
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