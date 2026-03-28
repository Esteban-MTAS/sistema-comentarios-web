<?php
header("Content-Type: application/json");

$archivo = "../data/comentarios.json";

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["success" => false]);
    exit;
}

$nombre = htmlspecialchars($data["nombre"]);
$comentario = htmlspecialchars($data["comentario"]);

$comentarios = [];

if (file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
    $comentarios = json_decode($contenido, true);
}

$nuevo = [
    "nombre" => $nombre,
    "comentario" => $comentario,
    "fecha" => date("Y-m-d H:i:s")
];

$comentarios[] = $nuevo;

file_put_contents($archivo, json_encode($comentarios, JSON_PRETTY_PRINT));

echo json_encode(["success" => true]);
