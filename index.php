<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación en Kubernetes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background: #333;
            color: white;
            padding: 15px;
        }
        nav {
            margin: 20px;
        }
        nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        .container {
            flex: 1;
            padding: 20px;
        }
        footer {
            background: #333;
            color: white;
            padding: 10px;
            text-align: center;
            width: 100%;
        }
    </style>
</head>
<body>
<header>
    <h1>Bienvenido a mi aplicación en Kubernetes</h1>
</header>
<nav>
    <a href="#">Inicio</a>
    <a href="#">Acerca</a>
    <a href="#">Contacto</a>
</nav>
<div class="container">
    <img src="assets/website_image.jpg" alt="Encabezado" width="80%">
    <h2>
        <?php
        $target = getenv('TARGET', true) ?: 'World';
        echo "Hola, " . htmlspecialchars($target) . "!";
        ?>
    </h2>
    <p>La fecha y hora actual es:
        <?php
        date_default_timezone_set("America/Mexico_City");
        echo date("d/m/Y H:i:s");
        ?>
    </p>
</div>
<footer>
    <p>&copy; <?php echo date("Y"); ?> Mi Aplicación. Todos los derechos reservados.</p>
</footer>
</body>
</html>
