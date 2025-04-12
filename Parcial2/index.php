<?php
class librosPubli {
    public $titulo;
    public $autor;
    public $anio;

    public function __construct($titulo, $autor, $anio) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->anio = $anio;
    }

    public function guardar() {
        $linea = "$this->titulo|$this->autor|$this->anio\n";
        file_put_contents('libros.txt', $linea, FILE_APPEND);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $publibro = new librosPubli(
        $_POST['titulo'],
        $_POST['autor'],
        $_POST['anio'] ?? ''
    );
    $publibro->guardar();
}

function mostrarLibros() {
    if (!file_exists('libros.txt')) return;
    $lineas = file('libros.txt');
    foreach ($lineas as $linea) {
        list($titulo, $autor, $anio) = explode('|', trim($linea));
        echo "<div class='card mb-2 p-2'><strong>$titulo</strong><br>Titulo: $autor<br>Autro: $anio<br>Año</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Biblioteca</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&family=Sawarabi+Mincho&display=swap" rel="stylesheet">
</head>
<body style="background-color:rgb(183, 210, 249);">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark mi-fondo">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                BIBLIOTECA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Ingresar nuevo libro</a>
                    </li>
                </ul>
            </div>
    </nav>

    <main class="container mt-5 pt-5">
        <h2 class="text-center">Libros:</h2>
        <form method="POST" class="mb-5">
            <div class="mb-3">
                <label class="form-label">Nombre del libro</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Autor</label>
                <input type="text" name="autor" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">año</label>
                <input type="text" name="anio" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>

        <h2>Libros publicados</h2>
        <?php mostrarLibros(); ?>
    </main>

    <footer class="footer text-center mt-5">
        <p>&copy; Adaliz Rocio Santisteban López    202460513</p>
    </footer>
</body>
</html>