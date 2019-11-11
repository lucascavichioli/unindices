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