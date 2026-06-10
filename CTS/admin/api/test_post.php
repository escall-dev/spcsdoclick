<?php
$url = 'http://localhost:8000/CTS/admin/api/update-status.php';
$data = array('complaint_id' => '1', 'status' => 'accepted', 'notes' => 'testing', 'csrf_token' => 'dummy');
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
        'ignore_errors' => true
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
echo "Headers: \n";
print_r($http_response_header);
echo "\nResponse: \n" . $result;
