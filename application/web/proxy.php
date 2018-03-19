<?php
$data = [
    'x_forwarded_for' => $_SERVER['HTTP_X_FORWARDED_FOR'],
    'x_real_ip'       => $_SERVER['HTTP_X_REAL_IP'],
    'remote_addr'     => $_SERVER['REMOTE_ADDR'],
];
echo json_encode($data);