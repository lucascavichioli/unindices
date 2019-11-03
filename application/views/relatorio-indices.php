<div class="row">
    <div class="title col-md-8">
        Notas: RUIM - SATISFATÓRIO - BOM - ÓTIMO
    </div>
</div>
<center><h3>Relatório - <?php print $empresa ?></h3></center>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
            <th>Índice</th>
                <?php
                    foreach ($anos as $ano) {
                        print "<th>";
                        print $ano;
                        print "</th>";
                    }
                ?>
            </tr>
        </thead>
        <tbody>
        <?php   
            foreach ($comparativos as $i => $v) {
                print "<tr>";
                print "<td class='text-left' title='teste'>" . $i . "</td>";
                    foreach ($v as $ano => $indice) {
                        print "<td title='". $indice['VALOR'] . "'>";
                            print $indice['POSICIONAMENTO'] . "(" . $indice['VALOR'] .")";
                        print "</td>";
                    }
                print "</tr>";
            }                          
        ?>
        </tbody>
    </table>
</div>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
            <th>Índices do Ano Anterior</th>
                <?php
                    foreach ($anosAnterior as $anoA) {
                        print "<th>";
                        print $anoA;
                        print "</th>";
                    }
                ?>
            </tr>
        </thead>
        <tbody>
        <?php   
            foreach ($comparativosAnoAnterior as $i => $v) {
                print "<tr>";
                print "<td class='text-left' title='teste'>" . $i . "</td>";
                    foreach ($v as $ano => $indice) {
                        print "<td title='". $indice['VALOR'] . "'>";
                            print $indice['POSICIONAMENTO'] . "(" . $indice['VALOR'] .")";
                        print "</td>";
                    }
                print "</tr>";
            }                          
        ?>
        </tbody>
    </table>
</div>
<div class="">
<h6>LEGENDAS</h6>
LG = Líquidez Geral
</div>