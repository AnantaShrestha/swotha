<?php

namespace App\Jobs;

use App\BrochureRequest;
use App\Mail\SendBrochure;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendBrochureJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $email;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(BrochureRequest $user, $email)
    {
    	$this->user = $user;
    	$this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
	    Mail::to($this->email)->send(new SendBrochure($this->user));
    }
}
