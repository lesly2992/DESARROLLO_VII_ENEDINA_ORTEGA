<?php
require_once "config_mysqli.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id'];
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $sql = "UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?";

    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "ssi", $nombre, $email, $id);

        if(mysqli_stmt_execute($stmt)){
            echo "Usuario actualizado con éxito.";
        } else {
            echo "ERROR: No se pudo ejecutar $sql. " . mysqli_error($conn);
        }
    }

    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>

<form method="post">
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <div><label>Nombre</label><input type="text" name="nombre" required></div>
    <div><label>Email</label><input type="email" name="email" required></div>
    <input type="submit" value="Actualizar Usuario">
</form>
