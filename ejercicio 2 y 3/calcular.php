
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);



include 'clases.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $operacion = $_POST['operacion'];

    if ($operacion == 'fibonacci' || $operacion == 'factorial') {
        $numero = intval($_POST['numero']);
        $calculadora = new Calculadora();
        $resultado = $calculadora->calcular($numero, $operacion);
    } elseif ($operacion == 'estadisticas') {
        $numeros = $_POST['numeros'];
        $estadisticas = new Estadisticas();
        $resultado = $estadisticas->calcularEstadisticas($numeros);
    } else {
        $resultado = "Operación no válida.";
    }
} else {
    $resultado = "No se ha recibido ningún dato.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
</head>
<body>
    <h1>Resultado</h1>
    <p><?php echo $resultado; ?></p>
    <a href="index.html">Volver</a>
</body>
</html>