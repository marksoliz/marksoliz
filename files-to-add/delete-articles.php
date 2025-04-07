<?php
header('Content-Type: application/json');

$responce = ['status' => 'error', 'message' => 'Invalid request.'];

echo json_encode($responce);
