<h6>Desempenho dos índices</h6>
<div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <?php
                            foreach ($anos as $ano) {
                                print "<th class='text-center'>";
                                print $ano;
                                print "</th>";
                            }
                        ?>
                    </tr>
                </thead>
                <tbody>
                <?php   
                    foreach ($indices as $i) {
                        print "<tr>";
                            foreach ($i as $ano => $indice) {
                                print "<td>";
                                    foreach ($indice as $valor) {
                                        print $valor;
                                    }
                                print "</td>";
                            }
                        print "</tr>";
                    }                          
                ?>
                </tbody>
            </table>
</div>