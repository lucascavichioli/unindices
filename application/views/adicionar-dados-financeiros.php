<div class="content">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h5 class="title">Cadastro dos dados financeiros</h5>
        </div>
        <div class="card-body">
          <form id="formulario" method='post' action='' class="validate-form" >
          <input name="empId" type="hidden" class="form-control" value="<?=$id?>"  required>
        
          <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-left">
                          <h6>Ativos</h6>
                        </th>
                        <th class="text-center">
                          <select id="anoAnteriorMenosUm" name="anoAnteriorMenosUm" class="form-control" required>
                              <?php foreach($anoAnteriorMenosUm as $ano_id => $attr){?>
                              <option value="<?=$attr->ano_id?>"><?=$attr->ano_ref?></option> <?php } ?>
                          </select>
                        </th>
                        <th class="text-center">
                          <select id="anoAnterior" name="anoAnterior" class="form-control"  required>
                              <?php foreach($anoAnterior as $ano_id => $attr){?>
                              <option value="<?=$attr->ano_id?>"><?=$attr->ano_ref?></option> <?php }?>
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
                              <input name="caixaEquivalenteDeCaixa" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Caixa e Equivalentes de caixa <?=$anoAnteriorMenosUm[0]->ano_ref;?>" maxlength="20" required>
                            </div>
                        </div>
                      </td>
                      <td>                        
                        <div class="col-md-18">
                            <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                              <input name="caixaEquivalenteDeCaixa2" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Caixa e Equivalentes de caixa <?=$anoAnterior[0]->ano_ref;?>" maxlength="20" required>
                            </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Clientes</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="clientes" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Clientes <?=$anoAnteriorMenosUm[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="clientes2" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Clientes <?=$anoAnterior[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Estoques</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="estoques" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Estoques <?=$anoAnteriorMenosUm[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="estoques2" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Estoques <?=$anoAnterior[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Outros ativos circulantes</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="outrosAtivosCirculantes" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Outros ativos circulantes <?=$anoAnteriorMenosUm[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="outrosAtivosCirculantes2" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Outros ativos circulantes <?=$anoAnterior[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Ativo realizável a longo prazo</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="ativoRealizavelLongoPrazo" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Ativo realizável a longo prazo <?=$anoAnteriorMenosUm[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="ativoRealizavelLongoPrazo2" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Ativo realizável a longo prazo <?=$anoAnterior[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Investimentos</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="investimentos" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Investimentos <?=$anoAnteriorMenosUm[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="investimentos2" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Investimentos <?=$anoAnterior[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Imobilizado e intangível</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="imobilizadoIntangivel" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Imobilizado e intangível <?=$anoAnteriorMenosUm[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="imobilizadoIntangivel2" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Imobilizado e intangível <?=$anoAnterior[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                </tbody>
            </table>
          </div>
          <div class="table-responsive">
            <table class="table table-hover">
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
                              <input name="fornecedores" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Fornecedores <?=$anoAnteriorMenosUm[0]->ano_ref;?>" maxlength="20" required>
                            </div>
                        </div>
                      </td>
                      <td>                        
                        <div class="col-18">
                            <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                              <input name="fornecedores2" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Fornecedores <?=$anoAnterior[0]->ano_ref;?>" maxlength="20" required>
                            </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Outros passivos circulantes</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="outrosPassivosCirculantes" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Outros Passivos Circulantes <?=$anoAnteriorMenosUm[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="outrosPassivosCirculantes2" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Outros Passivos Circulantes <?=$anoAnterior[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Passivo não circulante</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="passivoNaoCirculante" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Passivo Não Circulante <?=$anoAnteriorMenosUm[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="passivoNaoCirculante2" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Passivo Não Circulante <?=$anoAnterior[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Patrimônio Líquido</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="patrimonioLiquido" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Patrimônio Líquido <?=$anoAnteriorMenosUm[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="patrimonioLiquido2" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Patrimônio Líquido <?=$anoAnterior[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                </tbody>
            </table>
          </div>
          <div class="table-responsive">
            <table class="table table-hover">
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
                              <input name="receitaLiquidaVendas" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Receita líquida de vendas <?=$anoAnteriorMenosUm[0]->ano_ref;?>" maxlength="20" required>
                            </div>
                        </div>
                      </td>
                      <td>                        
                        <div class="col-18">
                            <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                              <input name="receitaLiquidaVendas2" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Receita líquida de vendas <?=$anoAnterior[0]->ano_ref;?>" maxlength="20" required>
                            </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>(-) Custo das vendas</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="custoVendas" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Custo de vendas <?=$anoAnteriorMenosUm[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="custoVendas2" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Custo de vendas <?=$anoAnterior[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>(-) Despesas operacionais (exceto financeiras)</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="despesasOperacionais" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Despesas Operacionais <?=$anoAnteriorMenosUm[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="despesasOperacionais2" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Despesas Operacionais <?=$anoAnterior[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Outras receitas operacionais (exceto financeiras)</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="outrasReceitasOperacionais" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Outras receitas peracionais <?=$anoAnteriorMenosUm[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="outrasReceitasOperacionais2" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Outras receitas peracionais <?=$anoAnterior[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>(-) Despesas financeiras</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="despesasFinanceiras" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Despesas financeiras <?=$anoAnteriorMenosUm[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="despesasFinanceiras2" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Despesas financeiras <?=$anoAnterior[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Receitas financeiras</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="receitasFinanceiras" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Receitas financeiras <?=$anoAnteriorMenosUm[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="receitasFinanceiras2" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Receitas financeiras <?=$anoAnterior[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>(-) Outras despesas</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="outrasDespesas" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Outras despesas <?=$anoAnteriorMenosUm[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="outrasDespesas2" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Outras despesas <?=$anoAnterior[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>(-) IRPJ e CSLL</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="irpjCsll" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="IRPJ e CSLL <?=$anoAnteriorMenosUm[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="irpjCsll2" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="IRPJ e CSLL <?=$anoAnterior[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>(-) Contribuições e participações</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="contribuicoesParticipacoes" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Contribuições e participações <?=$anoAnteriorMenosUm[0]->ano_ref;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="contribuicoesParticipacoes2" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Contribuições e participações <?=$anoAnterior[0]->ano_ref;?>" maxlength="20" required>
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
            Para cadastrar os dados financeiros, 
            <br> preencha todos os campos, caso o número for negativo,
            <br> este deve ser preenchido com o sinal de "-" na frente
          </p>
        </div>
        <hr>
        <div class="button-container">
          <a href="<?=base_url("documentation/cadastrodadosfinanceiros.php")?>" target="_blank">Acesse a documentação</a>
        </div>
      </div>
    </div>
  </div>
</div>