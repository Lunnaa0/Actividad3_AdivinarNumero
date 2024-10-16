<?php
session_start();

$maxInt =5; 
$m = "";

if (!isset($_SESSION['adivina']) || isset($_POST['nuevoJuego'])) {
    $_SESSION['adivina'] = rand(1, 10); 
    $_SESSION['intentos'] = 0; 
    $m = "¡Nuevo juego iniciado!";
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['nuevoJuego'])) {
        $numero = intval($_POST['numero']);
        $_SESSION['intentos']++;

        if ($numero == $_SESSION['adivina']) {
            $m = "¡Felicidades! Adivinaste el número en " . $_SESSION['intentos'] . " intentos.";
            $finJuego = true;
        } elseif ($_SESSION['intentos'] >= $maxInt) {
            $m = "Has usado los 5 intentos. El número era " . $_SESSION['adivina'];
            $finJuego = true;
        } else {
            if ($numero < $_SESSION['adivina']) {
                $m = "El número es mayor.";
            } else {
                $m = "El número es menor.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego de Adivinanza</title>
</head>
<body>
    <h1>¡Adivina el número!</h1>
    <p><?= "Intento " . $_SESSION['intentos'] . " de " . $maxInt . ".<br><br> " . $m; ?></p>

    <?php if (!isset($finJuego)) { ?>
        <form action="" method="POST">
            <label for="numero">Introduce un número del 1 al 10:</label>
            <input type="number" name="numero" min="1" max="10" required>
            <input type="submit" value="Adivinar">
        </form>
    <?php } else { ?>
        <form action="" method="POST">
            <button type="submit" name="nuevoJuego">Iniciar nuevo juego</button>
        </form>
    <?php } ?>
</body>
</html>
