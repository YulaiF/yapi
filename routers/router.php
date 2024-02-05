<?php

namespace YAPI\Router;

use stdClass;

function route($url): void
{
    global $CONFIG, $DEBUG;
    header('Content-Type: application/json; charset=utf-8');
    global $ROOT_PATH;
    $stabsDirectory = '/stubs/';

    $stubJson = $stabsDirectory . $url . ".json";
    $stubJsonFullPath = $ROOT_PATH . $stubJson;

    if (file_exists($stubJsonFullPath)) {
        $jsonData = file_get_contents($stubJsonFullPath);
        echo $jsonData;
        return;
    }

    header('HTTP/1.0 404 Not Found');
    $json = new stdClass();
    $json->state = false;
    $json->data = [];
    $json->error = [
        'message' => "Stub not found"
    ];
    if ($DEBUG) {
        $json->debug = [
            'url' => $url,
            'yapi' => [
                'stub' => $stubJson,
                'version' => $CONFIG['yapi']['version']
            ],
            'request' => [
                'method' => $_SERVER['REQUEST_METHOD'],
                'request_uri' => $_SERVER['REQUEST_URI'],
            ]
        ];
    }

    echo json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return;
}

