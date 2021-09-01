<?php

namespace App\Mail;

use App\TripDates;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmOnlineBooking extends Mailable
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
	public function __construct(User $user, TripDates $tripdate,$bookid)
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
	    return $this->subject('Online Booking Confirmed')
		    ->attach(storage_path('onlinepayment/invoice_number#'.$this->bookid.".pdf"))
		    ->markdown('emails.confirmBooking');
    }
}
