<?php
function multiply($n1, $n2)
{
  $response = [
    "type" => "substraction",
    "number_1" => $n1,
    "number_2" => $n2,
    "results" => $n1 * $n2,
  ];
  return json_encode($response);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $getPostBody = file_get_contents('php://input');

  $input = json_decode($getPostBody, true);

  $number_1 = $input['number_1'];
  $number_2 = $input['number_2'];
  $type = $input['type'];
  if (strtolower($type) == "multiply") {


    if (is_int($number_1) && is_int($number_2)) {
        $result = multiply($number_1, $number_2);
    } else {
      die("Insert an INT as number");
    }
  }else{
    die("wrong type");
  }
  echo ($result);
}
