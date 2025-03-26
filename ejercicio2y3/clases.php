<?php
class Calculadora {
    public function calcular($numero, $operacion) {
        if ($operacion == 'fibonacci') {
            return $this->fibonacci($numero);
        } elseif ($operacion == 'factorial') {
            return $this->factorial($numero);
        }
    }

    private function fibonacci($n) {
        if ($n == 0) return "0";
        if ($n == 1) return "0, 1";

        $serie = [0, 1];
        for ($i = 2; $i < $n; $i++) {
            $serie[$i] = $serie[$i - 1] + $serie[$i - 2];
        }
        return implode(', ', $serie);
    }

    private function factorial($n) {
        $resultado = 1;
        for ($i = 1; $i <= $n; $i++) {
            $resultado *= $i;
        }
        return $resultado;
    }
}

class Estadisticas {
    public function calcularEstadisticas($numeros) {
        $numerosArray = array_map('floatval', explode(',', $numeros));
        $promedio = $this->calcularPromedio($numerosArray);
        $mediana = $this->calcularMediana($numerosArray);
        $moda = $this->calcularModa($numerosArray);

        return "Promedio: $promedio <br> Mediana: $mediana <br> Moda: $moda";
    }

    private function calcularPromedio($numeros) {
        return array_sum($numeros) / count($numeros);
    }

    private function calcularMediana($numeros) {
        sort($numeros);
        $cantidad = count($numeros);
        $medio = floor($cantidad / 2);

        if ($cantidad % 2 == 0) {
            return ($numeros[$medio - 1] + $numeros[$medio]) / 2;
        } else {
            return $numeros[$medio];
        }
    }

    private function calcularModa($numeros) {
        
        $numeros = array_map('intval', $numeros);
        $frecuencia = array_count_values($numeros);
    
        if (empty($frecuencia)) {
            return "No hay moda.";
        }
    
        $maxFrecuencia = max($frecuencia);
        $modas = array_keys($frecuencia, $maxFrecuencia);
    
        return implode(', ', $modas);
    }
}
?>