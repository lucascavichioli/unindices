      <div id="content" class="content">
        <div class="row">
          <?php if(empty($empresas)){?> <div class="card"><div class="col-12">No momento, você não possui nenhuma empresa para gerenciar! <a href="<?=base_url("painel/novaempresa");?>" class="simple-text logo-normal"><strong>Adicione uma empresa-cliente!</strong></a> </div></div><?php } 
            else{foreach($empresas as $e => $attr){ ?>
            <div class="col-lg-4 col-md-6">
              <div id= "<?=$attr->emp_id?>" class="card card-chart">
                <div class="card-header">
                  <h5 class="card-category">Código: <?=$attr->emp_id?></h5>
                  <h4 class="card-title"><?=$attr->emp_nome?></h4>
                  <div class="dropdown">
                    <button type="button" class="btn btn-round btn-outline-default dropdown-toggle btn-simple btn-icon no-caret" data-toggle="dropdown">
                    <i class="fas fa-cog"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="<?=base_url("empresacliente/cadastrardadosfinanceiros/").base64_encode($attr->emp_id);?>">Adicionar Dados Financeiros</a>
                      <a class="dropdown-item" href="<?=base_url("empresacliente/atualizarempresa/").base64_encode($attr->emp_id);?>">Atualizar informações</a>
                      <button class="excluirEmpresa dropdown-item text-danger" empresa="<?=$attr->emp_id?>">Excluir empresa</button>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <table class="table responsive">
                    <thead>
                        <tr>
                        <th></th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><a href="<?=base_url("indices/relatorio/").base64_encode($attr->emp_id);?>" class="card-link"><button class="btn btn-default btn-round">Índices</button></a></td>
                        <td><a href="<?=base_url("balancopatrimonial/relatorio/").base64_encode($attr->emp_id);?>" class="card-link"><button class="btn btn-default btn-round">Balanço Patrimonial</button></a></td>
                      </tr>
                      <tr>
                        <td><a href="<?=base_url("indices/analise/").base64_encode($attr->emp_id);?>" class="card-link analise"><button class="btn btn-default btn-round">Análise</button></a></td>
                      </tr>     
                    </tbody>
                  </table>
                  
                  <div class="row">
                      <div class="col-md-12">
                        <p class="card-text">CNAE: <strong><?=$attr->emp_cnae?></strong></p>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <p class="card-text">Estado: <strong><?=$attr->emp_uf?></strong></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <p class="card-text">Colaboradores: <strong><?=$attr->emp_qtd_emp?></strong></p>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="now-ui-icons arrows-1_refresh-69"></i> 
                  </div>
                </div>
              </div>
            </div>
          <?php }} ?>
        </div>
      </div>