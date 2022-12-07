<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");

// тело запроса
$request = json_decode(
  file_get_contents("php://input"),
true
);

// создание клиента
$client = $request["client"];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "http://localhost/api/index.php/clients/create");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($client, JSON_UNESCAPED_UNICODE));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);

if ($result === false) {
  http_response_code(500);

  echo json_encode([
    "message" => "Ошибка при добавлении клиента!",
  ], JSON_UNESCAPED_UNICODE);

  die();
}

$clientId = json_decode($result, true)["client_id"];

$request["client"]["client_id"] = $clientId;

curl_setopt($ch, CURLOPT_URL, "http://localhost/api/index.php/orders/create");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request, JSON_UNESCAPED_UNICODE));

$result = curl_exec($ch);

if ($result === false) {
  http_response_code(500);

  echo json_encode([
    "message" => "Ошибка при добавлении заказа!",
  ], JSON_UNESCAPED_UNICODE);

  die();
}

http_response_code(201);
echo $result;
