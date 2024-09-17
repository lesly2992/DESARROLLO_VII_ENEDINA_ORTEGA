<?php include 'utilidades_texto.php'; 
$frases= ["Estoy aprendiendo PHP", "Estoy aprendiendo JavaScript", "Estoy en la universidad"];
?>
    <h1>Tabla con frases</h1>
    <table>
        <tr>
            <th>Fila1</th>
            <th>Fila2</th>
            <th>Fila3</th>
        <?php foreach($frases as $contenido => $frase):?>
                <tr>
                    <td> <?= $frase  ?></td>
                        <td><?= contar_palabras($frases) ?></td>
                        <td><?= contar_vocales($frases) ?></td>
                        <td><?= invertir_palabras($frases) ?></td>
                </tr>
            <?php endforeach; ?>
        ?>
        </tr>
        
    </table>
</body>
</html>

?>
