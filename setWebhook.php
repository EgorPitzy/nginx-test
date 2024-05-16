<?php
// use env variable to hide tokens and other secret information
// check this for more information 
// https://www.php.net/manual/en/reserved.variables.environment.php
const BOT_TOKEN = '6609905017:AAFe-vqb3NRmCSfZ5cSAVArglMgYNQb1jz8';

//устанавливаем вебхук с помощью этого скрипта (скрипт единоразовый)
//на один бот можно установить только один вебхук
//ВАЖНО! - после установки хука, метод getUpdates перестает работать!
//==========
$method = 'setWebhook';
$setWebHookURL = 'https://api.telegram.org/bot'.BOT_TOKEN.'/'.$method;

$getQuery = [
  'url' => 'https://westa.dp.ua/tg-bot/index.php',
];
$response = file_get_contents($setWebHookURL.'?'.http_build_query($getQuery));
var_dump($response);
































//==================================================
/*самописная ф-ция, заприсывающая все данные в файл (в идеале сделать интеграцию с БД) и принимающая параметры: 
  - $string - в файл будем записывать данные в виде строк
  - $clear - он нужен для переписывания/дописывания данных в файл (true = перепись, false = будет дописывать)*/

/*
function writeLogFile($string, $clear = false){
    $log_file_name = __DIR__."/message.txt";
    $now = date("Y-m-d H:i:s");
    if($clear == false) {
      file_put_contents($log_file_name, $now." ".print_r($string, true)."\r\n", FILE_APPEND);
    }
    else {
      file_put_contents($log_file_name, '');
      file_put_contents($log_file_name, $now." ".print_r($string, true)."\r\n", FILE_APPEND);
    }
}

//с помощью ф-ции file_get_contents, мы записываем любые запросы в переменную $data
$data = file_get_contents('php://input');
//декодируем полученные запросы из формата JSON в обычный ассоциативный массив
$data = json_decode($data, true);

writeLogFile($data, true);

echo file_get_contents(__DIR__."/message.txt");
*/

