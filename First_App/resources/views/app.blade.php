<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
      input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
             -webkit-appearance: none;
              margin: 0;
      }

      input[type=number] {
          -moz-appearance: textfield;
      }
  </style>
</head>
<body class="h-100">
   
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse container-fluid" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                @auth
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger">Log Out</button>
                    </form>
                @else
                    <form action="/login" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-success">Log In</button>
                    </form>
                    
                @endauth
              </li>
              <li class="nav-item" style="padding-left: 1rem">
                @guest
                    <form action="/register" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary">Register</button>
                    </form>
                @endguest
              </li>
            </ul>
            @auth
              @if (auth()->user()->is_admin != 2)
              <form action="/cart" style="padding-right: 5px" method="GET">
                @csrf
                <button  class="btn btn-warning">Cart</button>
              </form>
              <form class="d-flex" action="/user" role="search" method="POST">
                @csrf
                <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
              
              @else
              <form class="d-flex" action="/admin" role="search" method="POST">
                @csrf
                <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
              @endif
            @endauth
          </div>
        </div>
    </nav>
    <div class="container">
      @yield('alert')
    </div>
    <main>
        @yield('content')
    </main>
     
    <div class="" style="">
        @yield('register')
    </div>
   
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>