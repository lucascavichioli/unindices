<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Documentação - UnIndices</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Documentação</div>
      <div class="list-group list-group-flush">
        <a href="cadastroempresa.php" class="list-group-item list-group-item-action bg-light">Adicionar Empresas</a>
        <a href="cadastrodadosfinanceiros.php" class="list-group-item list-group-item-action bg-light">Cadastro Financeiro</a>
        <a href="atualizarinformacoes.php" class="list-group-item list-group-item-action bg-light">Atualizar informações</a>
        <a href="alterarsenha.php" class="list-group-item list-group-item-action bg-light">Alterar senha</a>
        <a href="dadoscadastrais.php" class="list-group-item list-group-item-action bg-light">Dados Cadastrais</a>
        <a href="indices.php" class="list-group-item list-group-item-action bg-light">Índices Econômico-Financeiros</a>
        <a href="calculoanalise.php" class="list-group-item list-group-item-action bg-light">Cálculo - Análise</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Exibir Menu</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="<?="http://localhost/tcc/"?>">Dashboard</a>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
        <h1 class="mt-4">Índices Econômico-Financeiros</h1>
        <p>Abaixo é listado todas as fórmulas utilizadas para o cálculo de cada índice.</p>
        <p>LI = Caixa e equivalentes de caixa (disponível) / Passivo Circulante;</p>
        <p>LC = Ativo Circulante / Passivo Circulante;</p>
        <p>LS = (Ativo Circulante - Estoque) / Passivo Circulante;</p>
        <p>LG = (Ativo Circulante + Ativo Realizável a Longo Prazo) / (Passivo Circulante + Passivo Não Circulante);</p>
        <p>EG = (Passivo Circulante + Passivo Não Circulante) / Passivo Total * 100;</p>
        <p>GE = (Passivo Circulante + Passivo Não Circulante) / Patrimônio Líquido * 100;</p>
        <p>CE = Passivo Circulante / (Passivo Circulante + Passivo Não Circulante) * 100;</p>
        <p>GI = (Investimentos + Imobilizado e Intangível) / Patrimônio Líquido * 100;</p>
        <p>IRNC = (Investimentos + Imobilizado e Intangível) / (Passivo Não Circulante + Patrimônio Líquido) * 100;</p>
        <p>MAF = Passivo Total / Patrimônio Líquido;</p>
        <p>MB = Lucro Bruto / Receita Líquida de Vendas * 100;</p>
        <p>MO = Resultado Operacional / Receita Líquida de Vendas * 100;</p>
        <p>ML = Resultado Líquido do Exercício / Receita Líquida de Vendas * 100;</p>
        <p>PMC = (((Clientes “ano anterior -1”) + (Clientes “ano anterior”)) /2) / (Receita Líquida de Vendas/360);</p>
        <p>PME = (((Estoque “ano anterior -1”) + (Estoque “ano anterior”)) /2) / (Custo das vendas/360);</p>
        <p>PMP = (((Fornecedores “ano anterior - 1”) + (Fornecedores “ano anterior”)) / 2) / ((Custo das Vendas + Estoque “ano anterior” – Estoque “ano anterior -1”) / 360);</p>
        <p>CO = PMC + PME;</p>
        <p>CF = CO – PMP;</p>
        <p>GA = Receita Líquida de Vendas / ((Ativo Total “ano anterior -1” + Ativo Total “ano anterior”) / 2);</p>
        <p>RSA = ML * GA;</p>
        <p>RSPL = RSA * MAF;</p>
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

</body>

</html>

