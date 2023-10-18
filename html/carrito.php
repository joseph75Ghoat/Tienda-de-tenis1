<?php include '../controlador/ctrltotalCarrito.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="../css/caritto.css">
    
</head>

<body>

    <h1>Carrito de Compras</h1>
   
    <?php include '../controlador/ctrlMostrarCarrito.php'; ?>
    <div class="product-container">
        <?php foreach ($productos as $producto) { ?>
            <div class="product">
                <img src="../assets/img/<?php echo $producto['imagen_producto']; ?>" alt="<?php echo $producto['nombre']; ?>">
                <h3><?php echo $producto['nombre']; ?></h3>
                <p>Precio: $<?php echo $producto['precio']; ?></p>
                <p>Cantidad: <?php echo $producto['cantidad']; ?></p>
                <p>Subtotal: $<?php echo $producto['subtotal']; ?></p>
                <p>id: <?php echo $producto['id_producto']; ?></p>
                <button class="eliminar-elemento" data-producto-id="<?php echo $producto['id_producto']; ?>">Eliminar</button>
            </div>
        <?php } ?>
    </div>

    <h2>Resumen del Carrito</h2>
    <ul id="cart-items">
        <!-- Aquí se mostrarán los elementos del carrito -->
    </ul>

    <h3>TOTAL A PAGAR: $<?php echo $totalCarrito; ?></h3>

    <button id="checkout"><a href="../controlador/ctrlComprarcarro.php">Realizar Compra</a></button>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Manejar el clic en el botón para eliminar un elemento del carrito
            $('.eliminar-elemento').click(function() {
                var id_producto = $(this).data('producto-id');
                var confirmation = confirm("¿Estás seguro de que deseas eliminar este elemento del carrito?");
                if (confirmation) {
                    eliminarElementoDelCarrito(id_producto, $(this));
                }
            });

            function eliminarElementoDelCarrito(producto_id, elemento) {
                $.ajax({
                    url: '../controlador/ctrlBorrarElementoCarrito.php?id=' + producto_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        alert(response.message);
                        if (response.success) {
                            alert(response.message);
                            // Actualiza la sección del carrito con la respuesta del servidor
                            $('#cart-items').html(response.cartItemsHtml);
                        } else {
                            alert('Hubo un error al eliminar el elemento del carrito.');
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>
