<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>
        <?php
            calcular_descuento(1000);
        ?>
    </p>
</body>
</html>







<?php 
  function  calcular_descuento($total_compra){
      if($total_compra < 100){
        return $total_compra;
      }elseif($total_compra > 100 || $total_compra < 500){
        return $total_compra - ($total_compra * 0.05);
      }elseif($total_compra > 501 || $total_compra < 1000){
        return $total_compra - ($total_compra * 0.10);
      }elseif($total_compra > 1000){
        return $total_compra - ($total_compra * 0.10);
      }
  }

  function aplicar_impuesto($subtotal){
    $subITBMS = $subtotal + ($subtotal * 0.07); 
    return $subITBMS;
  }

  function calcular_total($subtotal, $descuento, $impuesto){
    $total = $subtotal - $descuento + $impuesto;
    return $total;
  }