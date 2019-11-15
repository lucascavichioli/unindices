<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title center">Índices Econômico-financeiros</h4>
                <h5><?php print $empresa?></h5>
              </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th>Índices</th>
                                    <?php
                                        foreach ($anos as $i => $ano) {
                                            print "<th>";
                                                print $ano;
                                            print "</th>";
                                        }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php   
                                foreach ($indices as $i => $valores) {
                                    foreach ($valores as $col => $c) {
                                        print "<tr>";
                                            print "<td>" . $col . "</td>";
                                            foreach ($indices as $ano) {
                                                print "<td title=''>";

                                                    print $ano->$col;
                                                    if($col === "EG" || $col === "CE" || $col === "GE" || $col === "GI" ||
                                                       $col === "ML"){
                                                        print "%";
                                                    }
                                                print "</td>";
                                            }
                                        print "</tr>";
                                    }
                                break;
                            }                              
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title center">Índices - Ano Anterior</h4>
                <h5><?php print $empresa?></h5>
              </div>
                <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                    <th>Índices - Ano Anterior</th>
                                        <?php
                                            foreach ($anosAnterior as $i => $ano) {
                                                print "<th>";
                                                    print $ano;
                                                print "</th>";
                                            }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php   
                                    foreach ($indicesAnoAnterior as $i => $valores) {
                                        foreach ($valores as $col => $c) {
                                            print "<tr>";
                                                print "<td>" . $col . "</td>";
                                                foreach ($indicesAnoAnterior as $ano) {
                                                    print "<td title=''>";
                                                        print $ano->$col;
                                                        if($col === "RSA" || $col === "RSPL"){
                                                        print "%";
                                                    }    
                                                    print "</td>";
                                                }
                                            print "</tr>";
                                        }
                                    break;
                                }                              
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title center">Legenda</h4>
              </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                        <thead>
                            <th>Liquidez</th>
                            <th>Endividamento e Estrutura de capital</th>
                            <th>Rentabilidade</th>
                            <th>Eficiência Operacional</th>
                        </thead>
                        <body>
                        <tr>
                            <td>LG - Líquidez Geral</td>
                            <td>EG - Endividamento Geral</td>
                            <td>MB - Margem Bruta</td>
                            <td>PMP - Prazo Médio de Pagamento</td>
                        </tr>
                        <tr>
                            <td>LS - Líquidez Seca</td>                
                            <td>GE - Grau de Endividamento</td>
                            <td>MO - Margem Operacional</td>
                            <td>PMC - Prazo Médio de Cobrança</td>
                        </tr>
                        <tr>
                            <td>LC - Líquidez Corrente</td>
                            <td>CE - Composição do Endividamento</td>
                            <td>ML - Margem Líquida</td>
                            <td>PME - Prazo Médio de Estocagem</td>
                        </tr>
                        <tr>
                            <td>LI - Líquidez Imediata</td>
                            <td>IRNC - Imobilização dos Recursos Não Correntes</td>
                            <td>RSA - Retorno Sobre o Ativo</td>
                            <td>CO - Ciclo Operacional</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>GI - Grau de Imobilização</td>
                            <td>RSPL - Retorno Sobre o Patrimônio Líquido</td>
                            <td>CF - Ciclo Financeiro</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>MAF - Multiplicador da Alavancagem Financeira</td>
                            <td>GA - Giro do Ativo</td>
                        </tr>
                        </body>         
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>