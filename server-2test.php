<?php

// JSON data to be sent
$data = array(
    'id' => '2',
    'transaction_id' => '98599906',
    'amount' => '5000',
    'description' => 'Sacco Dep: by ricky-0768357385, Group: GROUP 2-0355557587',
    'saver' => array(
        // 'id' => '1',
        'name' => 'ricky',
        'email' => 'ricky@gmail.com',
        'tel' => '0768357385',
        'nin' => 'QWERTYFGHJMM',
        'location' => 'nagera',
        'group_id' => '2',
        'group_name' => 'GROUP 2',
        'group_phone' => '0355557587',
        'group_email' => 'groupa@gmail.com',
        'amount' => '5000',
       
    )
);



// Convert data to JSON string
$json_data = json_encode($data);

// URL of the receiving server
$url = 'https://api.pearlbuddy.com/callbackbuddy.php';

// Initialize cURL session
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute cURL session
$response = curl_exec($ch);
echo $response ;

// Check for errors
if ($response === false) {
    echo 'cURL error: ' . curl_error($ch);
} else {
    echo 'Response from server: ' . $response;
}

// Close cURL session
curl_close($ch);

?>
