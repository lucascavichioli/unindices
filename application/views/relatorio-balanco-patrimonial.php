<div class="row">
    <div class="title col-md-8">
    </div>
</div>
<center><h3>Balanço Patrimonial</h3></center>
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
                                    print number_format($ano->$col,2,",",".");
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
