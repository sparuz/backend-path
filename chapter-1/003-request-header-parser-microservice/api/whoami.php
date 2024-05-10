<?php

$response = [
    "ip" => $_SERVER['REMOTE_ADDR'],
    "language" => $_SERVER['HTTP_ACCEPT_LANGUAGE'],
    "software" => $_SERVER['HTTP_USER_AGENT'],
];

echo(json_encode($response));