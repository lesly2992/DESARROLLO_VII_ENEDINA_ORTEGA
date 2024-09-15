<?php include("../assets/PHP/header.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
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
            <label for="email">Email: </label>
            <input type="text" id= "email" name= "email">
        </div>
        <div class="formGroup">
            <label for="password">Contraseña: </label>
            <input type="password" id= "password" name= "password">
        </div>
        <div class="formGroup">
            <label for="passwordConfirm">Confirma Contraseña : </label>
            <input type="password" id= "passwordConfirm" name= "passwordConfirm">
        </div>

        <div class="btn_container">
        <button type="submit" class="btn_login">Registrarse</button>
        </div>

        <div class="message">
            <p>Ya tienes tienes una cuenta? <a href="login.php"> Entrar</a></p>
        </div>

    </form>

</body>
</html>
