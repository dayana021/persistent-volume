<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-dark text-light">
    <header>
        <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Biblioteca</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="#">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Libros</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container my-5">
        <button id="nuevoLibroBtn" class="btn btn-primary mb-3">Ingresar nuevo libro</button>
        <form id="nuevoLibroForm" method="POST" action="guardar.php" class="d-none">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" class="form-control" id="autor" name="autor" required>
            </div>
            <div class="mb-3">
                <label for="anio" class="form-label">Año</label>
                <input type="number" class="form-control" id="anio" name="anio" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
        </form>

        <section id="listadoLibros">
            <h2>Listado de libros</h2>
            <?php

            if (file_exists('libros.txt')) {
                $libros = file('libros.txt', FILE_IGNORE_NEW_LINES);
                echo "<ul class='list-group'>";
                foreach ($libros as $libro) {
                    echo "<li class='list-group-item'>$libro</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No se han ingresado libros aún.</p>";
            }
            ?>
        </section>
    </main>

    <footer class="text-center py-3 bg-dark">
        <p>Shirley Dayana Morales Caracun [202460517]</p>
    </footer>

    <script>
        document.getElementById('nuevoLibroBtn').addEventListener('click', function() {
            document.getElementById('nuevoLibroForm').classList.toggle('d-none');
        });
    </script>
    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $anio = $_POST['anio'];

    $libro = "$titulo - $autor - $anio\n";

    file_put_contents('libros.txt', $libro, FILE_APPEND | LOCK_EX);

    header('Location: index.php');
    exit();
}
?>
</body>
</html>