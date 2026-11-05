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

    <h1>Inicio de sesión</h1>

    <form method="POST" action="">

        Nombre de usuario:<br>
        <input type="text" name="usuario"><br><br>

        Contraseña:<br>
        <input type="password" name="password"><br><br>

        <input type="submit" name="ingresar" value="Iniciar sesión">

    </form>

    <?php

   if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ingresar'])) {

    // Recibir los datos
    $user = $_POST['usuario'];
    $con = $_POST['password'];

    $encontrado = false;
    $mensaje = "Usuario no encontrado.";

    // Buscar usuario registrado
    if (isset($_SESSION['usuarios'])) {

        foreach ($_SESSION['usuarios'] as $u) {

            if (isset($u['Usuario']) && $u['Usuario'] == $user) {

                // Verificar contraseña
                if (password_verify($con, $u['Contraseña'])) {

                    $mensaje = "Bienvenido al sistema " . $u['Nombre'];

                }
                else {

                    $mensaje = "Contraseña incorrecta.";

                }

                $encontrado = true;
                break;
            }
        }
    }

    echo $mensaje;
}

    ?>
</body>
</html>