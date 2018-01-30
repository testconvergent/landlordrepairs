<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class hiredMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
	public $hired;
    public function __construct($hiredDetails)
    {
        $this->hired=$hiredDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		$data['hired']=$this->hired;
        return $this->view('mail.hired',$data)->subject($this->subject)->from('noreply@landlordrepairs.uk');
    }
}
