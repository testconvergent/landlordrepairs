<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class providerSubmitQuote extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
	public $quote_details;
    public function __construct($quote_details)
    {
        $this->quote_details=$quote_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {	$data['quote_details']=$this->quote_details;
        return $this->view('mail.provider_submit_quote',$data)->subject($this->quote_details->subject)->from('noreply@landlordrepairs.uk');
    }
}
