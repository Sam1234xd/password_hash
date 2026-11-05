<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
    session_start();
    ?>

    <h1>Registro de usuarios</h1>

    <form method="POST" action="">

        Nombre:<br>
        <input type="text" name="nombre"><br><br>

        Nombre de usuario:<br>
        <input type="text" name="usuario"><br><br>

        Contraseña:<br>
        <input type="password" name="password"><br><br>

        Confirmar contraseña:<br>
        <input type="password" name="confirmar"><br><br>

        <input type="submit" name="registrar" value="Registrar">

    </form>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrar'])) {

        // Recibir los datos
        $nom = $_POST['nombre'];
        $user = $_POST['usuario'];
        $con = $_POST['password'];
        $conf = $_POST['confirmar'];

        // Validar campos
        if (empty($nom) or empty($user) or empty($con) or empty($conf)) {

            echo "Todos los campos son obligatorios.";

        }
        else if (strlen($con) < 6) {

            echo "La contraseña debe tener minimo 6 caracteres.";

        }
        else if ($con != $conf) {

            echo "Las contraseñas no coinciden.";

        }
        else {

            // Crear arreglo de usuarios
            if (!isset($_SESSION['usuarios'])) {
                $_SESSION['usuarios'] = array();
            }

            // Guardar usuario
            $_SESSION['usuarios'][] = array(
                "Nombre" => $nom,
                "Usuario" => $user,
                "Contraseña" => password_hash($con, PASSWORD_DEFAULT)
            );

            echo "Usuario registrado correctamente.";

        }
    }

    ?>

</body>
</html>