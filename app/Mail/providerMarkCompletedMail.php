<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class providerMarkCompletedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $request_complete;
    public function __construct($request_complete)
    {
        $this->request_complete=$request_complete;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
	    $data['request_complete']=$this->request_complete;
		return $this->view('mail.request_job_complete',$data)
		->subject($this->request_complete->subject)
		->from($this->request_complete->provider_email);
    }
}
