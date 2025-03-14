<?php
header("Content-Type: application/json");
require 'db.php';

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'] ?? '', '/'));
$id = $request[0] ?? null;
$input = json_decode(file_get_contents('php://input'), true);

$response = [];

switch ($method) {
    case 'GET':
        if ($id) {
            $stmt = $conn->prepare('SELECT * FROM users WHERE id = ?');
            $stmt->execute([$id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user) {
                $response = ['status' => 'success', 'data' => $user];
            } else {
                $response = ['status' => 'error', 'message' => 'User not found'];
            }
        } else {
            $stmt = $conn->query('SELECT * FROM users');
            $response = ['status' => 'success', 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)];
        }
        break;

    case 'POST':
        if (empty($input['username']) || empty($input['password']) || empty($input['email'])) {
            $response = ['status' => 'error', 'message' => 'Invalid input'];
        } else {
            $stmt = $conn->prepare('INSERT INTO users (username, password, email) VALUES (?, ?, ?)');
            $stmt->execute([$input['username'], password_hash($input['password'], PASSWORD_DEFAULT), $input['email']]);
            $response = ['status' => 'success', 'message' => 'User created'];
        }
        break;

    case 'PUT':
        if (!$id) {
            $response = ['status' => 'error', 'message' => 'Invalid user ID'];
        } else {
            $stmt = $conn->prepare('UPDATE users SET username = ?, password = ?, email = ? WHERE id = ?');
            $stmt->execute([
                $input['username'] ?? '',
                isset($input['password']) ? password_hash($input['password'], PASSWORD_DEFAULT) : '',
                $input['email'] ?? '',
                $id
            ]);
            $response = ['status' => 'success', 'message' => 'User updated'];
        }
        break;

    case 'DELETE':
        if (!$id) {
            $response = ['status' => 'error', 'message' => 'Invalid user ID'];
        } else {
            $stmt = $conn->prepare('DELETE FROM users WHERE id = ?');
            $stmt->execute([$id]);
            $response = ['status' => 'success', 'message' => 'User deleted'];
        }
        break;

    default:
        $response = ['status' => 'error', 'message' => 'Method not allowed'];
}

echo json_encode($response);
?>