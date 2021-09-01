<?php

namespace App\Mail;

use App\TripBookings;
use App\Trips;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmOnlineTripBooking extends Mailable
{
	public $user;
	public $trip;
	public $booking;
	public $bookid;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
	public function __construct(User $user, Trips $trip, TripBookings $bookings, $bookid)
	{
		$this->user = $user;
		$this->trip= $trip;
		$this->booking = $bookings;
		$this->bookid = $bookid;
	}
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
	    return $this->subject('Trip Booking Confirmed')
		    ->attach(storage_path('onlinepayment/invoice_number#'.$this->bookid.".pdf"))
		    ->markdown('emails.confirmTripBooking');
    }
}
