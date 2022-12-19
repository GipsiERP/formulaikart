<div class="horizontal-menu">
    <nav class="navbar top-navbar col-lg-12 col-12 p-0">
    <div class="container-fluid">
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
        <ul class="navbar-nav navbar-nav-left">
            <li class="nav-item ms-0 me-5 d-lg-flex d-none">
            <a href="#" class="nav-link horizontal-nav-left-menu"><i class="mdi mdi-format-list-bulleted"></i></a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <i class="mdi mdi-bell mx-0"></i>
                <span class="count bg-success">2</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                        <i class="mdi mdi-information mx-0"></i>
                    </div>
                </div>
                <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">Application Error</h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                        Just now
                    </p>
                </div>
                </a>
                <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <div class="preview-icon bg-warning">
                        <i class="mdi mdi-settings mx-0"></i>
                    </div>
                </div>
                <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">Settings</h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                        Private message
                    </p>
                </div>
                </a>
                <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                        <i class="mdi mdi-account-box mx-0"></i>
                    </div>
                </div>
                <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal">New user registration</h6>
                    <p class="font-weight-light small-text mb-0 text-muted">
                        2 days ago
                    </p>
                </div>
                </a>
            </div>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-bs-toggle="dropdown">
                <i class="mdi mdi-email mx-0"></i>
                <span class="count bg-primary">4</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                    <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                    </h6>
                    <p class="font-weight-light small-text text-muted mb-0">
                        The meeting is cancelled
                    </p>
                </div>
                </a>
                <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                    <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook
                    </h6>
                    <p class="font-weight-light small-text text-muted mb-0">
                        New product launch
                    </p>
                </div>
                </a>
                <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                    <h6 class="preview-subject ellipsis font-weight-normal"> Johnson
                    </h6>
                    <p class="font-weight-light small-text text-muted mb-0">
                        Upcoming board meeting
                    </p>
                </div>
                </a>
            </div>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link count-indicator "><i class="mdi mdi-message-reply-text"></i></a>
            </li>
        </ul>
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="/home"><img src="images/logo.png" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="/home"><img src="images/logo-mini.png" alt="logo"/></a>
        </div>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                    <span class="nav-profile-name">{{ Auth::user()->name }}</span>
                    <span class="online-status"></span>
                    <img src="{{ Storage::url('/img/faces/'.Auth::user()->id.'.png' ) }}" alt="profile"/>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item">
                    <i class="mdi mdi-cog-outline text-primary"></i>
                    Settings
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-logout text-primary"></i>
                        Sair
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
            <span class="mdi mdi-menu"></span>
        </button>
        </div>
    </div>
    </nav>
    <nav class="bottom-navbar">
        <div class="container">
            <ul class="nav page-navigation">
                <li class="nav-item">
                <a class="nav-link" href="/home">
                    <i class="mdi mdi-file-document menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
                </li>

                <li class="nav-item mega-menu">
                    <a href="#" class="nav-link">
                        <i class="mdi mdi-account menu-icon"></i>
                        <span class="menu-title">Gestão Campeonato</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="submenu">
                        <div class="col-group-wrapper row">
                            <div class="col-group col-md-4">
                            <div class="row">
                                <div class="col-12">
                                    <p class="category-heading">Processos</p>
                                    <div class="submenu-item">
                                        <div class="row">
                                        <div class="col-md-12">
                                            <ul>
                                                <li class="nav-item"><a class="nav-link" href="/geraCategoriaDrivers">Gerar Equipes por Categoria</a></li>
                                                <li class="nav-item"><a class="nav-link" href="/kartRaffle">Sorteio dos Karts</a></li>                                                
                                            </ul>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-group col-md-4">
                            <div class="row">
                                <div class="col-12">
                                    <p class="category-heading">Financeiro</p>
                                    <div class="submenu-item">
                                        <div class="row">
                                        <div class="col-md-12">
                                            <ul>
                                                <li class="nav-item"><a class="nav-link" href="/Finances">Contas a Pagar e Receber</a></li>                                
                                                <li class="nav-item"><a class="nav-link" href="/Banks">Banco</a></li>
                                                <li class="nav-item"><a class="nav-link" href="/AdmSupplier">Fornecedores</a></li>
                                                <li class="nav-item"><a class="nav-link" href="/AdmFinance/cashflow">Fluxo de Caixa</a></li>
                                                <li class="nav-item"><a class="nav-link" href="/AdmFinance/conciliacion">Conciliação Bancária</a></li>
                                                <li class="nav-item"><a class="nav-link" href="/AdmFinance/balance">Extrato Bancário</a></li>
                                            </ul>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-group col-md-4">
                            <div class="row">
                                <div class="col-12">
                                    <p class="category-heading">Cadastros</p>
                                    <div class="submenu-item">
                                        <div class="row">
                                        <div class="col-md-12">
                                            <ul>
                                                <li class="nav-item"><a class="nav-link" href="/TeamDrivers">Equipe de Pilotos</a></li>
                                                <li class="nav-item"><a class="nav-link" href="/Drivers">Pilotos</a></li>
                                                <li class="nav-item"><a class="nav-link" href="/Events">Etapa / Corrida</a></li>
                                                <li class="nav-item"><a class="nav-link" href="/Tracks">Kartodromo</a></li>
                                                <li class="nav-item"><a class="nav-link" href="/Championships">Campeonato</a></li>
                                            </ul>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </li>



                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="mdi mdi-file-chart menu-icon"></i>
                    <span class="menu-title">Relatórios</span>
                    <i class="menu-arrow"></i>
                    </a>
                    <div class="submenu">
                        <ul>
                            <li class="nav-item"><a class="nav-link" href="/ReportskartRaffle">Sorteio dos Karts</a></li>
                            <li class="nav-item"><a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="pages/forms/basic_elements.html" class="nav-link">
                    <i class="mdi mdi-chart-areaspline menu-icon"></i>
                    <span class="menu-title">Form Elements</span>
                    <i class="menu-arrow"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/charts/chartjs.html" class="nav-link">
                    <i class="mdi mdi-finance menu-icon"></i>
                    <span class="menu-title">Charts</span>
                    <i class="menu-arrow"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/tables/basic-table.html" class="nav-link">
                    <i class="mdi mdi-grid menu-icon"></i>
                    <span class="menu-title">Tables</span>
                    <i class="menu-arrow"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/icons/mdi.html" class="nav-link">
                    <i class="mdi mdi-emoticon menu-icon"></i>
                    <span class="menu-title">Icons</span>
                    <i class="menu-arrow"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="mdi mdi-codepen menu-icon"></i>
                    <span class="menu-title">Sample Pages</span>
                    <i class="menu-arrow"></i>
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            <li class="nav-item"><a class="nav-link" href="pages/samples/login.html">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="pages/samples/login-2.html">Login 2</a></li>
                            <li class="nav-item"><a class="nav-link" href="pages/samples/register.html">Register</a></li>
                            <li class="nav-item"><a class="nav-link" href="pages/samples/register-2.html">Register 2</a></li>
                            <li class="nav-item"><a class="nav-link" href="pages/samples/lock-screen.html">Lockscreen</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>