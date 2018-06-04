<?php

namespace core\notification;

class notification
{
    public $receiverId;
    public $senderId;
    public $text;
    public $status;// opened notification or not

    function __construct($receiver, $sender, $txt)
    {
        $this->receiverId = $receiver;
        $this->senderId = $sender;
        $this->text = $txt;
        $this->status = 0;
        //0 status means unread
    }

}