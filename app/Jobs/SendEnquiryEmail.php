<?php

namespace App\Jobs;

use App\Mail\NotifyAdmin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEnquiryEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $subject;
    public $message;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($subject, $message)
    {
    	$this->subject = $subject;
    	$this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
	    Mail::to('info@swotahtravel.com')->send(new NotifyAdmin($this->subject, $this->message));
    }
}
