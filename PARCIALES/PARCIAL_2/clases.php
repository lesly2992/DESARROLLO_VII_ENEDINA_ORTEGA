<?php
interface Detalle {
    public function obtenerDetallesEspecificos(): string;
 }
 // Clase abstracta Entrada
 abstract class Entrada implements Detalle {
    public $id;
    public $fecha_creacion;
    public $tipo;
    public function __construct($id, $fecha_creacion, $tipo) {
        $this->id = $id;
        $this->fecha_creacion = $fecha_creacion;
        $this->tipo = $tipo;
    }
    abstract public function obtenerDetallesEspecificos(): string;
 }


 // Clase EntradaUnaColumna
class EntradaUnaColumna extends Entrada {
    public $titulo;
    public $descripcion;
    public function __construct($id, $fecha_creacion, $titulo, $descripcion) {
        parent::__construct($id, $fecha_creacion, 1);
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
    }
    public function obtenerDetallesEspecificos(): string {
        return "Entrada de una columna: {$this->titulo}";
    }
 }

 // Clase EntradaDosColumnas
class EntradaDosColumnas extends Entrada {
    public $titulo1;
    public $descripcion1;
    public $titulo2;
    public $descripcion2;
    public function __construct($id, $fecha_creacion, $titulo1, $descripcion1, $titulo2, $descripcion2) {
        parent::__construct($id, $fecha_creacion, 2);
        $this->titulo1 = $titulo1;
        $this->descripcion1 = $descripcion1;
        $this->titulo2 = $titulo2;
        $this->descripcion2 = $descripcion2;
    }
    public function obtenerDetallesEspecificos(): string {
        return "Entrada de dos columnas: {$this->titulo1} | {$this->titulo2}";
    }
 }
 // Clase EntradaTresColumnas
 class EntradaTresColumnas extends Entrada {
    public $titulo1;
    public $descripcion1;
    public $titulo2;
    public $descripcion2;
    public $titulo3;
    public $descripcion3;
    public function __construct($id, $fecha_creacion, $titulo1, $descripcion1, $titulo2, $descripcion2, $titulo3, $descripcion3) {
        parent::__construct($id, $fecha_creacion, 3);
        $this->titulo1 = $titulo1;
        $this->descripcion1 = $descripcion1;
        $this->titulo2 = $titulo2;
        $this->descripcion2 = $descripcion2;
        $this->titulo3 = $titulo3;
        $this->descripcion3 = $descripcion3;
    }
    public function obtenerDetallesEspecificos(): string {
        return "Entrada de tres columnas: {$this->titulo1} | {$this->titulo2} | {$this->titulo3}";
    }
 }
class GestorBlog {
    private $entradas = [];
/*
    public function cargarEntradas() {
        if (file_exists('blog.json')) {
            $json = file_get_contents('blog.json');
            $data = json_decode($json, true);
            foreach ($data as $entradaData) {
                $this->entradas[] = new Entrada($entradaData);
            }
        }
    }

    public function guardarEntradas() {
        $data = array_map(function($entrada) {
            return get_object_vars($entrada);
        }, $this->entradas);
        file_put_contents('blog.json', json_encode($data, JSON_PRETTY_PRINT));
    }
*/
public function __construct() {
    if (file_exists('blog.json')) {
        $this->entradas = json_decode(file_get_contents('blog.json'), true);
    }
}
// Guardar entradas en el archivo JSON
public function guardarDatos() {
    file_put_contents('blog.json', json_encode($this->entradas));
}

    public function obtenerEntradas() {
        return $this->entradas;
    }

   public function agregarEntrada(Entrada $entrada) {
    $this->entradas[] = $entrada;
    $this->guardarDatos();
}
// Editar una entrada existente
public function editarEntrada(Entrada $entrada) {
    foreach ($this->entradas as &$ent) {
        if ($ent['id'] == $entrada->id) {
            $ent = $entrada;
            $this->guardarDatos();
            return;
        }
    }
}
// Eliminar una entrada por ID
public function eliminarEntrada($id) {
    foreach ($this->entradas as $key => $entrada) {
        if ($entrada['id'] == $id) {
            unset($this->entradas[$key]);
            $this->guardarDatos();
            return;
        }
    }
}
// Obtener una entrada por ID
public function obtenerEntrada($id) {
    foreach ($this->entradas as $entrada) {
        if ($entrada['id'] == $id) {
            return $entrada;
        }
    }
    return null;
}
// Mover una entrada (hacia arriba o hacia abajo)
public function moverEntrada($id, $direccion) {
    $index = array_search($id, array_column($this->entradas, 'id'));
    if ($index !== false) {
        $swapIndex = $direccion == 'up' ? $index - 1 : $index + 1;
        if (isset($this->entradas[$swapIndex])) {
            $temp = $this->entradas[$swapIndex];
            $this->entradas[$swapIndex] = $this->entradas[$index];
            $this->entradas[$index] = $temp;
            $this->guardarDatos();
        }
    }
}

    
}   