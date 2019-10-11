<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="" class="simple-text logo-mini">
          UI
        </a>
        <a href="" class="simple-text logo-normal">
          UnIndices
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li class="<?=$activeDashboard ?? ''?>">
            <a href="<?=base_url()?>painel/dashboard">
            <i class="fas fa-chart-line"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="<?=$activeAddEmpresa ?? ''?>">
            <a href="<?=base_url()?>painel/novaempresa">
            <i class="fas fa-plus"></i>
              <p>Adicionar Empresa</p>
            </a>
          </li>
          
          <li class="active-pro">
            <a href="<?=base_url()?>painel/sair">
            <i class="fas fa-door-open"></i>
              <p>Sair</p>
            </a>
          </li>
        </ul>
      </div>
    </div>