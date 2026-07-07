<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: POST');
require_once 'Usuario.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
echo json_encode(Usuario::login($data['usuario'], $data['password']));
