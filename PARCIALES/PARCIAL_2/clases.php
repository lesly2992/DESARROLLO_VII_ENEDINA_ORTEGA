<?php
// Interface
interface Prestable {
    public function obtenerDetallesPrestamo(): string;
}

// Clase abstracta que implementa la interfaz
abstract class RecursoBiblioteca implements Prestable {
    public $id;
    public $titulo;
    public $autor;
    public $anioPublicacion;
    public $estado;
    public $fechaAdquisicion;
    public $tipo;

    public function __construct($datos) {
        foreach ($datos as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}

// Clases que heredan de RecursoBiblioteca
class Libro extends RecursoBiblioteca {
    public $isbn;

    public function __construct($datos) {
        parent::__construct($datos);
        $this->isbn = $datos['isbn'] ?? '';
    }

    public function obtenerDetallesPrestamo(): string {
        return "Libro: {$this->titulo}, ISBN: {$this->isbn}";
    }
}

class Revista extends RecursoBiblioteca {
    public $numeroEdicion;

    public function __construct($datos) {
        parent::__construct($datos);
        $this->numeroEdicion = $datos['numeroEdicion'] ?? 0;
    }

    public function obtenerDetallesPrestamo(): string {
        return "Revista: {$this->titulo}, Número de Edición: {$this->numeroEdicion}";
    }
}

class DVD extends RecursoBiblioteca {
    public $duracion;

    public function __construct($datos) {
        parent::__construct($datos);
        $this->duracion = $datos['duracion'] ?? 0;
    }

    public function obtenerDetallesPrestamo(): string {
        return "DVD: {$this->titulo}, Duración: {$this->duracion} minutos";
    }
}

// Clase para gestionar la biblioteca
class GestorBiblioteca {
    private $recursos = [];

    public function cargarRecursos() {
        $json = file_get_contents('biblioteca.json');
        $data = json_decode($json, true);
        
        foreach ($data as $recursoData) {
            switch ($recursoData['tipo']) {
                case 'Libro':
                    $recurso = new Libro($recursoData);
                    break;
                case 'Revista':
                    $recurso = new Revista($recursoData);
                    break;
                case 'DVD':
                    $recurso = new DVD($recursoData);
                    break;
                default:
                    $recurso = new RecursoBiblioteca($recursoData);
                    break;
            }
            $this->recursos[] = $recurso;
        }
        
        return $this->recursos;
    }

    public function agregarRecurso(RecursoBiblioteca $recurso) {
        $this->recursos[] = $recurso;
        $this->guardarRecursos();
    }

    public function eliminarRecurso($id) {
        $this->recursos = array_filter($this->recursos, function($recurso) use ($id) {
            return $recurso->id !== $id;
        });
        $this->guardarRecursos();
    }

    public function actualizarRecurso(RecursoBiblioteca $recurso) {
        foreach ($this->recursos as &$item) {
            if ($item->id === $recurso->id) {
                $item = $recurso;
                break;
            }
        }
        $this->guardarRecursos();
    }

    public function actualizarEstadoRecurso($id, $nuevoEstado) {
        foreach ($this->recursos as &$recurso) {
            if ($recurso->id === $id) {
                $recurso->estado = $nuevoEstado;
                break;
            }
        }
        $this->guardarRecursos();
    }

    public function buscarRecursosPorEstado($estado) {
        return array_filter($this->recursos, function($recurso) use ($estado) {
            return $recurso->estado === $estado;
        });
    }

    public function listarRecursos($filtroEstado = '', $campoOrden = 'id', $direccionOrden = 'ASC') {
        // Filtrar recursos si es necesario
        $recursos = $this->recursos;
        if ($filtroEstado) {
            $recursos = $this->buscarRecursosPorEstado($filtroEstado);
        }

        // Ordenar recursos
        usort($recursos, function($a, $b) use ($campoOrden, $direccionOrden) {
            if ($a->$campoOrden === $b->$campoOrden) {
                return 0;
            }
            $result = $a->$campoOrden < $b->$campoOrden ? -1 : 1;
            return $direccionOrden === 'ASC' ? $result : -$result;
        });

        return $recursos;
    }

    private function guardarRecursos() {
        $json = json_encode(array_map(function($recurso) {
            return (array) $recurso;
        }, $this->recursos));
        
        file_put_contents('biblioteca.json', $json);
    }
}

// Mapeo de estados a versiones legibles
$estadosLegibles = [
    'disponible' => 'DISPONIBLE',
    'prestado' => 'PRESTADO',
    'en_reparacion' => 'EN REPARACIÓN'
];
?>
