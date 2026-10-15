<?php
// Listas de opciones para los select (se recorren con foreach)
$carreras = [
    "Ingeniería en Sistemas Computacionales",
    "Ingeniería de Software",
    "Ingeniería Industrial",
    "Ingeniería Civil"
];
$asignaturas = [
    "Desarrollo Web",
    "Base de Datos",
    "Programación",
    "Redes"
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Estudiantes</title>
    <link rel="stylesheet" href="CSS/estilos.css">
</head>
<body>

<header>
    <h1>Registro de Estudiantes</h1>
    <nav>
        <a href="index.php">Inicio</a>
        <a href="registro_estudiantes.php">Registro</a>
    </nav>
</header>

<main>
    <section>
        <h2>Formulario de registro</h2>

        <form action="procesar_estudiantes.php" method="POST">

            <div class="form-grupo">
                <label for="nombre">Nombre completo</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="form-grupo">
                <label for="cedula">Cédula</label>
                <input type="text" id="cedula" name="cedula" placeholder="8-123-456" required>
            </div>

            <div class="form-grupo">
                <label for="edad">Edad</label>
                <input type="number" id="edad" name="edad" min="15" required>
            </div>

            <div class="form-grupo">
                <label for="carrera">Carrera</label>
                <select id="carrera" name="carrera" required>
                    <option value="">-- Selecciona una carrera --</option>
                    <?php foreach ($carreras as $carrera): ?>
                        <option value="<?php echo $carrera; ?>"><?php echo $carrera; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-grupo">
                <label for="asignatura">Asignatura</label>
                <select id="asignatura" name="asignatura" required>
                    <option value="">-- Selecciona una asignatura --</option>
                    <?php foreach ($asignaturas as $asignatura): ?>
                        <option value="<?php echo $asignatura; ?>"><?php echo $asignatura; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-grupo">
                <label for="nota1">Nota 1</label>
                <input type="number" id="nota1" name="nota1" min="0" max="100" step="0.01" required>
            </div>

            <div class="form-grupo">
                <label for="nota2">Nota 2</label>
                <input type="number" id="nota2" name="nota2" min="0" max="100" step="0.01" required>
            </div>

            <div class="form-grupo">
                <label for="nota3">Nota 3</label>
                <input type="number" id="nota3" name="nota3" min="0" max="100" step="0.01" required>
            </div>

            <button type="submit" class="btn">Registrar</button>
            <button type="reset" class="btn btn-secundario">Limpiar</button>

        </form>
    </section>
</main>

<footer>
    <p>Desarrollado Por: [TU NOMBRE] y [NOMBRE DE TU COMPAÑERO] – Grupo 1S3221</p>
</footer>

</body>
</html>