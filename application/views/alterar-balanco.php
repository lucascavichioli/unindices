<div class="content">
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h5 class="title">Alterar Dados Financeiros</h5>
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
                          <select id="ano" name="ano" class="form-control" required>
                              <option value="<?=$ano?>"><?=$ano?></option>
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
                              <input name="caixaEquivalenteDeCaixa" value="<?=$BATIV_CAIXA_EQUIV_CAIXA?>" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Caixa e Equivalentes de caixa <?=$ano;?>" maxlength="20" required>
                            </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Clientes</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="clientes" value="<?=$BATIV_CLIENTES?>" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Clientes <?=$ano;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Estoques</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="estoques" value="<?=$BATIV_ESTOQUE?>" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Estoques <?=$ano;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Outros ativos circulantes</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="outrosAtivosCirculantes" value="<?=$BATIV_OUTROS_ATIVOS_CIRCULANTES?>" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Outros ativos circulantes <?=$ano;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Ativo realizável a longo prazo</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="ativoRealizavelLongoPrazo" value="<?=$BATIV_ATIVO_RLP?>" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Ativo realizável a longo prazo <?=$ano;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Investimentos</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="investimentos" value="<?=$BATIV_INVESTIMENTOS?>" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Investimentos <?=$ano;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Imobilizado e intangível</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="imobilizadoIntangivel" value="<?=$BATIV_IMOB_INTANGIVEL?>" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Imobilizado e intangível <?=$ano;?>" maxlength="20" required>
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
                    </tr>
                </thead>
                <tbody>
                    <tr>
                      <td class="text-left">Fornecedores</td>
                      <td>                        
                        <div class="col-18">
                            <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                              <input name="fornecedores" value="<?=$BPAS_FORNECEDORES?>" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Fornecedores <?=$ano;?>" maxlength="20" required>
                            </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Outros passivos circulantes</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="outrosPassivosCirculantes" value="<?=$BPAS_OUTROS_PASSIVOS_CIRCULANTES?>" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Outros passivos circulantes <?=$ano;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Passivo não circulante</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="passivoNaoCirculante" value="<?=$BPAS_PASSIVO_N_CIRCULANTE?>" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Passivo não circulante <?=$ano;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Patrimônio Líquido</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="patrimonioLiquido" value="<?=$BPAS_PATRIMONIO_LIQUIDO?>" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Patrimônio líquido <?=$ano;?>" maxlength="20" required>
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
                    </tr>
                </thead>
                <tbody>
                    <tr>
                      <td class="text-left">Receita Líquida de Vendas</td>
                      <td>                        
                        <div class="col-18">
                            <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                              <input name="receitaLiquidaVendas" value="<?=$DRES_RECEITA_LIQUIDA_VENDAS?>" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Receita líquida de vendas <?=$ano;?>" maxlength="20" required>
                            </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>(-) Custo das vendas</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="custoVendas" value="<?=$DRES_CUSTO_VENDAS?>" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder=" Custo de vendas <?=$ano;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>(-) Despesas operacionais (exceto financeiras)</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="despesasOperacionais" value="<?=$DRES_DESPESAS_OPERACIONAIS?>" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Despesas operacionais <?=$ano;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Outras receitas operacionais (exceto financeiras)</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="outrasReceitasOperacionais" value="<?=$DRES_OUTRAS_RECEITAS_OP?>" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Outras receitas operacionais <?=$ano;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>(-) Despesas financeiras</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="despesasFinanceiras" value="<?=$DRES_DESPESAS_FINANCEIRAS?>" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Despesas financeiras <?=$ano;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>Receitas financeiras</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="receitasFinanceiras" value="<?=$DRES_RECEITAS_FINANCEIRAS?>" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Receitas financeiras <?=$ano;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>(-) Outras despesas</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="outrasDespesas" value="<?=$DRES_OUTRAS_DESPESAS?>" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Outras despesas <?=$ano;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>(-) IRPJ e CSLL</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="irpjCsll" value="<?=$DRES_IRPJ_CSLL?>" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="IRPJ e CSLL <?=$ano;?>" maxlength="20" required>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>(-) Contribuições e participações</td>
                      <td>
                        <div class="col-18">
                          <div class="form-group <?=$alert ?? ''?>" data-validate = "Campo obrigatório">
                            <input name="contribuicoesParticipacoes" value="<?=$DRES_CONTRIBUICOES_PARTICIP?>" type="text" class="form-control" onKeyUp="mascaraMoeda(this);" placeholder="Contribuições e participações <?=$ano;?>" maxlength="20" required>
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
                    ALTERAR
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
            Caso algum dado foi digitado equivocadamente, 
            <br> altere o campo desejado.
            <br> Só é possível alterar os dados do último ano de exercício
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