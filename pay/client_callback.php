<?php

include 'db.php';
// Takes raw data from the request
$json = file_get_contents('php://input');

$data = json_decode($json,TRUE);
$status = $data['data']['status'];
$transaction_id = $data['data']['ref'];
if($status == 'successful'){
    $q = mysqli_query($conn,"UPDATE `payment_transactions` SET `status` = 1 WHERE `payment_transactions`.`transaction_id` = '$transaction_id'");
    $q2 = mysqli_query($conn,"SELECT user_id  FROM payment_transactions WHERE transaction_id = '$transaction_id'");
    $row = mysqli_fetch_assoc($q2);
    $user_id = $row['user_id'];

    $q3 = mysqli_query($conn,"UPDATE users SET `active_until` = DATE_ADD(NOW(), INTERVAL 45 MINUTE) WHERE `users`.`id` = '$user_id'");
    // $q3 = mysqli_query($conn,"UPDATE users SET `address` = 'AHA' WHERE `users`.`id` = '$user_id'");

    
}

// $q = mysqli_query($conn,"UPDATE `payment_transactions` SET `status` = 1 WHERE `payment_transactions`.`transaction_id` = '18f2cdc9-137a-42b0-85a4-171d6c465007'");
//     $q2 = mysqli_query($conn,"SELECT `user_id`, `number_of_uploads` FROM payment_transactions WHERE transaction_id = '18f2cdc9-137a-42b0-85a4-171d6c465007'");
//     $row = mysqli_fetch_assoc($q2);
//     $user_id = $row['user_id'];
//     $number_of_uploads = $row['number_of_uploads'];

//     echo $user_id . " " . $number_of_uploads;
//     // $number_of_uploads = mysqli_fetch_assoc($q2)['number_of_uploads'];
//     // $q3 = mysqli_query($conn,"UPDATE `users` SET `uploads` =  '$number_of_uploads' WHERE `users`.`id` = '$user_id'");