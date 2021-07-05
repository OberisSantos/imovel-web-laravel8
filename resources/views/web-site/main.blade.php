<!doctype html>
<html lang="pt-br" class="h-100">
  <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.80.0">
        <title>@yield('titulo')</title>

        <!--CSS Bootstrap-->
        <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css">

        <!--CSS da aplicação -->
        <link rel="stylesheet" href="/css/style-web-site.css">

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet">

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  </head>
  <body class="d-flex flex-column h-100">
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-light rounded shadow"> <!-- navbar-dark fixed-top-->
            <a class="navbar-brand" href="/">Locação</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">


                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard">Aplicação</a>
                        </li>
                        <li class="nav-item">
                            <form action="/logout" method="post">
                                @csrf
                                <a class="nav-link" href="/logout" title="Sair" onclick="event.preventDefault(); this.closest('form').submit();"><span class="material-icons">
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
    <main role="main" class="container-fluid">
        @yield('conteudo')
    </main>

    <footer class="footer mt-auto py-3">
        <div class="container-fluid">
            <span class="text-muted">&copy</span>
        </div>
    </footer>

    <script src="/js/jquery-3.6.0.min.js"></script>
    <script src="/js/bootstrap/bootstrap.bundle.min.js"></script>

  </body>
</html>


