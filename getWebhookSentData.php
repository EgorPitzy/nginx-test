<?php
const BOT_TOKEN = '6763296071:AAF9DIF5Dx7DFJvXOT6gZfgFh45PROV5oFs';

$data = file_get_contents('php://input');
$logFile = "userChatInfo.json";
$log = fopen($logFile, "a");
fwrite($log, $data);
fclose($log);