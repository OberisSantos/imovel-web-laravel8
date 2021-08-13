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
        <link rel="stylesheet" href="/css/style-web-site.css">



        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet">

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <script src="/js/script.js"></script>

  </head>
  <body class="d-flex flex-column h-100">
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-light rounded shadow"> <!-- navbar-dark fixed-top-->

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand btn-home" id="home" type="button" href="/"><span class="material-icons">
                home
                </span>
            </a>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" href="/">Locadora de imóveis</a>
                    </li>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <form action="/search/imovel" method="get">
                        @csrf
                        <li class="nav-item">
                            <select name="cidade" title="Cidade" class="btn btn-pesquisa">
                                <option value="">Cidade</option>
                                @isset($cidades)
                                    @foreach ($cidades as $cidade)
                                        <option value="{{$cidade}}">{{$cidade}}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </li>

                        <li class="nav-item">
                            <select name="quartos" title="Quartos" class="btn btn-pesquisa">
                                <option value="">Quartos</option>
                                <option value="1">1 Quarto</option>
                                <option value="2">2 Quartos</option>
                                <option value="3">3 Quartos</option>
                                <option value="4">Mais de 3 Quartos</option>
                            </select>
                        </li>
                        <li class="nav-item">
                            <select name="suite" title="Suíte" class="btn btn-pesquisa">
                                <option value="0">Suíte</option>
                                <option value="1">1 Suite</option>
                                <option value="2">2 Suites</option>
                                <option value="3">Mais de 2 Suites</option>
                            </select>
                        </li>
                        <li class="nav-item">
                            <select name="tipo" title="Tipo imóvel" class="btn btn-pesquisa">
                                <option value="">Tipo imóvel</option>
                                <option value="Apartamento">Apartamento</option>
                                <option value="Casa">Casa</option>
                                <option value="Quitinete">Kitnet</option>
                            </select>
                        </li>
                        <!--<li class="nav-item">
                            <select name="valor[]" title="Valor" id='valor' class="btn btn-pesquisa ">
                                <option value="{min:'0', max:'0'}">Valor</option>
                                <option value="valor[]=>0 valor[]=>300">Até 300,00</option>
                                <option value="700">300,00 à 700,00</option>
                                <option value="700">Acima que 700,00</option>
                            </select>
                        </li>-->
                        <li class="nav-item">
                            <button class="btn" title='Pesquisar imóvel'><span class="material-icons">
                                search
                                </span></button>
                        </li>
                    </form>
                    <li class="nav-item">
                        <a class="nav-link btn btn-restrito" href="/dashboard" style="color: #fff">Área Restrita</a>

                    </li>
                    @auth

                        <li class="nav-item">
                            <form action="/logout" method="post">
                                @csrf
                                <a class="nav-link btn btn-info btn-sm" style="width: 50px; height: 40px;" href="/logout" title="Sair" onclick="event.preventDefault(); this.closest('form').submit();"><span style="color: beige" class="material-icons">
                                    logout
                                    </span></a>
                            </form>
                        </li>
                    @endauth
                    @guest <!--User está logado-->
                        <li class="nav-item">
                            <a class="nav-link btn btn-login" href="/register" title="Registrar"><span class="material-icons">
                                person_add
                                </span></a>
                        </li>
                        <li class="nav-item">

                            <a class="nav-link btn btn-login"  href="/login" title="Login"><span class="material-icons">
                                login
                                </span></a>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </header>

    <!-- Begin page content -->
    <main role="main" class="container-fluid">

        @if(session('msg'))
            <div class="row justify-content-end sh">
                <div class="col-auto shadow-lg alert alert-primary"  id='msg' role="alert" style="position: absolute; z-index: 99;">
                    {{session('msg')}}
                </div>
            </div>
        @endif

        @yield('conteudo')
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


