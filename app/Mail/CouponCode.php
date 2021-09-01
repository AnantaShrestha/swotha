<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CouponCode extends Mailable
{
	public $name;
	public $code;
	public $discount;
	public $amount;
	public $date;
	
    use Queueable, SerializesModels;
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $code, $discount, $amount, $date)
    {
        $this->name = $name;
        $this->code = $code;
        $this->discount = $discount;
        $this->amount = $amount;
        $this->date = $date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Discount Coupon')->markdown('emails.coupon');
    }
}
