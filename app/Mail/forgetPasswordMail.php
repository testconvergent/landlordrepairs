<?php
namespace App\Mail;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class forgetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $forgotPasswordDetails;
    public function __construct($passwordDetails)
    {
       $this->forgotPasswordDetails=$passwordDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $data['data']= $this->forgotPasswordDetails;
        $to_email= $this->forgotPasswordDetails->user_email;
        return $this->view('mail.forget_password_mail',$data)
                    ->subject('Forget Password Mail')
                    ->to($to_email)
                    ->from('noreply@landlordrepairs.uk');
    }
}
