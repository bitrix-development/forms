<?php
// Ваши предыдущие настройки и переменные
$badIP    = [];
$to       = "info@youmet.ru";
$copy = "mt-work@yandex.ru";
$from     = "no_reply@youmet.ru";
$spam     = $_POST["surname"]; // принимаем данные из скрытого спам-поля
$ipAddr   = $_SERVER['REMOTE_ADDR']; // определяем IP-адрес пользователя
$today    = date('d-m-Y_H-i');
$name     = strip_tags(trim($_POST["name"])); // обрабатываем input "name"
$tel      = strip_tags(trim($_POST["tel"])); // обрабатываем input "tel"
$msg      = strip_tags(trim($_POST["msg"])); // обрабатываем input "tel"
//$email    = strip_tags(trim($_POST["email"])); // обрабатываем input "email"

// Проверка капчи
if (!isset($_POST["smart-token"])) {
    echo "Ошибка: токен капчи не установлен.";
    exit();
}

$ch = curl_init();
$args = http_build_query([
    "secret" => "my_secret",
    "token" => $_POST["smart-token"],
    "ip" => $_SERVER['REMOTE_ADDR'],
]);
curl_setopt($ch, CURLOPT_URL, "https://smartcaptcha.yandexcloud.net/validate?$args");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 1);
$server_output = curl_exec($ch);

if ($server_output === false) {
    echo "Ошибка cURL: " . curl_error($ch);
    curl_close($ch);
    exit();
}

$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpcode !== 200) {
    echo "Ошибка проверки капчи. Пожалуйста, попробуйте снова.";
    exit();
}

$resp = json_decode($server_output);
if ($resp->status !== "ok") {
    echo "Капча не пройдена. Пожалуйста, попробуйте снова.";
    exit();
}

// Если капча пройдена, продолжаем обработку формы
$subject  = "!!! Новая заявка !!!";
$message  = "Вопрос с формы \"Заказать звонок\"<hr>"."\n";
$message .= "<b>Имя:</b><br>{$name}<hr>"."\n"."<b>Телефон:</b><br>{$tel}<hr>"."\n"."<b>Сообщение:</b><br>{$msg}<hr>"."\n";
$subject  = "=?utf -8?B?".base64_encode($subject)."?=";
$headers  = "From: $from\r\n";
$headers .= "Reply-To: $from\r\n";
$headers .= "Content-Type: text/html; charset=utf-8\r\n";
$headers .= "Return-Path: $from\r\n"; // Добавление заголовка Return-Path

if(!in_array($ipAddr, $badIP) && empty($spam)) { // если не заполнено скрытое поле и если IP-адрес не находится в нашем чёрном списке

    $logText = strip_tags($message); // обрезаем лишние теги для log файла

    // если в поле с именем нет ни одной цифры и ни одной латинской буквы
    if(!preg_match("/[a-z0-9]/i", $name)) {
        // записываем логи в файл (если файла нет, то он будет создан автоматически)
        file_put_contents("mail.log", "\n{$today}\n{$logText}\n", FILE_APPEND); chmod("mail.log", 0600);

        // если всё ок - отправляем письмо администратору сайта
        if(mail($to, $subject, $message, $headers)) {
            $subj  = "Ваш вопрос получен - Компания «ЮМЕТ»"; // формируем письмо-отбойник клиенту, что его заявка принята
            $subj  = "=?utf-8?B?".base64_encode($subj)."?=";
            $mess  = "{$name}, Ваш вопрос принят в работу в youmet.ru.\n<br>С Вами свяжутся в ближайшее время по телефону {$tel}.\n\n<br><br>С уважением,\n<br>компания «Юмет»\n<br>+7 800 500-49-14\n<br>https://youmet.ru";
            mail($subj, $mess, $headers);
        }

    } else { // если в поле с именем были латинские буквы, либо были указаны признаки сайтов - записываем логи
        file_put_contents("spam.log", "\n{$today}\nIP:{$ipAddr}\n{$logText}\n", FILE_APPEND); chmod("spam.log", 0600);
        echo "Вы некорректно заполнили форму связи. Пожалуйста, свяжитесь с нами по e-mail или телефону.<br>";
        $message .= "<br><b>Это письмо попало в спам</b>"; mail("tam6uk@gmail.com", $subject, $message, $headers);
    }

} else { // если роботом было заполнено скрытое поле или если IP-адрес в чёрном списке
    exit(); // сразу выходим
}

/* send calltouch */
try {
    $ct_site_id = '67036'; // ID сайта Calltouch
    $call_value = isset($_COOKIE['_ct_session_id']) ? $_COOKIE['_ct_session_id'] : 'no_session_id'; // Установите значение по умолчанию
    if (isset($_POST['call_value'])) {
        $call_value = $_POST['call_value'];
    }
    $requestUrl = isset($_SERVER['HTTP_REFERER']) ? parse_url($_SERVER['HTTP_REFERER'], PHP_URL_SCHEME) . '://' . parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) . parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH) : 'no referer';
    $ct_data = array(
        'subject'       =>   'Заказать звонок',
        'fio'           =>   isset($_POST['name']) ? $_POST['name'] : '',
        'phoneNumber'   =>   isset($_POST['tel']) ? $_POST['tel'] : '',
        'email'         =>   isset($_POST['email']) ? $_POST['email'] : '',
        'requestUrl'    =>   $requestUrl,
        'sessionId'     =>   $call_value // Используйте значение call_value
    );
    $ct_data_str = http_build_query($ct_data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded;charset=utf-8"));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $ct_data_str);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $calltouch = curl_exec($ch);

    // Проверка на ошибку выполнения запроса
    if (curl_errno($ch)) {
        throw new Exception(curl_error($ch));
    }

    // Получение HTTP-кода ответа
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($http_code != 200) {
        throw new Exception("HTTP response code: " . $http_code);
    }

    curl_close($ch);

    // Логируем успешный запрос
    $log_message = "\n \n" . "request " . date("Y.m.d H:i") . "\n";
    $log_message .= "Data sent: " . $ct_data_str . "\n";
    $log_message .= "Response: " . $calltouch . "\n";
    file_put_contents(__DIR__ . '/calltouch_log.txt', $log_message, FILE_APPEND | LOCK_EX);

} catch (Exception $e) {
    // Логируем ошибку
    $log_message = "\n \n" . "request " . date("Y.m.d H:i") . "\n";
    $log_message .= "Error: " . $e->getMessage() . "\n";
    $log_message .= "Data sent: " . print_r($ct_data, true) . "\n";
    file_put_contents(__DIR__ . '/calltouch_error_log.txt', $log_message, FILE_APPEND | LOCK_EX);
}
/* send calltouch */
?>
