<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula de reservas</title>
</head>
<header>
    <p>Aula Virtual</p>
</header>
<body>
    <p>Acceso a la gestión de salas</p>
    <form action="index.php" method="post">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="checkbox" id="miCasilla" name="opcion" value="valor">
        <label for="miCasilla">Recordar mi usuario</label><br><br><br>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>