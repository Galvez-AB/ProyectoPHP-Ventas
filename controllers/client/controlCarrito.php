<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['agregarCarrito'])) {
  $idProducto = $_POST['idProducto'];
  if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
  }

  if (!isset($_SESSION['carrito'][$idProducto])) {
    $_SESSION['carrito'][$idProducto] = 1;
  } else {
    $_SESSION['carrito'][$idProducto] += 1;
  }
  //toy contando items--------------------------------------
  $totalProductos = array_sum($_SESSION['carrito']);

  echo json_encode(array(
    'success' => true,
    'message' => 'Producto agregado al carrito',
    'totalItems' => $totalProductos
  ));
} else {
  echo json_encode(array(
    'success' => false,
    'message' => 'Error al agregar el producto al carrito'
  ));
}
?>