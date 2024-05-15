<?php
const BOT_TOKEN = '6609905017:AAFe-vqb3NRmCSfZ5cSAVArglMgYNQb1jz8';

$data = file_get_contents('php://input');
$data = json_decode($data, true);
//$logFile = "userChatInfo.json";
//$log = fopen($logFile, "a");
//fwrite($log, $data);
//fclose($log);


if (array_key_exists('message', $data)) {                           // если это объект message
    $userID = $data['message']['from']['id'];
    if (array_key_exists('text',$data['message'])) $userMessage = $data['message']['text'];
    else $userMessage = '';	                   
} 
elseif (array_key_exists('callback_query', $data)) {           // если это объект callback_query
    $userID = $data['callback_query']['from']['id'];
    $userMessage = $data['callback_query']['message']['message_id'];
    $button = $data['callback_query']['data'];
} else exit();


//$data = json_decode($data, true);
//$userID = $data['message']['from']['id'];

//$userMessage = $data['message']['text'];

$parameters = array(
    "chat_id" => $userID,
    "text" => $botMessage,
    "parse_mode" => "html"
);

$method = 'sendMessage';
$apiURL = 'https://api.telegram.org/bot'.BOT_TOKEN.'/'.$method;



//============================== Работа с кнопками/командами ==============================


//============================== команда /start ==============================
if($userMessage == "/start"){
    $parameters = array(
        "chat_id" => $userID,
        "text" => "Вас приветствует бот магазина АККУМ-МАГ.\nБудем выбирать аккумулятор для вашего авто?🚗\n\n❗Бот не отвечает на ваши сообщения❌. Пользуйтесь меню ниже👇",
        "reply_markup" => json_encode(
            array(
                "keyboard" => array(
                    array(
                        array(
                            "text" => "Каталог📖",
                            "callback_data" => "catalog", 
                        ),
                        array(
                            "text" => "Мы на карте города📍",
                            "callback_data" => "map",
                        ),
                    ),
                    array(
                        array(
                            "text" => "Частые вопросы❓",
                            "callback_data" => "questions", 
                        ),
                        array(
                            "text" => "Помощь🆘",
                            "callback_data" => "help", 
                        ),
                    ),
                ),
                "one_time_keyboard" => false,
                "resize_keyboard" => true,
            )
        ),
    );
}
//============================== команда /catalog || кнопка "Каталог" ==============================
elseif($userMessage == "/catalog" || $userMessage == "Каталог📖"){
    $parameters = array(
        "chat_id" => $userID,
        "text" => "Каталог еще в разработке. Скоро будет готов😉",
    );
}
//============================== команда /map || кнопка "Мы на карте города" ==============================
elseif($userMessage == "/map" || $userMessage == "Мы на карте города📍" || $button == "catalog"){
    $method = 'sendPhoto';
    
    $parameters = array(
        'chat_id' => $userID,
        'caption' => 'Проверка работы',
        'photo' => curl_file_create(__DIR__ .'/pictures/map.png', 'image/png', 'map.png'),
        'protect_content' => true,
    );	

}
//============================== команда /questions || кнопка "Частые вопросы" ==============================
elseif($userMessage == "/questions" || $userMessage == "Частые вопросы❓"){
    $parameters = array(
        "chat_id" => $userID,
        "text" => "Ниже приведены наиболее частые вопросы наших покупателей. Надеюсь, вы найдете ответ на ваш вопрос😊👇",
        "reply_markup" => json_encode(
            array(
                "inline_keyboard" => array(
                    array(
                        array(
                            "text" => "Чем EFB-аккумуляторы лучше обычных❓",
                            "callback_data" => "text_1", 
                        ),
                    ),
                    array(
                        array(
                            "text" => "Почему отправляее через 100% предоплату❓",
                            "callback_data" => "text_2", 
                        ),
                    ),
                    array(
                        array(
                            "text" => "Через какие почтовые службы отправляете❓",
                            "callback_data" => "text_3", 
                        ),
                    ),
                    array(
                        array(
                            "text" => "Какой у вас график работы❓",
                            "callback_data" => "text_4", 
                        ),
                    ),
                    array(
                        array(
                            "text" => "А могу ли я забронить заказ и приехать забрать его сам❓",
                            "callback_data" => "text_5", 
                        ),
                    ),
                    array(
                        array(
                            "text" => "Если я не нашел нужный мне аккумулятор, что мне делать❓",
                            "callback_data" => "text_6", 
                        ),
                    ),
                ),
            )
        ),
    );

    if($button = "text_1"){
        $parameters = array(
            "chat_id" => $data['message']['from']['id'],
            "text" => "EFB-аккумуляторы быстрее традиционных кислотных батарей восстанавливают заряд в процессе эксплуатации. Также они способны перенести большее число глубоких разрядок, чем обычные кислотные аккумуляторы. Плюс обеспечивают в 2 раза больше циклов «разрадки-зарядки» без утраты функциональности😉",
        );
    }
    elseif($userMessage == "Почему отправляее через 100% предоплату❓"){
        $parameters = array(
            "chat_id" => $data['message']['from']['id'],
            "text" => "текст 2",
        );
    }
    elseif($userMessage == "Через какие почтовые службы отправляете❓"){
        $parameters = array(
            "chat_id" => $data['message']['from']['id'],
            "text" => "текст 3",
        );
    }
    elseif($userMessage == "Какой у вас график работы❓"){
        $parameters = array(
            "chat_id" => $data['message']['from']['id'],
            "text" => "текст 4",
        );
    }
    elseif($userMessage == "А могу ли я забронить заказ и приехать забрать его сам❓"){
        $parameters = array(
            "chat_id" => $data['message']['from']['id'],
            "text" => "текст 5",
        );
    }
    elseif($userMessage == "Если я не нашел нужный мне аккум, но хочу заказать у вас, что мне делать❓"){
        $parameters = array(
            "chat_id" => $data['message']['from']['id'],
            "text" => "текст 6",
        );
    }


}


