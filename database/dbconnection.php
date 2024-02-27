<?php

$connectionStatus="0";

//LOCAL HOST
$connection=mysqli_connect("localhost", "root", "root", "pharma");
mysqli_set_charset($connection, 'utf8mb4');
// Check connection
        if (mysqli_connect_errno()) {
            // echo "Failed to connect to MySQL: " . mysqli_connect_error();
            $connectionStatus="1";
        }


//LIVE ENVIRONMENT
// $connection=mysqli_connect("localhost", "metslimi_metsuser", "Mets@2023$", "metslimi_mets_database");
// mysqli_set_charset($connection, 'utf8mb4');
// // Check connection
// if (mysqli_connect_errno()) {
//     // echo "Failed to connect to MySQL: " . mysqli_connect_error();
//     $connectionStatus="1";
// }
