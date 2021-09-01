<?php

namespace App\Mail;

use App\HoldDates;
use App\TripDates;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RemainderHold extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $holdDates;
    public $tripdate;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,HoldDates $holdDates,TripDates $tripdate)
    {
        $this->user = $user;
        $this->holdDates = $holdDates;
        $this->tripdate = $tripdate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Remainder Mail')
                    ->markdown('emails.holdRemainder');
    }
}
