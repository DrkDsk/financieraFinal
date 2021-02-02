<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financiera</title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@300&family=Poppins:wght@500&display=swap" rel="stylesheet"> 
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="nav">
        <nav class="navbar navbar-dark navbar-expand-lg bg-dark flex-md-nowrap shadow">
        
        <a style="margin-left:2em;" class="navbar-brand" href="{{url('/home')}}">Inicio</a>
        
        <div class="collapse navbar-collapse" id="navbarToggleExternalContent">
            <div>
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('clients')}}">Clientes <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('loans')}}">Préstamos</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{url('payments')}}">Pagos</a>
                </li>
                </ul>
            </div>
            
        </div>
        
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('bottom-js')
</body>
</html>