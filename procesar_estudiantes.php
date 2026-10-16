<?php
date_default_timezone_set('America/Panama');

// Constante: nota mínima para aprobar (requisito 5)
define('NOTA_APROBACION', 70);

// Lista simulada de estudiantes ya registrados (para la consulta por GET)
$registrados = ["Juan", "María", "Carlos", "Ana"];

// Función 1: promedio de las tres notas (requisito 2)
function calcularPromedio($n1, $n2, $n3) {
    return ($n1 + $n2 + $n3) / 3;
}

// Función 2: convierte el promedio a letra (requisito 6)
function convertirALetra($promedio) {
    if ($promedio >= 91) {
        return "A";
    } elseif ($promedio >= 81) {
        return "B";
    } elseif ($promedio >= 71) {
        return "C";
    } elseif ($promedio >= 61) {
        return "D";
    } else {
        return "F";
    }
}

$modo = "inicio";
$errores = [];

if (isset($_GET['nombre'])) {
    // Consulta por GET (requisito 8): procesar_estudiantes.php?nombre=Juan
    $modo = "consulta";
    $buscado = trim($_GET['nombre']);
    $encontrado = false;
    foreach ($registrados as $nombre_registrado) {
        if (strcasecmp($nombre_registrado, $buscado) === 0) {
            $encontrado = true;
        }
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Datos del formulario por POST (requisito 1)
    $modo = "resultado";
    $nombre     = trim($_POST['nombre'] ?? '');
    $cedula     = trim($_POST['cedula'] ?? '');
    $edad       = $_POST['edad'] ?? '';
    $carrera    = trim($_POST['carrera'] ?? '');
    $asignatura = trim($_POST['asignatura'] ?? '');
    $nota1      = $_POST['nota1'] ?? '';
    $nota2      = $_POST['nota2'] ?? '';
    $nota3      = $_POST['nota3'] ?? '';

    // Validaciones del lado del servidor
    if ($nombre === '' || $cedula === '' || $edad === '' || $carrera === '' ||
        $asignatura === '' || $nota1 === '' || $nota2 === '' || $nota3 === '') {
        $errores[] = "Ningún campo puede quedar vacío.";
    } elseif (!is_numeric($edad) || !is_numeric($nota1) || !is_numeric($nota2) || !is_numeric($nota3)) {
        $errores[] = "La edad y las notas deben ser numéricas.";
    } else {
        if ($edad < 15) {
            $errores[] = "La edad debe ser mayor o igual a 15 años.";
        }
        foreach ([$nota1, $nota2, $nota3] as $posicion => $nota) {
            if ($nota < 0 || $nota > 100) {
                $errores[] = "La nota " . ($posicion + 1) . " debe estar entre 0 y 100.";
            }
        }
    }

    // Si todo está bien: promedio, letra y estado (requisito 3)
    if (empty($errores)) {
        $promedio = calcularPromedio($nota1, $nota2, $nota3);
        $letra = convertirALetra($promedio);
        if ($promedio >= NOTA_APROBACION) {
            $estado = "Aprobado";
            $clase = "aprobado";
        } else {
            $estado = "Reprobado";
            $clase = "reprobado";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado - Registro de Estudiantes</title>
    <link rel="stylesheet" href="CSS/estilos.css">
</head>
<body>

<header>
    <h1>Resultado del Registro</h1>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="registro_estudiantes.php">Registro</a>
        <a href="procesar_estudiantes.php">Consultar</a>
    </nav>
</header>

<main>

<?php if ($modo === "resultado" && empty($errores)): ?>
    <section>
        <h2>Datos del estudiante</h2>
        <table>
            <tr><th>Nombre</th><td><?php echo htmlspecialchars($nombre); ?></td></tr>
            <tr><th>Cédula</th><td><?php echo htmlspecialchars($cedula); ?></td></tr>
            <tr><th>Edad</th><td><?php echo htmlspecialchars($edad); ?></td></tr>
            <tr><th>Carrera</th><td><?php echo htmlspecialchars($carrera); ?></td></tr>
            <tr><th>Asignatura</th><td><?php echo htmlspecialchars($asignatura); ?></td></tr>
            <tr><th>Nota 1</th><td><?php echo htmlspecialchars($nota1); ?></td></tr>
            <tr><th>Nota 2</th><td><?php echo htmlspecialchars($nota2); ?></td></tr>
            <tr><th>Nota 3</th><td><?php echo htmlspecialchars($nota3); ?></td></tr>
            <tr><th>Promedio</th><td><?php echo number_format($promedio, 2); ?></td></tr>
            <tr><th>Letra</th><td><?php echo $letra; ?></td></tr>
            <tr><th>Resultado</th><td><span class="<?php echo $clase; ?>"><?php echo $estado; ?></span></td></tr>
            <tr><th>Fecha del registro</th><td><?php echo date("d/m/Y h:i:s A"); ?></td></tr>
        </table>
        <a href="registro_estudiantes.php" class="btn">Registrar otro estudiante</a>
    </section>

<?php elseif ($modo === "resultado"): ?>
    <section>
        <h2>Corrige los siguientes datos</h2>
        <div class="alerta">
            <ul>
                <?php foreach ($errores as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <a href="registro_estudiantes.php" class="btn">Volver al formulario</a>
    </section>

<?php elseif ($modo === "consulta"): ?>
    <section>
        <h2>Resultado de la consulta</h2>
        <?php if ($encontrado): ?>
            <p>El estudiante <strong><?php echo htmlspecialchars($buscado); ?></strong> ya fue registrado.</p>
        <?php else: ?>
            <p>El estudiante <strong><?php echo htmlspecialchars($buscado); ?></strong> no ha sido registrado.</p>
            <a href="registro_estudiantes.php" class="btn">Registrarlo ahora</a>
        <?php endif; ?>
    </section>

<?php else: ?>
    <section>
        <h2>Sin datos para mostrar</h2>
        <p>Aún no se ha enviado ningún registro. Completa el formulario o consulta un estudiante.</p>
        <a href="registro_estudiantes.php" class="btn">Ir al registro</a>
    </section>
<?php endif; ?>

    <section>
        <h2>Consultar un estudiante</h2>
        <form action="procesar_estudiantes.php" method="GET">
            <div class="form-grupo">
                <label for="buscar">Nombre del estudiante</label>
                <input type="text" id="buscar" name="nombre" placeholder="Ej: Juan" required>
            </div>
            <button type="submit" class="btn">Consultar</button>
        </form>
    </section>

</main>

<footer>
    <p>Desarrollado Por: [TU NOMBRE] y [NOMBRE DE TU COMPAÑERO] – Grupo 1S3221</p>
</footer>

</body>
</html>