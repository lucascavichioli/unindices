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
        <h1 class="mt-4">Cadastro dos dados financeiros</h1>
        <p>Este documento tem por finalidade auxiliar no cadastro dos dados financeiros das empresas-clientes.</p>
        <p>Para o seu cadastro são exigidos as seguintes demontrações;</p>
        <ul>
            <li>Balanço Patrimonial (Ativos).</li>
            <li>Balanço Patrimonial (Passivos).</li>
            <li>Demonstração de Resultado do Exercício (DRE).</li>
        </ul>
        <p>O primeiro cadastro é composto por dois anos de exercícios, portanto, todos os campos deverão ser preenchidos, caso não possua valor para o campo exigido, este deverá ser preenchido com o valor <strong>zero (0)</strong>.</p>
        <p>Os campos que iniciam com "(-)" deverão ser preenchidos com o sinal de "-" na frente. Caso não adicionado, o próprio sistema converterá o número para negativo.</p>
        <h2>Cadastro Único</h2>
        <p>É considerado cadastro único aquele no qual a empresa possui registro dos dados financeiros de dois anos ou mais.</p>
        <p>Para este cadastro o sistema considera os mesmos campos, com a excessão de que é exigido somente um ano de exercício. Para o cálculo dos índices, o sistema fará uso do último ano cadastrado.</p>
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