/*
elseif($userMessage == "Чем EFB-аккумуляторы лучше обычных❓"){
    $parameters = array(
        "chat_id" => $data['message']['from']['id'],
        "text" => "EFB-аккумуляторы быстрее традиционных кислотных батарей восстанавливают заряд в процессе эксплуатации. Также они способны перенести большее число глубоких разрядок, чем обычные кислотные аккумуляторы. Плюс обеспечивают в 2 раза больше циклов «разрадки-зарядки» без утраты функциональности😉",
    );
}
elseif($userMessage == "Почему отправляее через 100% предоплату❓"){
    $parameters = array(
        "chat_id" => $data['message']['from']['id'],
        "text" => "текст 2",
    );
}
elseif($userMessage == "Через какие почтовые службы отправляете❓"){
    $parameters = array(
        "chat_id" => $data['message']['from']['id'],
        "text" => "текст 3",
    );
}
elseif($userMessage == "Какой у вас график работы❓"){
    $parameters = array(
        "chat_id" => $data['message']['from']['id'],
        "text" => "текст 4",
    );
}
elseif($userMessage == "А могу ли я забронить заказ и приехать забрать его сам❓"){
    $parameters = array(
        "chat_id" => $data['message']['from']['id'],
        "text" => "текст 5",
    );
}
elseif($userMessage == "Если я не нашел нужный мне аккум, но хочу заказать у вас, что мне делать❓"){
    $parameters = array(
        "chat_id" => $data['message']['from']['id'],
        "text" => "текст 6",
    );
}
*/


//============================== команда /sos || кнопка "Помощь" ==============================
elseif($userMessage == "/help" || $userMessage == "Помощь🆘"){
    $parameters = array(
        "chat_id" => $userID,
        "text" => "Возникли трудности❓\nЗвоните нам на номер +38(ХХХ)-ХХХ-ХХ-ХХ\n\nМЫ ВАМ ПОМОЖЕМ❗️",
    );
}
else exit();
  
$ch = curl_init($apiURL);
curl_setopt($ch, CURLOPT_URL, $apiURL);
curl_setopt($ch, CURLOPT_POST, count($parameters));
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HEADER, false);
$resultQuery = curl_exec($ch);
curl_close($ch);
  
echo $resultQuery;