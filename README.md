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
Telegram\Query::init($config);
```
где

$config - массив с параметрами инициализации:

-$config['token'] - ваш ключ Telegram Bot API;
-$config['proxy'] - адрес прокси, если необходим.

Параметры могут содержать и другие ключи, значение которых можно будет получить через getConfigVar() с указанием имени параметра:
```php
$admin_id=Telegram\Query::getConfigVar('admin_id');
```

Если параметр не задан в массиве, то будет возвращён null.

Данную инициализацию необходимо, также, выполнять в случае использовани WebHook!

# Обработка WebHook
При обработке Webhook можно задать контакт админстратора, куда будут поступать сообщения об ошибках:
```php
Telegram\Webhook::setAdminChat(Telegram\Query::getConfigVar('admin_id'));
```
Получение Update, полученного через Webhook:
```php
$update=Telegram\Webhook::getUpdate();
```
В результате будет получен объект типа Update.

Ответ на WebHook может быть выполнен с помощью метода webhookReplyJson(). 
```php
$reply=new \Telegram\SendMessage();
$reply->setChatId($chat_id);
$reply->setText("Привет");
$reply->webhookReplyJson();
```
## Обработка ошибок
при указании контакта администратора все сообщения об ошибках будут направлены ему в виде сообщений. Изменить получения сообщений можно с помощью метода:

```php
Telegram\Webhook::setExceptionHandler($chat_id);
```
При этом если класс исключения имеет имя UserException в любом пространстве имён, то пользователь получит текст сообщения в виде ответа на свой запрос. Для всех других исключений пользователю будет сообщено об ошибке обработки запроса, а подробности ошибки будет отправлены адинистратору.

# Выполнение запросов на сервер
Запросы на сервер выполняются с помощью методов httpGet(), httpPost() и httpPostJson. При этом необходимо предварительно установить токен доступа и прокси (если необходим) через массив конфигурации.

```php
Telegram\Query::init($config);
...
$reply=new \Telegram\SendMessage();
$reply->setChatId($chat_id);
$reply->setText("Привет");
$reply->httpPost();
```
