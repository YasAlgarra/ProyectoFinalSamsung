<?php
if ($_POST) {
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $password_form = $_POST['password']; //OJO: si pones $password te entra en conflicto con la pass de BBDD

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'proyectofinal';

    try {
        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar conexión
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Consulta para verificar si el usuario ya existe mediante correo
        $checkQuery = "SELECT * FROM `usuario` WHERE `email` = '". $email ."'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows === 0) { //si el resultado no está en ninguna fila
            // El usuario NO existe -> insertarlo en la base de datos
            $insertQuery = "INSERT INTO `usuario` (`nombre`, `apellido1`, `apellido2`, `email`, `login`, `password`)
            VALUES ('$nombre', '$apellido1', '$apellido2', '$email', '$login', '$password_form')";
            $conn->query($insertQuery);
            $alert = "<script>alert('Registro completado con éxito. Botón CONSULTAR activado');</script>";
            $ok = true;
        } else {
            // El usuario YA existe -> mostrar alerta y volver al formulario
            $alert = "<script>alert('El usuario ya existe. Por favor, elija otro login.');</script>";
        }

        //Consultar usuarios
        $selectQuery = "SELECT `login`, `email` FROM `usuario`";
        $result = $conn->query($selectQuery);

        $usersData = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $usersData[] = $row;
        }

        $conn->close();


    } catch (mysqli_sql_exception $e) {
        // Capturar excepciones fatales
        echo "Error: " . $e->getMessage();
        
    }
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name ="viewpoint" content="width=device-width, initial-scale=1">
    <link rel ="stylesheet" href="style.css">

    <title> Formulario </title>
</head>
<body>
    
    <div class="container">
        
        <form method= "post" action ="index.php" class="formulario" id="formulario"> 
            <p class="titulo">¡Comienza tu viaje! </p>
            <div class="form_input" style="position: relative;">
                <label>Nombre:</label>
                <input type="text" name="nombre" id ="nombre" required/>
                <small style="color: red;" class="oculto" id="txt-err1">Campo obligatorio</small>
            </div>  
            <div class="form_input" style="position: relative;">
                <label for="apellido">Primer apellido:</label>
                <input type="text" name="apellido1" id="apellido1" required/>
                <small style="color: red;" class="oculto" id="txt-err2">Campo obligatorio</small>
                <br>
            </div>
            <div class="form_input" style="position: relative;">
                <label for="apellido">Segundo apellido:</label>
                <input type="text" name="apellido2" id="apellido2" required/>
                <small style="color: red;" class="oculto" id="txt-err3">Campo obligatorio</small>
                <br>
            </div>
            <div class="form_input" style="position: relative;">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email"required/>
                <small style="color: red;" class="oculto" id="txt-err4">Campo obligatorio</small>
                <br>
            </div>
            <div class = "form_input" style="position: relative;">
                <label for="login">Login (username):</label>
                <input type="text" id="login" name="login" id="login" required>
                <small style="color: red;" class="oculto" id="txt-err5">Campo obligatorio</small>
            </div>
            <div class = "form_input" style="position: relative;">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" minlength="4" maxlength="8" required>
                <small style="color: red;" class="oculto" id="txt-err6">Campo obligatorio</small>
            </div>
            <div class ="submit_button">
                <input type="submit" onclick="validar_formulario();" value="SUSCRIBIRSE"/>
                <br>
            <?php
                if(isset($ok)){
            ?>
                <div class = "consulta_button" id = "mostrarUsuarios">
                <input type="button" onclick="mostrarDatos();" value="CONSULTAR"/>
                <br>
                </div> 
            <?php       
                }
            ?>    
            </div>
            <div id= "myDiv" style = "display:none;">
                <?php
                    if(isset($usersData)){
                        for ($i = 0; $i< count($usersData); $i++){
                            echo "<p style = 'color:white;'>" . $usersData[$i]['login'] . "-" . $usersData[$i]['email'] . "</p>";
                        }
                    }
                ?>  
            </div>
            <script src="index.js"></script>
        </form>
        <div id="resultados"></div>
        </div>
        <?php
            if(isset($alert) && $alert != ''){
                echo $alert;
            }
        ?>
</body>
</html>
