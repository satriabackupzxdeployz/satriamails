<?php
header('Content-Type: application/json');

$db_url = "https://satriamail-684f1-default-rtdb.asia-southeast1.firebasedatabase.app";
$action = $_GET['action'] ?? '';

function curl_request($url, $method = 'GET', $data = null) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    if ($data) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    }
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

$input = json_decode(file_get_contents('php://input'), true);

if ($action === 'get_all') {
    $users = curl_request("$db_url/users.json") ?: [];
    $messages = curl_request("$db_url/messages.json") ?: [];
    $publicChats = curl_request("$db_url/publicChats.json") ?: [];
    echo json_encode(['users' => $users, 'messages' => $messages, 'publicChats' => $publicChats]);
    exit;
}

if ($action === 'create_user') {
    $ip = $input['ip'];
    curl_request("$db_url/users/$ip.json", 'PUT', $input['user']);
    echo json_encode(['success' => true]);
    exit;
}

if ($action === 'update_user') {
    $ip = $input['ip'];
    curl_request("$db_url/users/$ip.json", 'PATCH', $input['data']);
    echo json_encode(['success' => true]);
    exit;
}

if ($action === 'delete_user') {
    $ip = $input['ip'];
    curl_request("$db_url/users/$ip.json", 'DELETE');
    echo json_encode(['success' => true]);
    exit;
}

if ($action === 'send_message') {
    curl_request("$db_url/messages.json", 'POST', $input['message']);
    echo json_encode(['success' => true]);
    exit;
}

if ($action === 'send_public') {
    curl_request("$db_url/publicChats.json", 'POST', $input['chat']);
    echo json_encode(['success' => true]);
    exit;
}

if ($action === 'delete_message') {
    $id = $input['id'];
    curl_request("$db_url/messages/$id.json", 'DELETE');
    echo json_encode(['success' => true]);
    exit;
}

if ($action === 'mark_read') {
    $id = $input['id'];
    curl_request("$db_url/messages/$id.json", 'PATCH', ['read' => true]);
    echo json_encode(['success' => true]);
    exit;
}
?>
