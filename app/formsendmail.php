<?php
// сюда нужно вписать токен вашего бота
define('TELEGRAM_TOKEN', '710512902:AAFL2cPejr6VIXCLqS2KmOKxNtEEVd2JbGA');

// сюда нужно вписать ваш внутренний айдишник
define('TELEGRAM_CHATID', '-205464404');

if (isset($_POST["phone"]) ) { 

    $to = 'potolok@azmu.ru'; //Почта получателя, через запятую можно указать сколько угодно адресов
        $phone = $_POST["phone"];
        $subject = 'Заявка с сайта'; //Заголовок сообщения
        $message = '
                <html>
                    <head>
                        <title>'.$subject.'</title>
                    </head>
                    <body>
                        <p>Телефон: <b>'.$phone.'</b></p>
                    </body>
                </html>'; //Текст нащего сообщения можно использовать HTML теги
        $headers  = "Content-type: text/html; charset=utf-8 \r\n"; //Кодировка письма
        $headers .= "From: azmu.ru <zakaz@azmu.ru>\r\n"; //Наименование и почта отправителя
        mail($to, $subject, $message, $headers);
        message_to_telegram('#заявка'."\n".'Заявка с сайта azmu.ru'."\n".'Телефон: '.$phone);
    $result = array(
        // 'name' => $_POST["name"],
        'phonenumber' => $_POST["phone"]
    ); 

    // Переводим массив в JSON
    echo json_encode($result);
}


function message_to_telegram($text) {
    $ch = curl_init();
    curl_setopt_array(
        $ch,
        array(
            CURLOPT_URL => 'https://api.telegram.org/bot' . TELEGRAM_TOKEN . '/sendMessage',
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_POSTFIELDS => array(
                'chat_id' => TELEGRAM_CHATID,
                'text' => $text,
            ),
        )
    );
    curl_exec($ch);
}