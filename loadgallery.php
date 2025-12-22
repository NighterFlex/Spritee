<?php

session_start();
include 'connect.php';

$user_id = $_SESSION['user_id'];

$load_art_sql = " SELECT id, art_name, image_data, created_at FROM gallery WHERE user_id = '$user_id' ORDER BY created_at DESC";

$result = mysqli_query($conn, $load_art_sql);

if (!$result) {
    echo json_encode([
        'success' => false,
        'message' => 'Database error'
    ]);
    exit;
}

$artworks = [];

while ($row = mysqli_fetch_assoc($result)) {
    $artworks[] = $row;
}

//send data back as JSON yayayy
echo json_encode([
    'success' => true,
    'artworks' => $artworks
]);


?>