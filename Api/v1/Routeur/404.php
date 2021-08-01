<?php
header("Acces-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=UTF-8");
header("Acces-Control-max-Age:3600");
header("Acces-Control-Allow-Header:Content-Type,Acces-Control-Allow-Header,Autorization,X-Requested-with");
http_response_code(404);
echo json_encode([
  "status"=>404,
  "message"=>"Page non found"
]);

 ?>
