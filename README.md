# Классы PHP для работы с Telegram Bot API
Данные классы могут использоваться для упрощения взаимодействия с Telegram Bot API - [https://core.telegram.org/bots/api](https://core.telegram.org/bots/api). С их помощью можно произвести декодирование сообщений и преобразовать их в объекты PHP, а также осуществить подготовку сообщений для отправки. API описано не полностью, но позволяет обеспечить обработку большей части запросов и сформировать некоторые типы сообщений.

# Минимальные требования
- php 7.4

# Использование классов
Данный проект не поддерживает composer!!!

Добавьте папку classes в пути include_path с помощью set_include_path, а также включите механизм автозагрузки классов в PHP:
```php
set_include_path(__DIR__ . '/classes/');
spl_autoload_extensions('.php');
spl_autoload_register();
```

Перед выполнением запросов выполните:

```php
Telegram\Query::init($token, $proxy);
```
где
    $token - ваш ключ Telegram Bot API;

    $proxy - адрес прокси, если необходимо.

# Обработка WebHook
```php
$update=Telegram\Webhook::getUpdate($admin);
```
В результате будет получен объект типа Update. При необходимости можно указать адрес администратора, который будет получать сообщения об исключительных ситуациях в коде, если они возникнут у пользователей.

Ответ на WebHook может быть выполнен с помощью метода webhookReplyJson(). 
```php
$reply=new \Telegram\SendMessage();
$reply->setChatId($chat_id);
$reply->setText("Привет");
$reply->webhookReplyJson();
```

# Выполнение запросов на сервер
Запросы на сервер выполняются с помощью методов httpGet() и httpPost(). При этом необходимо предварительно установить токен доступа и прокси (если необходим).

```php
$reply=new \Telegram\SendMessage();
$reply->setChatId($chat_id);
$reply->setText("Привет");
$reply->httpPost();
```
