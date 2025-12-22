<?php

session_start();
include 'connect.php';


$data = json_decode(file_get_contents('php://input'), true);

$user_id = $_SESSION['user_id'];
$art_name = isset($data['art_name']) ? trim($data['art_name']) : 'Untitled';
$image_data = $data['image_data'];


$save_art_sql = "INSERT INTO gallery (user_id, art_name, image_data) VALUES ('$user_id', '$art_name', '$image_data')";
$result = mysqli_query($conn, $save_art_sql);
// if ($result) {
//     // echo "<script>
//     //     alert('Artwork saved to gallery successfully! :3');
//     //     console.log('YAYAYAYAYAYAYAAYYAY');
//     // </script>";
// } else {
//     echo "<script>
//         alert('Failed to save artwork. Please try again. :(');
//         console.log('NOOOOOOOOOOOO');
//     </script>";
// }


?>