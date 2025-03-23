<?php
interface Conversion {
    public function convertir();

}
    class conversor {
        protected $numero;

        public function __construct($numero) {
            $this->numero = (int) $numero;
        }

            public function getNumero() {
                return $this->numero;
            }
    }

            class ConversorBinarioDec extends Conversor  {
                public function convertir()
                {
                    return decbin($this->getNumero());
                }
            }
                if ($_SERVER["REQUEST_METHOD"] == "POST"){
                    $numero = $_POST["numero"];

                    if ($numero == "" or !is_numeric($numero)){
                        echo "Ingrese un número VÁLIDO";
                        
                    } else {
                        $conversion = new ConversorBinarioDec($numero);
                        echo "El número en binario es: " . $conversion->convertir();
                    }
           }

?>