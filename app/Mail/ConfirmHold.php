<?php

namespace App\Mail;

use App\HoldDates;
use App\TripDates;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmHold extends Mailable
{
    public $user;
    public $hold;
    public $trip;

    use Queueable, SerializesModels;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, HoldDates $hold, TripDates $trip)
    {
       $this->user = $user;
       $this->hold = $hold;
       $this->trip = $trip;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Confirm your hold')
                        ->markdown('emails.confirmHold');

    }
}
