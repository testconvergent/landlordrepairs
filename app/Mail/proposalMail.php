<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class proposalMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
	 public $proposal;
    public function __construct($proposalDetails)
    {
        $this->proposal=$proposalDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		$data['proposal']=$this->proposal;
        return $this->view('mail.proposal',$data)->subject($this->subject)->from($this->from);
    }
}
