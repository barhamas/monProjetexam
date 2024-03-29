<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Document</title>
    <style>
        /* Position and styling for the navbar */
        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        /* Styling for the navigation links */
        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        /* Styling for the close button */
        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }
    </style>
</head>
<body>

<!-- The actual navbar -->
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    <a href="{{ route('dashboard') }}">Dashboard</a>
    <a href="{{route('personnel.index')}}">Personnel</a>
    <a href="{{route('pointage.index')}}">Pointage</a>
    <a href="{{route('paiement.index')}}">Paiment</a>
</div>

<!-- The hamburger icon -->
<span style="font-size:30px;cursor:pointer" onclick="openNav()">☰</span>

<script>
    /* Set the width of the side navigation to 250px */
    function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
    }

    /* Set the width of the side navigation to 0 */
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>

@yield('content')

</body>
</html>

