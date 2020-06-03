<?php
    //incluir conexión a la base de datos
    include '../../config/conexionBD.php';

    $nombre = isset($_POST["nombre"]) ? mb_strtoupper(trim($_POST["nombre"]), 'UTF-8') : null;
    $isbn = isset($_POST["isbn"]) ? mb_strtoupper(trim($_POST["isbn"]), 'UTF-8') : null;
    $paginas = isset($_POST["npaginas"]) ? mb_strtoupper(trim($_POST["npaginas"]), 'UTF-8') : null;
    $ncapitulo = isset($_POST["ncapitulo"]) ? mb_strtoupper(trim($_POST["ncapitulo"]), 'UTF-8') : null;
    $nombrecap = isset($_POST["nombrecap"]) ? mb_strtoupper(trim($_POST["nombrecap"]), 'UTF-8') : null;

    $sql = "INSERT INTO libro VALUES (0, '$nombre', '$isbn', '$paginas')";
    

    if ($conn->query($sql) === TRUE) { 
        echo "<p>Se ha creado el libro correctamemte!!!</p>";
    } else {
        if($conn->errno == 1062){
            echo "<p class='error'>La persona con la cedula $nombre ya esta registrada en el sistema </p>";
        }else{
            echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";
        }
    }

    // $sqllib = "SELECT * FROM libro WHERE (lib_nombre='$texto' )";
    // if ($result->num_rows > 0) { 
    //     while($row = $result->fetch_assoc()) {

    //     }
    // }
    //cerrar la base de datos
    $conn->close();
    echo "<a href='../vista/index.html'>Regresar</a>";
?>