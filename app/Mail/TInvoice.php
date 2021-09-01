<?php

namespace App\Mail;

use App\TripBookings;
use App\Trips;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TInvoice extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $tripdate;
    public $book;
    public $tripbooking;

//    public $booking = Bookings::where([[''],[]]);

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Trips $tripdate, TripBookings $tripbooking, $book)
    {
//        dd($book);
        $this->user = $user;
        $this->tripdate = $tripdate;
        $this->book = $book;
        $this->tripbooking = $tripbooking;

        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->subject('Payment Invoice')
            ->attach(storage_path('Invoices/Pending/invoice#'.$this->book.".pdf"))->markdown('emails.tinvoice');
    }
}

