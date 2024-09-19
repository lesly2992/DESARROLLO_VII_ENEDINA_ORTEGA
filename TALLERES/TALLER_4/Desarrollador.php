<?php
require_once 'Empleado.php';
require_once 'Evaluable.php';


class Desarrollador extends Empleado implements Evaluable {
    private $lenguaje;
    private $nivel;

    public function __construct($Nombre, $ID_de_empleado, $Salario_base, $lenguaje, $nivel) {
        parent::__construct($Nombre, $ID_de_empleado, $Salario_base);
        $this->lenguaje = $lenguaje;
        $this->nivel = $nivel;
    }

    // Setters y getters
    public function setLenguaje($lenguaje) {
        $this->lenguaje = $lenguaje;
    }

    public function getLenguaje() {
        return $this->lenguaje;
    }

    public function setNivel($nivel) {
        $this->nivel = $nivel;
    }

    public function getNivel() {
        return $this->nivel;
    }

    public function evaluarDesempenio() {
        if ($this->nivel > 5) {
            return "El desarrollador está desempeñando bien su labor con un nivel de {$this->nivel}.";
        }
        return "El desarrollador necesita mejorar su desempeño.";
    }

    public function obtenerInformacion() {
        return parent::obtenerInformacion() . " y es desarrollador en {$this->getLenguaje()} con nivel {$this->getNivel()}";
    }
}
?>
