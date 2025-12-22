<?php

session_start();
include 'connect.php';



//reading JSON input
$data = json_decode(file_get_contents('php://input'), true);

$artwork_id = isset($data['id']) ? $data['id'] : null;
$user_id = $_SESSION['user_id'];

if (!$artwork_id) {
    echo json_encode([
        'success' => false,
        'message' => 'No artwork ID provided'
    ]);
    exit;
}

// Delete query 
$delete_sql = "DELETE FROM gallery WHERE id = '$artwork_id' AND user_id = '$user_id'";

$result = mysqli_query($conn, $delete_sql);

if (!$result) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error'
    ]);
    exit;
}

// Check if any row was deleted
if (mysqli_affected_rows($conn) > 0) {
    echo json_encode([
        'success' => true,
        'message' => 'Artwork deleted successfully'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Artwork not found or unauthorized'
    ]);
}

?>
