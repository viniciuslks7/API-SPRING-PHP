<?php
/**
 * Consumo da API REST (Spring Boot) para o sistema de vendas.
 * Centralizado para suportar todos os endpoints da API.
 */

define('API_BASE', 'http://localhost:8090');

function callAPI($method, $url, $data = false)
{
    $curl = curl_init();

    switch (strtoupper($method)) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            break;

        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($data) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            break;

        case "DELETE":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            break;

        default:
            if ($data && is_array($data)) {
                $url = sprintf("%s?%s", $url, http_build_query($data));
            }
            break;
    }

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Accept: application/json"
    ]);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $result = curl_exec($curl);
    if ($result === false) {
        curl_close($curl);
        return [];
    }

    curl_close($curl);
    $decoded = json_decode($result, true);

    return is_array($decoded) ? $decoded : [];
}