<?php 
defined('ABSPATH') or die("Bye bye");
echo "<h1>". get_admin_page_title() . "</h1>";
?>
<!-- <!DOCTYPE html> -->
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link href="<?php echo root_file; ?>admin/css/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
</head>
<body>
    <div class="row">
        <p>Etiqueta prueba</p>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary rounded">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active" id="list_myQuestions">
                        <a class="nav-link itemAction" id="myQuestions" href="#">Mis Preguntas</a>
                    </li>
                    <li class="nav-item" id="list_createQuestion">
                        <a class="nav-link itemAction" id="createQuestion" href="#">Crear Preguntas</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" id="find" type="search" placeholder="Buscar" aria-label="Buscar">
                <!-- <button class="btn btn-light my-2 my-sm-0" type="button">Buscar</button> -->
                </form>
            </div>
        </nav>
    </div>
    <!-- <script src="<?php echo root_file; ?>admin/css/bootstrap/js/bootstrap.min.js"></script> -->
</body>
</html>

<?php 

?>