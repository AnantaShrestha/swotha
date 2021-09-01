<?php

namespace App\Mail;

use App\BrochureRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendBrochure extends Mailable
{
    public $user;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(BrochureRequest $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Download e-Brochure[Swotah Travel and Adventure]')
            ->markdown('emails.sendbrochure');
    }
}
