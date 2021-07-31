<?php

namespace App\Traits\Functions;

use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

trait SendMail
{
    protected function sendMail($receivers, string $subject, string $content, ?array $attachments = null)
    {
        if ($attachments === null) {
            $attachments = [];
        }

        Mail::raw($content, static function (Message $message) use ($subject, $receivers, $attachments) {
            $message->subject($subject)->to(array_shift($receivers));
            if (count($receivers) > 0) {
                $message->bcc($receivers);
            }
            foreach ($attachments as $attachment) {
                $message->attach($attachment, [
                    'as' => $attachment->getClientOriginalName()
                ]);
            }
        });
    }
}
