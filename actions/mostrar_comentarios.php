<?php
$archivo = "../data/comentarios.json";

if (file_exists($archivo)) {
    echo file_get_contents($archivo);
} else {
    echo "[]";
}
