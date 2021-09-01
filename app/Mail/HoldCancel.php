<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HoldCancel extends Mailable
{
	public $name;
	public $message;
	
	use Queueable, SerializesModels;
	
	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($name, $message)
	{
		$this->name = $name;
		$this->message = $message;
	}
	
	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->subject("'Hold' Cancellation")->markdown('emails.cancelHold');
	}
}
