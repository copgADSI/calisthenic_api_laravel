<html>

<head>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
</head>

<body>

    <link rel="stylesheet" href=" {{ asset('css/sidebar.css') }} ">
    <link rel="stylesheet" href=" {{ asset('css/app.css') }} ">
    <input type="checkbox" id="check">
    <label for="check">
        <i class="fa fa-bars" id="btn"></i>
        <i class="fa fa-times" id="cancel"></i>
    </label>
    <div class="sidebar">
        <header>Calisthenic Center</header>
        <ul>
            <li><a href="{{ route('home') }} " style="text-decoration: none">
                    <i class="fa fa-home"></i>
                    Inicio
                </a>
            </li>
            <li><a href="{{ route('excercises.list') }} " style="text-decoration: none">
                    <i class="fas fa-dumbbell"></i>

                    Listar Ejecicios
                </a>
            </li>
            <li><a href="{{ route('excercises.list') }} " style="text-decoration: none">
                    <i class="fa fa-heart"></i>
                    Rutinas Creadas
                </a>
            </li>

            @if(Auth::User()->role_id === 1)
            <li>
                <a href="{{ route('users.index') }} " style="text-decoration: none">
                    <i class="fa fa-users"></i>
                    Listar Usuarios
                </a>
            </li>
            <li>
                <a href="{{ route('charts.index') }} " style="text-decoration: none">
                    <i class="fa-solid fa-chart-line"></i>
                    Estadísticas
                </a>
            </li>
            @endif
            <li>
                <a href="{{ route('excercises.list') }} " style="text-decoration: none">
                    <i class="fa-solid fa-gear"></i>
                    Configuraciones
                </a>
            </li>
            <li>
                <a href="{{ route('excercises.list') }} " style="text-decoration: none">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Cerrar Sesión
                </a>
            </li>
            
        </ul>
        <ul>
            <li style="justify-content: center;margin-left:2px">
                <span style="color: #fff" >{{ Auth::User()->email }}</span>
            </li>
        </ul>
    </div>

</body>

<script>
    const url = location.href; // blog.alejandrmolero.com
    console.log(url);
</script>

</html>