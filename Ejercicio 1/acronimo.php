<?php
class Acronimo {
    public function generarAcronimo($frase) {
        $frase = preg_replace('/[^\w\s-]/u', '', $frase);
        $frase = str_replace('-', ' ', $frase);
        $palabras = explode(' ', $frase);
        $acronimo = '';
        for ($i = 0; $i < count($palabras); $i++) {
            if ($palabras[$i] !== '') {
                $acronimo .= strtoupper($palabras[$i][0]);
            }
        }
        return $acronimo;
    }
}
$objAcronimo = new Acronimo();
$frase = $_POST["frase"];
$resultado = $objAcronimo->generarAcronimo($frase);
echo "El acrónimo de '$frase' es: $resultado";
?>
