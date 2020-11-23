<?
$json = readfile('http://ip-api.com/json');

print json_decode($json);

?>