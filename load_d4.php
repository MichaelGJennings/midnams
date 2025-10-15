<?php
header('Content-Type: application/xml');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

$filename = 'Alesis/D4.midnam';

if (!file_exists($filename)) {
    http_response_code(404);
    echo '<?xml version="1.0" encoding="UTF-8"?><error>File not found</error>';
    exit;
}

$xml = file_get_contents($filename);

if ($xml === false) {
    http_response_code(500);
    echo '<?xml version="1.0" encoding="UTF-8"?><error>Failed to read file</error>';
    exit;
}

echo $xml;
?>
