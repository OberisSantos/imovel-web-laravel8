<!doctype html>
<html lang="pt-br" class="h-100">
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.80.0">
        <title>@yield('titulo')</title>

        <script src="/js/jquery-3.6.0.min.js"></script>
        <script src="/js/jquery.mask.min.js"></script>
        <!--CSS Bootstrap-->
        <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">

        <!--CSS da aplicação -->
        <link rel="stylesheet" href="/css/style.css">
        <script src="/js/script.js"></script>


        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet">

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">



  </head>
  <body class="d-flex flex-column h-100" onload="time()">

    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-light rounded shadow"> <!-- navbar-dark fixed-top-->

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">

                <ul class="navbar-nav mr-auto">
                    <li>
                        <a href="/dashboard"><button class="btn btn-secondary btn-sm" title="Home"><span class="material-icons">home</span></button> </a>
                    </li>

                    <li class="nav-item dropdown active">
                        @if (Auth::user()->dono)
                            <a class="nav-link dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Cadastro
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <a class="dropdown-item" href="/imovel/create">Imóvel</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/locatario/create">Locatário</a>

                            </div>
                        @endif


                    </li>


                    <li class="nav-item dropdown active ">
                        @if (Auth::user()->dono)
                            <a class="nav-link dropdown-toggle"  title="Cadastro" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Listar</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <a class="dropdown-item" href="/imovel/list/{}">Imóvel</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/contrato/{}">Todos os Contratos</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/locatario/list/">Locatário</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/prop/create">Proprietário</a>
                            </div>
                        @endif
                    </li>

                    <li class="nav-item dropdown active">
                        @if (Auth::user()->dono)
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Operações</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <a class="dropdown-item" href="/locatario/list/{}">Contrato de Aluguel</a>
                            </div>
                        @endif
                    </li>

                    <li class="nav-item dropdown active ">
                        @if (Auth::user()->dono)
                            <a class="nav-link dropdown-toggle" title="Cadastro" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Finanças</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <a class="dropdown-item" href="/conta/receber/list/{}">Listar contas</a>
                            </div>
                        @endif
                    </li>

                </ul>
                <ul class="nav navbar-nav navbar-right" style="display: flex;align-items: flex-end">
                    @auth

                        <li class="nav-item">

                            <span  style="margin-right: 15px; min-width: 200px;  height: 50px; display: flex; align-items: center; color: rgb(7, 7, 7)">
                                Seja bem-vindo: {{Auth::user()->name}}

                            </span>

                        </li>
                        <li class="nav-item">

                            <a class="nav-link btn btn-secondary bg-transparent" style="margin-right: 15px; width: 140px; height: 50px; display: flex; align-items: center; color: rgb(7, 7, 7)"  href="/" title="Área externa">
                                <span style="color: rgb(0, 0, 0)" class="material-icons">
                                    mic_external_off
                                </span>Área externa

                            </a>

                        </li>
                        @yield('notificacao')

                        <li class="nav-item">
                            <form action="/logout" method="post">
                                @csrf
                                <a class="nav-link btn btn-info btn-sm" style="width: 50px;" href="/logout" title="Sair" onclick="event.preventDefault(); this.closest('form').submit();"><span style="color: beige" class="material-icons">
                                    logout
                                    </span></a>
                            </form>


                        </li>
                    @endauth
                    @guest <!--User está logado-->
                        <li class="nav-item">
                            <a class="nav-link" href="/register" title="Registrar"><span class="material-icons">
                                person_add
                                </span></a>
                        </li>
                        <li class="nav-item">

                            <a class="nav-link" href="/login" title="Login"><span class="material-icons">
                                login
                                </span></a>
                        </li>
                    @endguest


                </ul>


            </div>
        </nav>
    </header>



    <!-- Begin page content -->
    <main role="main" class="container">
        <!--
        <div class="btn-group-vertical">
            ...
        </div>-->
        @if(session('msg'))
            <div class="row justify-content-end sh">
                <div class="col-auto shadow-lg alert alert-primary"  id='msg' role="alert" style="position: absolute; z-index: 99;">
                    {{session('msg')}}
                </div>
            </div>
        @endif
        @yield('conteudo')
        <!--<div class="shadow p-3 mb-1 bg-light rounded justify-content">

        </div>-->

    </main>

    <footer class="footer mt-auto py-3">
        <div class="container-fluid">
            <span class="text-muted">&copy</span>
        </div>
    </footer>

    <script src="/js/jquery-3.6.0.min.js"></script>
    <script src="/js/jquery.mask.min.js"></script>
    <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="/js/bootstrap/bootstrap.min.js"></script>



  </body>
</html>


