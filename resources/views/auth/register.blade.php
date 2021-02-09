<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                <div class="col-md-5">
                    <img src="assets/images/login.jpg" alt="login" class="login-card-img">
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                    <div class="brand-wrapper">
                        <img src="assets/images/money.svg" alt="logo" class="logo">
                    </div>
                    <p class="login-card-description">Registrarse</p>
                    <form method="POST" action="{{ route('register')}}">
                    @csrf
                        <div class="form-group">
                            <input id="name" placeholder="Nombre" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-4">
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <input placeholder="Confirmar Contraseña" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Registrarse">
                        </form>
                        <p class="login-card-footer-text">Ya tienes una Cuenta? <a href="{{route('login')}}" class="text-reset">Logueate Aquí</a></p>
                        <nav class="login-card-footer-nav">
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>