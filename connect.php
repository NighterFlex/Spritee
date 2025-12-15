<?php

//connection to the database
$conn = new mysqli('localhost', 'myadmin', '123456789', 'spritee_db');
if(!$conn){
//     echo "Connection Successful :)";
// }
// else{

    die("Connection Failed :( :".$conn->connect_error);    //kills process and shows error
}
else{
    // echo "Connection Successful :)";
}
?>