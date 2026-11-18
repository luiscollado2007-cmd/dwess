<?php
// ============================================================
// EJERCICIO 117. Ejercicio 117. Desarrolla un carrito completo en 
// sesión con cantidades, actualización de unidades, eliminación y cálculo del total.
// FASE 0: PLANTILLA (para completar por el alumnado)
// Ya está hecho: sesión, catálogo, carrito vacío y todo el HTML.
// FASE 1: programar la función anadir() y el controlador
// para llegar que sea capaz de añadir productos al carrito.
// ============================================================

// Iniciar la sesión
session_start();

// Catálogo de productos: id => [nombre, precio]
$productos = [
    1 => array("nombre" => "Teclado",     "precio" => 50),
    2 => array("nombre" => "Raton",       "precio" => 20),
    3 => array("nombre" => "Monitor",     "precio" => 130),
    4 => array("nombre" => "Auriculares", "precio" => 35)
];

// Si el carrito no existe todavía, lo creamos vacío.
// Estructura: $_SESSION["carrito"][id_producto] = cantidad

if (!isset($_SESSION["carrito"])) {
    $_SESSION["carrito"] = [];
}

// ------------------------------------------------------------
// TAREA 1: FUNCIÓN anadir($id, $cantidad)
// ------------------------------------------------------------
// Pistas:
//  - Necesitas usar "global $productos;" dentro de la función. 
//    O pasar los productos por parámetro.
//  - Si el producto NO existe en $productos o la cantidad es
//    menor que 1, no hagas nada.
//  - Si el producto YA está en $_SESSION["carrito"], suma la
//    cantidad a las unidades que ya había.
//  - Si NO está, créalo con la cantidad recibida.
//  - Para saber si existe una posición usa isset().
function anadir($id, $cantidad,$productos){
    if(isset($_SESSION["carrito"][$id]) || $cantidad >= 1){
        $_SESSION["carrito"][$id] += $cantidad;
    }
}




// ------------------------------------------------------------
// TAREA 2: CONTROLADOR (procesar el formulario)
// ------------------------------------------------------------
// Pistas:
//  - Comprueba que el método sea POST:
//        $_SERVER["REQUEST_METHOD"] == "POST"
//  - Recoge los datos de $_POST["accion"], $_POST["id"] y
//    $_POST["cantidad"]. Convierte id y cantidad a entero con (int).
//  - Si la acción es "anadir", llama a tu función anadir().
//  - Al terminar, redirige a la misma página:
if($_SERVER["REQUEST_METHOD"] == "POST"){
    echo $_POST["accion"]. "<br>";
    echo (int) $_POST["id"]. "<br>";
    echo (int) $_POST["cantidad"]. "<br>";
    if($_POST["accion"] == "anadir"){
        anadir((int) $_POST["id"], (int) $_POST["cantidad"], $productos);
    }
    header("Location: Ejercicio117.php");
    exit;
}






?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Fase 0 - Plantilla</title>
</head>
<body>

<h1>Fase 0: plantilla</h1>

<!-- ================= CATÁLOGO ================= -->
<h2>Productos</h2>
<table border="1">
    <tr>
        <th>Producto</th>
        <th>Precio</th>
        <th>Añadir</th>
    </tr>
    <?php foreach ($productos as $id => $p) { ?>
        <tr>
            <td><?php echo $p["nombre"]; ?></td>
            <td><?php echo $p["precio"]; ?> €</td>
            <td>
                <form method="post">
                    <input type="hidden" name="accion" value="anadir">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="number" name="cantidad" value="1" min="1">
                    <input type="submit" value="Añadir">
                </form>
            </td>
        </tr>
    <?php } ?>
</table>

<!-- ================= CARRITO (solo lo muestra) ================= -->
<h2>Carrito</h2>

<?php if (count($_SESSION["carrito"]) == 0) { ?>

    <p>El carrito está vacío.</p>

<?php } else { ?>

    <table border="1">
        <tr>
            <th>Producto</th>
            <th>Unidades</th>
        </tr>
        <?php foreach ($_SESSION["carrito"] as $id => $cantidad) { ?>
            <tr>
                <td><?php echo $productos[$id]["nombre"]; ?></td>
                <td><?php echo $cantidad; ?></td>
            </tr>
        <?php } ?>
    </table>

<?php } ?>

</body>
</html>
