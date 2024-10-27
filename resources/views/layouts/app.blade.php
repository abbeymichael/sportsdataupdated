<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scout Smart, Play Strong</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/front.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts/dist/apexcharts.css">

  
</head>
<body>

  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" />
        </a>
        @livewire('player-search') <!-- Add the Livewire component here -->
        <div class="ms-auto">
            <button class="btn text-info">PREDICTION</button>
            <button class="btn text-warning">SCOUTING</button>
        </div>
    </div>
</nav>

  @yield('content')

  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}" referrerpolicy="origin"></script>
 
</body>
</html>