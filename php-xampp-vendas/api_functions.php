<?php
/**
 * Consumo da API REST (Spring Boot) para o sistema de vendas.
 */

define('API_BASE', 'http://localhost:8090');

function callAPIResponse($method, $url, $data = false): array
{
    $curl = curl_init();

    switch (strtoupper($method)) {
        case 'POST':
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data !== false) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            break;

        case 'PUT':
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
            if ($data !== false) {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            break;

        case 'DELETE':
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
            break;

        default:
            if ($data && is_array($data)) {
                $url = sprintf('%s?%s', $url, http_build_query($data));
            }
            break;
    }

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Accept: application/json',
        'Cache-Control: no-cache',
    ]);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($curl, CURLOPT_TIMEOUT, 15);

    $result = curl_exec($curl);
    $curlError = curl_error($curl);
    $status = (int) curl_getinfo($curl, CURLINFO_RESPONSE_CODE);

    curl_close($curl);

    if ($result === false) {
        return [
            'ok' => false,
            'status' => $status,
            'body' => null,
            'raw' => null,
            'error' => $curlError,
        ];
    }

    $decoded = json_decode($result, true);
    $body = (json_last_error() === JSON_ERROR_NONE) ? $decoded : $result;

    return [
        'ok' => ($status >= 200 && $status < 300),
        'status' => $status,
        'body' => $body,
        'raw' => $result,
        'error' => $curlError ?: null,
    ];
}

function callAPI($method, $url, $data = false)
{
    $response = callAPIResponse($method, $url, $data);
    return is_array($response['body']) ? $response['body'] : [];
}
