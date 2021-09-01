<?php

namespace App\Mail;

use App\TripDates;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CancelBooking extends Mailable
{
    public $user;
    public $tripdate;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, TripDates $tripdate)
    {
        $this->user = $user;
        $this->tripdate = $tripdate;

    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Booking Canceled')
            ->markdown('emails.cancelBooking');
    }
}
