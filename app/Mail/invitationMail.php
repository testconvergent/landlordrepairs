<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class invitationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
  public $invitation;
    public function __construct($invitationDetails)
    {
        $this->invitation=$invitationDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
		$data['invitation']=$this->invitation;
        return $this->view('mail.invitation',$data)->subject($this->subject)->from('noreply@landlordrepairs.uk');
    }
}
