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

// Load XML
$dom = new DOMDocument();
$dom->loadXML($xml);

if (!$dom) {
    echo json_encode(['valid' => false, 'errors' => ['Invalid XML structure']]);
    exit;
}

// Validate against DTD
$errors = [];
libxml_use_internal_errors(true);

$valid = $dom->validate();

if (!$valid) {
    $libxml_errors = libxml_get_errors();
    foreach ($libxml_errors as $error) {
        $errors[] = "Line {$error->line}: " . trim($error->message);
    }
    libxml_clear_errors();
}

// Additional validation checks
$noteNameLists = $dom->getElementsByTagName('NoteNameList');
foreach ($noteNameLists as $noteList) {
    $notes = $noteList->getElementsByTagName('Note');
    $numbers = [];
    
    foreach ($notes as $note) {
        $number = $note->getAttribute('Number');
        $name = $note->getAttribute('Name');
        
        if (empty($number) || !is_numeric($number)) {
            $errors[] = "Invalid note number: $number";
        }
        
        if (empty($name)) {
            $errors[] = "Empty note name for note $number";
        }
        
        if (in_array($number, $numbers)) {
            $errors[] = "Duplicate note number: $number in " . $noteList->getAttribute('Name');
        }
        
        $numbers[] = $number;
    }
}

echo json_encode([
    'valid' => empty($errors),
    'errors' => $errors
]);
?>
