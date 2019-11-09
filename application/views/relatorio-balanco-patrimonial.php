<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title center">Balanço Patrimonial</h4>
              </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th>Contas</th>
                                    <?php
                                        foreach ($anos as $i => $ano) {
                                            print "<th>";
                                                print $ano->BATIV_ANO_ID;
                                            print "</th>";
                                        }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php   
                                foreach ($balanco as $i => $valores) {
                                        foreach ($valores as $col => $c) {
                                            print "<tr>";
                                            print "<td>" . $col . "</td>";
                                                foreach ($balanco as $ano) {
                                                    print "<td title=''>";
                                                        print $ano[$col];
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