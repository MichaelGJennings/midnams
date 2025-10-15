<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$xml = $_POST['xml'] ?? '';

if (empty($xml)) {
    http_response_code(400);
    echo json_encode(['error' => 'No XML data provided']);
    exit;
}

// Validate XML structure
$dom = new DOMDocument();
$dom->loadXML($xml);

if (!$dom) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid XML']);
    exit;
}

// Save to file
$filename = 'Alesis/D4.midnam';
$backup_filename = 'Alesis/D4.midnam.backup.' . date('Y-m-d-H-i-s');

// Create backup
if (file_exists($filename)) {
    copy($filename, $backup_filename);
}

// Save new content
$result = file_put_contents($filename, $xml);

if ($result === false) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to save file']);
    exit;
}

echo json_encode(['success' => true, 'backup' => $backup_filename]);
?>
