<?php
require_once "config_pdo.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id'];

    $sql = "DELETE FROM usuarios WHERE id = :id";

    if($stmt = $pdo->prepare($sql)){
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if($stmt->execute()){
            echo "Usuario eliminado con éxito.";
        } else {
            echo "ERROR: No se pudo ejecutar $sql. " . $stmt->errorInfo()[2];
        }
    }

    unset($stmt);
}
unset($pdo);
?>

<form method="post">
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <input type="submit" value="Eliminar Usuario">
</form>
