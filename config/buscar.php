<?php 
    //incluir conexión a la base de datos 
    include "conexionBD.php"; 
    
    $texto = $_GET['texto']; 
    // aut_nombre='$texto' or cap_titulo= $cap_titulo
    $sql = "SELECT * FROM libro WHERE (lib_nombre='$texto' )"; 
    
    $result = $conn->query($sql); 

    echo " <table class='misdatos''> 
        <tr> 
            <th>Nombre</th>
            <th>ISBN</th>
            <th># Paginas</th>
        </tr>"; 
    if ($result->num_rows > 0) { 
        while($row = $result->fetch_assoc()) {
            $codigolib = $row["lib_codigo"];  
            echo "<tr>"; 
            echo " <td>" . $row["lib_nombre"] . "</td>";
            echo " <td>" . $row['lib_isbn'] ."</td>";
            echo " <td>" . $row['lib_npaginas'] . "</td>";
        } 
    } else { 
        echo "<tr>"; 
        echo " <td colspan='7'> No existen libros registradas en el sistema </td>"; 
        echo "</tr>"; 
    } 
    
    // echo "</table>"; 

    // $conn->close(); 

 
                            
    # Seccion de PHP donde se inserta los telefonos del usuario.
    $sqlcap = "SELECT * FROM capitulos WHERE lib_codigofk LIKE '$codigolib'";
    $capitulos = $conn->query($sqlcap);

    echo " <table class='misdatos''> 
        <tr> 
            <th>Numero</th>
            <th>Capitulo</th>
        </tr>"; 

    if ($capitulos->num_rows > 0) {
        while ($row = $capitulos->fetch_assoc()) {
            $codigoaut = $row["cap_codigo"];  
            echo "<tr>";
            echo " <td>" . $row['cap_numero'] ."</td>";
            echo " <td>" . $row['cap_titulo'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr>";
        echo " <td colspan='2'> No existen capitulos registrados en ese usuario </td>";
        echo "</tr>";
    }
    echo "</table>";

    $sqlaut = "SELECT * FROM autor WHERE cap_codigofk LIKE '$codigoaut'";
    $autor = $conn->query($sqlaut);

    echo " <table class='misdatos''> 
        <tr> 
            <th>Autor</th>
            <th>Nacionalidad Autor</th>
        </tr>"; 

    if ($autor->num_rows > 0) {
        while ($row = $autor->fetch_assoc()) {
            echo "<tr>";
            echo " <td>" . $row['aut_nombre'] ."</td>";
            echo " <td>" . $row['aut_nacionalidad'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr>";
        echo " <td colspan='2'> No existen autores registrados en ese usuario </td>";
        echo "</tr>";
    }
    echo "</table>";


    echo "</table>"; 

    $conn->close(); 
?>