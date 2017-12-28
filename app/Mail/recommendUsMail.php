<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class recommendUsMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
	public $recommend_us;
    public function __construct($recommended_details)
    {
        $this->recommendation=$recommended_details;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
		$data['recommendation']=$this->recommendation;
        return $this->view('mail.recommend_us',$data)->subject($this->subject)->from('noreply@landlordrepairs.uk');
    }
