<?php

interface Metodos{
    function get($prop);
    function set($prop, $value);

}
    class ConjuntoBase {
        protected $elementos = [];

        function __construct($elementos){
            $this->set('elementos', explode(",", $elementos));
        }

        function get ($prop) {
            return $this-> {$prop};

        }
        function set($prop, $value) {
            $this-> {$prop} = $value;
        }

        function toString() {
            return "[" . implode(", ", $this-> get('elementos')) . "]";
        }
  
    }
    class Conjunto extends ConjuntoBase implements Metodos {

        function union(Conjunto $conjuntoDos) {
            return new Conjunto(implode(",", array_unique(array_merge($this->get('elementos'), $conjuntoDos-> get('elementos')))));
        }

        function interseccion(Conjunto $conjuntoDos) {
            return new Conjunto(implode(",", array_intersect($this->get('elementos'), $conjuntoDos->get('elementos'))));
        }

        function diferencia(Conjunto $conjuntoDos) {
            return new Conjunto(implode(",", array_diff($this->get('elementos'), $conjuntoDos->get('elementos'))));
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conjuntoA = new Conjunto($_POST["conjuntoA"]);
        $conjuntoB = new Conjunto($_POST["conjuntoB"]);

        echo "CONJUNTOS INGRESADOS POR USTED: <br/>";
        echo "Conjunto A: " . $conjuntoA->toString() . "<br/>";
        echo "Conjunto B: " . $conjuntoB->toString() . "<br/>";
        echo "<br/> RESULTADOS: <br/>";
        echo "Unión: (A U B): " . $conjuntoA->union($conjuntoB)->toString() . "<br/>";
        echo "Intersección: (A n B): " . $conjuntoA -> interseccion($conjuntoB)->toString() . "<br/>";
        echo "Diferencia: (A - B): " . $conjuntoA -> diferencia($conjuntoB) -> toString() . "<br/>";
        "<br/>";
        echo "<br/> RESULTADOS INVERSOS: <br/>";
        echo "Unión: (B U A): " . $conjuntoB->union($conjuntoA)->toString() . "<br/>";
        echo "Intersección: (A n B): " . $conjuntoB -> interseccion($conjuntoA)->toString() . "<br/>";
        echo "Diferencia: (A - B): " . $conjuntoB -> diferencia($conjuntoA) -> toString() . "<br/>";

    }
