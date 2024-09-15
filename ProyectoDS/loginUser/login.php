<?php include("../assets/PHP/header.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/assets/CSS/style.css"/>
</head>
<body>
    <form action="" method="post" class="formLogin">

        <div class="title">
            <h2>Login</h2>
        </div>
        <div class="formGroup">
            <label for="username">Nombre de Usuario: </label>
            <input type="text" id= "username" name= "username">
        </div>
        
        <div class="formGroup">
            <label for="password">Contraseña: </label>
            <input type="password" id= "password" name= "password">
        </div>

        <div class="btn_container">
        <button type="submit" class="btn_login">Registrarse</button>
        </div>

        <div class="message">
            <p>Aún no estas registrado? <a href="register.php">Registrate</a></p>
        </div>

    </form>

</body>
</html>
