<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Markdown;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class EmptyMail extends Mailable
{
    use Queueable, SerializesModels;

    private string $inSubject;
    private string $inContent;

    /**
     * Create a new message instance.
     *
     * @param string $subject
     * @param string $content
     */
    public function __construct(string $subject, string $content)
    {
        $this->inSubject = $subject;
        $this->inContent = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): EmptyMail
    {
        return $this
            ->subject($this->inSubject)
            ->view('mails.empty', [
                'content' => $this->sanitizeContent($this->inContent)
            ]);
    }

    /**
     * @param string $content
     * @return string
     **/
    protected function sanitizeContent(string $content): string
    {
        $content = str_replace("\n", '<br>', $content);
        return $content;
    }
}
