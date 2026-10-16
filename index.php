<?php
// Variable con el nombre del sistema (se reutiliza en varios lugares)
$titulo_sistema = "Portal de Registro y Consulta de Estudiantes";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_sistema; ?></title>
    <link rel="stylesheet" href="CSS/estilos.css">
</head>
<body>

<header>
    <h1><?php echo $titulo_sistema; ?></h1>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="registro_estudiantes.php">Registro</a>
        <a href="procesar_estudiantes.php">Consultar</a>
    </nav>
</header>

<main>
    <section>
        <h2>Bienvenido</h2>
        <p>
            Este sistema permite registrar estudiantes con sus notas,
            calcular su promedio y consultar si un estudiante ya fue registrado.
        </p>
        <a href="registro_estudiantes.php" class="btn">Ir al formulario de registro</a>
    </section>
</main>

<footer>
    <p>Desarrollado Por: OMAR HERRERA y PAUL ZERPA – Grupo 1S3221</p>
</footer>

</body>
</html>