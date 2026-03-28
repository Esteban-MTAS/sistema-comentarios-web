<?php
$archivo = "../data/comentarios.json";

// Leer JSON enviado desde JS
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["success" => false, "message" => "Datos inválidos"]);
    exit;
}

$nombre = htmlspecialchars($data["nombre"]);
$comentario = htmlspecialchars($data["comentario"]);

$comentarios = [];

if (file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
    $comentarios = json_decode($contenido, true);
}

// Agregar fecha
$nuevo = [
    "nombre" => $nombre,
    "comentario" => $comentario,
    "fecha" => date("Y-m-d H:i:s")
];

$comentarios[] = $nuevo;

file_put_contents($archivo, json_encode($comentarios, JSON_PRETTY_PRINT));

// Respuesta para JS
echo json_encode(["success" => true]);
