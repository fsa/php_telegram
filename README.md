# Классы PHP для работы с Telegram Bot API
Данные классы могут использоваться для упрощения взаимодействия с Telegram Bot API - [https://core.telegram.org/bots/api](https://core.telegram.org/bots/api). С их помощью можно произвести декодирование сообщений и преобразовать их в объекты PHP, а также осуществить подготовку сообщений для отправки. API описано не полностью, но позволяет обеспечить обработку большей части запросов и сформировать некоторые типы сообщений.

# Минимальные требования
- php 7.4

# Использование классов
Данный проект не поддерживает composer!!!

Для использования классов добавьте папку classes в пути include_path с помощью set_include_path, а также включите механизм автозагрузки классов в PHP.
```php
spl_autoload_extensions('.php');
spl_autoload_register();
```

# Что ещё не реализовано
Следующие сущности и методы в настоящее время не реализованы в коде.
```
InputMedia*
sendPhoto
sendAudio
sendDocument
sendVideo
sendAnimation
sendVoice
sendVideoNote
sendMediaGroup
sendLocation
editMessageLiveLocation
stopMessageLiveLocation
sendVenue
sendContact
sendPoll
sendChatAction
getUserProfilePhotos
kickChatMember
unbanChatMember
restrictChatMember
promoteChatMember
setChatAdministratorCustomTitle
setChatPermissions
exportChatInviteLink
setChatPhoto
deleteChatPhoto
setChatTitle
setChatDescription
pinChatMessage
unpinChatMessage
leaveChat
getChat
getChatAdministrators
getChatMembersCount
getChatMember
setChatStickerSet
deleteChatStickerSet
answerCallbackQuery
editMessageText
editMessageCaption
editMessageMedia
editMessageReplyMarkup
stopPoll
deleteMessage
StickerSet
MaskPosition
getStickerSet
uploadStickerFile
createNewStickerSet
addStickerToSet
setStickerPositionInSet
deleteStickerFromSet
InlineQuery
answerInlineQuery
InlineQueryResult*
InputMessageContent
InputTextMessageContent
InputLocationMessageContent
InputVenueMessageContent
InputContactMessageContent
ChosenInlineResult
sendInvoice
answerShippingQuery
answerPreCheckoutQuery
LabeledPrice
Invoice
ShippingAddress
OrderInfo
ShippingOption
SuccessfulPayment
ShippingQuery
PreCheckoutQuery
PassportData
PassportFile
EncryptedPassportElement
EncryptedCredentials
setPassportDataErrors
PassportElementError
PassportElementErrorDataField
PassportElementErrorFrontSide
PassportElementErrorReverseSide
PassportElementErrorSelfie
PassportElementErrorFile
PassportElementErrorFiles
PassportElementErrorTranslationFile
PassportElementErrorTranslationFiles
PassportElementErrorUnspecified
sendGame
Game
CallbackGame
setGameScore
getGameHighScores
GameHighScore```