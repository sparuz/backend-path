<?php

function isValidDate($date)
{
    $formats = [
        DateTime::RFC3339,
        'D, d M Y H:i:s',
        'Y-m-d\TH:i:sP',
        'Y-m-d H:i:s',
        'Y-m-d',
        'm/d/Y',
        'd-m-Y',
        'd/m/Y',
    ];

    foreach ($formats as $format) {
        $dateCheck = DateTime::createFromFormat($format, $date);

        if ($dateCheck && $dateCheck->format($format) === $date) {
            return $dateCheck;
        }
    }
    return false;
}



if (isset($_GET["date"])) {
    $date = $_GET["date"];
    if ($date != "") {
        $dateObj = isValidDate($date);
        if ($dateObj) {
            $date = $dateObj->format('Y-m-d');
            $response = [
                "message" => "Valid date format",
                "dateUnix" => strtotime($date),
                "dateInMilliseconds" => strtotime($date) * 1000,
                "utc" =>  gmdate("D, d M Y H:i:s \G\M\T", strtotime($date))
            ];
            $response = json_encode($response);
            echo ($response);
        } else {
            $response = [
                "error" => "Invalid date format. Expected format: YYYY-MM-DD",
            ];
            $response = json_encode($response);
            echo ($response);
        }
    } else {
        $today = getdate()[0];
        $response = [
            "dateUnix" => $today,
            "dateInMilliseconds" => $today * 1000,
            "utc" =>  gmdate("D, d M Y H:i:s \G\M\T", $today)
        ];
        $response = json_encode($response);
        echo ($response);
    }
} elseif (isset($_GET["unix"])) {
    $unix = $_GET["unix"];
    $response = [
        "unix_time" => $unix,
        "dateInMilliseconds" => $unix * 1000,
        "utc" =>  gmdate("D, d M Y H:i:s \G\M\T", $unix)
    ];
    $response = json_encode($response);
    echo ($response);
}
