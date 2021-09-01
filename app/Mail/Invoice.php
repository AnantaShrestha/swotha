<?php

namespace App\Mail;

use App\TripDates;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Invoice extends Mailable
{
    public $user;
    public $tripdate;
    public $book;
    
	use Queueable, SerializesModels;

//    public $booking = Bookings::where([[''],[]]);

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, TripDates $tripdate, $book)
    {
//        dd($book);
        $this->user = $user;
        $this->tripdate = $tripdate;
        $this->book = $book;

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
            ->attach(storage_path('Invoices/Pending/invoice#'.$this->book.".pdf"))
            ->markdown('emails.invoice');
    }
}
