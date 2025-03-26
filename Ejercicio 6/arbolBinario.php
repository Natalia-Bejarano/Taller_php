<?php
class Nodo {
    public $valor;
    public $izq;
    public $der;
    public function __construct($valor) {
        $this->valor = $valor;
        $this->izq = null;
        $this->der = null;
    }
}
class Arbol {
    public $raiz;
    public function crear($pre, $in) {
        if(empty($pre)) return null;  
        $raiz_valor = $pre[0];
        $raiz = new Nodo($raiz_valor);      
        $pos = array_search($raiz_valor, $in);
        if($pos === false) {
            throw new Exception('Los recorridos no coinciden');
        }      
        $in_izq = array_slice($in, 0, $pos);
        $in_der = array_slice($in, $pos + 1);       
        $pre_izq = array_slice($pre, 1, count($in_izq));
        $pre_der = array_slice($pre, count($in_izq) + 1);       
        $raiz->izq = $this->crear($pre_izq, $in_izq);
        $raiz->der = $this->crear($pre_der, $in_der);
        return $raiz;
    }
    public function preorden($nodo) {
        if($nodo == null) return [];
        return array_merge(
            [$nodo->valor],
            $this->preorden($nodo->izq),
            $this->preorden($nodo->der)
        );
    }
    public function inorden($nodo) {
        if($nodo == null) return [];
        return array_merge(
            $this->inorden($nodo->izq),
            [$nodo->valor],
            $this->inorden($nodo->der)
        );
    }
    public function dibujarArbol($nodo) {
        if($nodo == null) return '';
        $html = '<div class="nodo">';
        $html .= '<div class="valor">'.$nodo->valor.'</div>';
        if($nodo->izq || $nodo->der) {
            $html .= '<div class="ramas">';
            $html .= '<div class="rama izq">'.$this->dibujarArbol($nodo->izq).'</div>';
            $html .= '<div class="rama der">'.$this->dibujarArbol($nodo->der).'</div>';
            $html .= '</div>';
        }
        
        return $html.'</div>';
    }
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pre = preg_split('/[\s,]+/', trim($_POST['pre'] ?? ''), -1, PREG_SPLIT_NO_EMPTY);
    $in = preg_split('/[\s,]+/', trim($_POST['in'] ?? ''), -1, PREG_SPLIT_NO_EMPTY);
    
    echo '<!DOCTYPE html>
    <html>
    <head>
        <title>Árbol Binario</title>
        <link rel="stylesheet" href="estilos.css">
    </head>
    <body>
    <div class="contenedor">';
    try {
        $arbol = new Arbol();
        $arbol->raiz = $arbol->crear($pre, $in);
        
        echo '<h2>Recorridos del Árbol</h2>';
        echo '<p><strong>Preorden:</strong> '.implode(' → ', $arbol->preorden($arbol->raiz)).'</p>';
        echo '<p><strong>Inorden:</strong> '.implode(' → ', $arbol->inorden($arbol->raiz)).'</p>';
        
        echo '<h2>Estructura del Árbol</h2>';
        echo '<div class="arbol-container">';
        echo $arbol->dibujarArbol($arbol->raiz);
        echo '</div>';
        
    } catch(Exception $e) {
        echo '<div class="error">Error: '.$e->getMessage().'</div>';
        } 
    echo '</div></body></html>';
} else {
    echo '<!DOCTYPE html>
    <html>
    <head>
        <title>Constructor de Árbol Binario</title>
        <link rel="stylesheet" href="estilos.css">
    </head>
    <body>
    <div class="contenedor">
        <h1>Constructor de Árbol Binario</h1>
        <form method="POST">
            <div class="grupo-form">
                <label for="pre">Recorrido Preorden (valores separados por espacio o coma):</label>
                <input type="text" id="pre" name="pre" required>
            </div>
            <div class="grupo-form">
                <label for="in">Recorrido Inorden (valores separados por espacio o coma):</label>
                <input type="text" id="in" name="in" required>
            </div>
            <button type="submit">Construir Árbol</button>
        </form>
    </div>
    </body>
    </html>';
}
?>