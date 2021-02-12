<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Jekyll v4.1.1">
        <title>Financiera</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/cover/">

        <!-- Bootstrap core CSS -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="{{ asset('css/cover.css') }}" rel="stylesheet">
    </head>
    
    <body class="text-center">
        <div class="container-fluid d-flex h-100 p-3 mx-auto flex-column">
            <header class="masthead mb-auto">
                <div class="inner">
                    <h3 class="masthead-brand">Financiera</h3>
                    <nav class="nav nav-masthead justify-content-center">
                        <a class="nav-link active" href="{{url('home')}}">Home</a>
                        @if(auth()->guest())
                            <a class="nav-link" href="{{route('login')}}">Iniciar sesión</a>
                            <a class="nav-link" href="{{route('register')}}">Registrarse</a>
                        @endif
                    </nav>
                </div>
            </header>

            <main role="main" class="inner cover">
                    <h1 class="cover-heading">Financiera S.A De C.V.</h1>
                    <p class="lead">
                        Software que permite realizar operaciones para conceder pŕestamos y tener un control de
                        los pagos realizados, otorgando la funcionalidad de descargar los pagos establecidos en
                        archivo de Excel.
                    </p>
                    <p class="lead">
                    <a href="#" class="btn btn-lg btn-secondary">Learn more</a>
                    </p>
            </main>
        
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                </ol>
            
                <div class="carousel-inner mb-5">
                    
                    <div class="text-center carousel-item active">
                        <img class="d-block w-50 mx-auto" src="assets/images/slides/home.png" alt="First slide">
                    </div>

                    <div class="carousel-item">
                        <img class="d-block w-50 mx-auto" src="assets/images/slides/clientes.png" alt="Second slide">
                    </div>

                    <div class="carousel-item">
                        <img class="d-block w-50 mx-auto" src="assets/images/slides/editar_cliente.png" alt="Third slide">
                    </div>

                    <div class="carousel-item">
                        <img class="d-block w-50 mx-auto" src="assets/images/slides/prestamos.png" alt="Fourth slide">
                    </div>

                    <div class="carousel-item">
                        <img class="d-block w-50 mx-auto" src="assets/images/slides/abonos.png" alt="Sixth slide">
                    </div>

                    <div class="carousel-item">
                        <img class="d-block w-50 mx-auto" src="assets/images/slides/pagos.png" alt="Fifth slide">
                    </div>
                </div>
            
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>

                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            
            <div style="width:85%;" class="mb-5 mx-auto d-flex justify-content-center">
                <div class="col-md-4">
                    <h2 class="featurette-heading">Importar Usuarios. <span class="text-muted">Archivos .xlsx</span></h2>
                    <p class="lead">
                        Permite cargar a la base de datos los clientes que han sido agregados
                        a un archivo de hoja de cálculos. (.xlsx)
                    </p>
                </div>
                <div class="col-md-4">
                    <h2 class="featurette-heading">Nuevos Clientes. <span class="text-muted">Agregar nuevos clientes.</span></h2>
                    <p class="lead">
                        Permite el registro de nuevos clientes a la base de datos.
                    </p>
                </div>
                <div class="col-md-4">
                    <h2 class="featurette-heading">Nuevos Préstamos. <span class="text-muted">Agregar nuevos préstamos.</span></h2>
                    <p class="lead">
                        Permite añadir nuevos préstamos a los clientes registrados
                    </p>
                </div>
            </div>

            <div style="width:85%;" class="py-sm-5 mx-auto d-flex justify-content-center">
                <div class="col-md-4">
                    <h2 class="featurette-heading">Abono de Préstamos.
                </div>
                <div class="col-md-4">
                    <h2 class="featurette-heading">Eliminar Préstamos.
                    <p class="lead">
                        Permite eliminar un préstamo solicitado
                    </p>
                </div>
                <div class="col-md-4">
                    <h2 class="featurette-heading">Exportar Abonos.
                    <p class="lead">
                        Permite descargar los abonos realizados de todos los préstamos realizados
                        a un archivo de hoja de cálculos (.xlsx)
                    </p>
                </div>
            </div>

            <footer class="mastfoot mt-auto">
                <div class="inner">
                <p>Developed by <a href="https://github.com/drkdsk">José Alfredo Palacios (@drkdsk)</a>.</p>
                </div>
            </footer>
        </div>
    </body>
</html>

<script src="{{asset('js/app.js') }}"></script>