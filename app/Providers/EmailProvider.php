<?php

namespace App\Providers;

use App\Interfaces\EmailProviderInterface;
use App\Exceptions\AppError;
use Illuminate\Support\Facades\Mail;

class EmailProvider implements EmailProviderInterface
{
    private $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function sendEmail($to, $subject, $body)
    {
        $data = array('body' => $body);

        // Enviar o e-mail
        try {
            Mail::send([], [], function ($message) use ($to, $subject) {
                $message->to($to)
                    ->subject($subject)
                    ->setBody(view('emails.email-template', $data)->render(), 'text/html');
            });
        } catch (\Exception $e) {
            throw new AppError("Error sending email!", 400);
        }
    }
}

?>
