<div class="row">
    <div class="title col-md-8">
        Notas: RUIM - SATISFATÓRIO - BOM - ÓTIMO
    </div>
</div>
<center><h3>Análise - <?php print $empresa ?></h3></center>
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
                        print "<td title='" . $indice['VALOR'] . "' onclick='modalQuartil(\"" . $indice['ind'] . $indice['ano'] . "\")'>";
                            print $indice['POSICIONAMENTO'] . "(" . $indice['VALOR'] .")";
                            ?>
                            <div id="modalQuartil<?php print $indice['ind'].$indice['ano']; ?>" class="modal fade">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h4 class="modal-title">Índices padrão - <?php print $i . " / "; print $indice['ano'] ?? '';?></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 pr-1">
                                                    <label><?=$indice['Q1'] ?? ''?></label>
                                                    <label><?=$indice['Q2'] ?? ''?></label>
                                                    <label><?=$indice['Q3'] ?? ''?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php print "</td>";
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
            <th>Índices - Ano Anterior</th>
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