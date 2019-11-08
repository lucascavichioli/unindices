<div class="row">
    <div class="title col-md-8">
    </div>
</div>
<center><h3>Índices Econômico-Financeiros</h3></center>
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