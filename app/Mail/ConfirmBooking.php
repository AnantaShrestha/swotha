<?php

namespace App\Mail;

use App\TripDates;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmBooking extends Mailable
{
    public $user;
    public $tripdate;
    public $bookid;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, TripDates $tripdate, $bookid)
    {
        $this->user = $user;
        $this->tripdate = $tripdate;
        $this->bookid = $bookid;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Booking Confirmed')
	   ->attach(storage_path('Invoices/Paid/invoice#'.$this->bookid.".pdf"))
       ->markdown('emails.confirmBooking');
    }
}
