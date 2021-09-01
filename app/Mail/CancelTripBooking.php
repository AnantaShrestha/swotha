<?php

namespace App\Mail;

use App\TripBookings;
use App\Trips;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CancelTripBooking extends Mailable
{
    public $user;
    public $trip;
    public $booking;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Trips $trip, TripBookings $bookings)
    {
        $this->user = $user;
        $this->trip= $trip;
        $this->booking = $bookings;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Trip Booking Cancelled')
            ->markdown('emails.cancelTripBooking');
    }
}
