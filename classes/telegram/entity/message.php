<?php

/**
 * Telegram API 4.9
 */

namespace Telegram\Entity;

class Message {

    public $message_id;
    public $from;
    public $date;
    public $chat;
    public $forward_from;
    public $forward_from_chat;
    public $forward_from_message_id;
    public $forward_signature;
    public $forward_sender_name;
    public $forward_date;
    public $reply_to_message;
    public $via_bot;
    public $edit_date;
    public $media_group_id;
    public $author_signature;
    public $text;
    public $entities;
    public $animation;
    public $audio;
    public $document;
    public $photo=[];
    public $sticker;
    public $video;
    public $video_note;
    public $voice;
    public $caption;
    public $caption_entities;
    public $contact;
    public $dice;
    public $game;
    public $poll;
    public $venue;
    public $location;
    public $new_chat_members;
    public $left_chat_member;
    public $new_chat_title;
    public $new_chat_photo;
    public $delete_chat_photo;
    public $group_chat_created;
    public $supergroup_chat_created;
    public $channel_chat_created;
    public $migrate_to_chat_id;
    public $migrate_from_chat_id;
    public $pinned_message;
    public $invoice;
    public $successful_payment;
    public $connected_website;
    public $passport_data;
    public $reply_markup;
    public $unsupported=[];

    public function __construct(array $message) {
        foreach ($message as $key=> $value) {
            switch ($key) {
                case 'message_id':
                    $this->message_id=intval($value);
                    break;
                case 'from':
                    $this->from=new User($value);
                    break;
                case 'date':
                    $this->date=$value;
                    break;
                case 'chat':
                    $this->chat=new Chat($value);
                    break;
                case 'forward_from':
                    $this->from=new User($value);
                    break;
                case 'forward_from_chat':
                    $this->forward_from_chat=new Chat($value);
                    break;
                case 'forward_from_message_id':
                    $this->forward_from_message_id=intval($value);
                    break;
                case 'forward_signature':
                    $this->forward_signature=$value;
                    break;
                case 'forward_sender_name':
                    $this->forward_sender_name=$value;
                    break;
                case 'forward_date':
                    $this->forward_date=intval($value);
                    break;
                case 'reply_to_message':
                    $this->reply_to_message=new Message($value);
                    break;
                case 'via_bot':
                    $this->from=new User($value);
                    break;
                case 'edit_date':
                    $this->edit_date=intval($value);
                    break;
                case 'media_group_id':
                    $this->media_group_id=$value;
                    break;
                case 'author_signature':
                    $this->author_signature=$value;
                    break;
                case 'text':
                    $this->text=$value;
                    break;
                case 'entities':
                    foreach ($value as $entity) {
                        $this->entities[]=new MessageEntity($entity);
                    }
                    break;
                case 'animation':
                    $this->animation=new Animation($value);
                    break;
                case 'audio':
                    $this->audio=new Audio($value);
                    break;
                case 'document':
                    $this->document=new Document($value);
                    break;
                case 'photo':
                    foreach ($value as $photo) {
                        $this->photo[]=new PhotoSize($photo);
                    }
                    break;
                case 'sticker':
                    $this->sticker=new Sticker($value);
                    break;
                case 'video':
                    $this->video=new Video($value);
                    break;
                case 'video_note':
                    $this->video_note=new VideoNote($value);
                    break;
                case 'voice':
                    $this->voice=new Voice($value);
                    break;
                case 'caption':
                    $this->caption=$value;
                    break;
                case 'caption_entities':
                    $this->caption_entities=new MessageEntity($value);
                    break;
                case 'contact':
                    $this->contact=new Contact($value);
                    break;
                case 'dice':
                    $this->contact=new Dice($value);
                    break;
                case 'game':
                    $this->game=new Game($value);
                    break;
                case 'poll':
                    $this->poll=new Poll($value);
                    break;
                case 'venue':
                    $this->venue=new Venue($value);
                    break;
                case 'location':
                    $this->location=new Location($value);
                    break;
                case 'new_chat_members':
                    foreach ($value as $user) {
                        $this->new_chat_members[]=new User($value);
                    }
                    break;
                case 'left_chat_member':
                    $this->left_chat_member=new User($value);
                    break;
                case 'new_chat_title':
                    $this->new_chat_title=$value;
                    break;
                case 'new_chat_photo':
                    foreach ($value as $photo) {
                        $this->new_chat_photo[]=new PhotoSize($photo);
                    }
                    break;
                case 'delete_chat_photo':
                    $this->delete_chat_photo=$value;
                    break;
                case 'group_chat_created':
                    $this->group_chat_created=$value;
                    break;
                case 'supergroup_chat_created':
                    $this->supergroup_chat_created=$value;
                    break;
                case 'channel_chat_created':
                    $this->channel_chat_created=$value;
                    break;
                case 'migrate_to_chat_id':
                    $this->migrate_to_chat_id=intval($value);
                    break;
                case 'migrate_from_chat_id':
                    $this->migrate_from_chat_id=intval($value);
                    break;
                case 'pinned_message':
                    $this->pinned_message=new Message($value);
                    break;
                case 'invoice':
                    $this->invoice=new Invoice($value);
                    break;
                case 'successful_payment':
                    $this->successful_payment=new SuccessfulPayment($value);
                    break;
                case 'connected_website':
                    $this->connected_website=$value;
                    break;
                case 'passport_data':
                    $this->passport_data=new PassportData($value);
                    break;
                case 'reply_markup':
                    $this->reply_markup=new InlineKeyboardMarkup($value);
                    break;
                default:
                    $this->unsupported[$key]=$value;
            }
        }
    }

}